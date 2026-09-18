<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentProof;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Models\VendorCommission;
use App\Models\VendorEarning;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderProcessingService
{
    /**
     * Process Cash on Delivery (COD) order.
     * Order created immediately with payment_status = pending.
     */
    public function processCodOrder(User $user, Address $deliveryAddress, Cart $cart, float $shippingCost, float $couponDiscount = 0): Order
    {
        return DB::transaction(function () use ($user, $deliveryAddress, $cart, $shippingCost, $couponDiscount) {
            $this->validateCartStock($cart);

            $subtotal = $cart->subtotal;
            $grandTotal = max(0, $subtotal + $shippingCost - $couponDiscount);

            $order = Order::create([
                'order_number' => 'BD-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'coupon_discount' => $couponDiscount,
                'grand_total' => $grandTotal,
                'currency' => 'BDT',
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            $this->createOrderAddress($order, $deliveryAddress);
            $this->processOrderItemsAndCommissions($order, $cart);

            // Create initial payment record
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'cod',
                'amount' => $grandTotal,
                'currency' => 'BDT',
                'status' => 'pending',
            ]);

            // Clear database cart
            $cart->items()->delete();

            return $order;
        });
    }

    /**
     * Process bKash or Nagad Manual Payment.
     * CRITICAL: Never create order unless valid transaction proof is received.
     */
    public function processManualPaymentOrder(
        User $user,
        Address $deliveryAddress,
        Cart $cart,
        float $shippingCost,
        string $paymentMethod, // 'bkash' or 'nagad'
        string $phoneNumber,
        string $transactionId,
        UploadedFile $screenshotFile,
        float $couponDiscount = 0
    ): Order {
        // 1. Anti-Duplicate Transaction Check
        $cleanTxId = strtoupper(trim($transactionId));
        if (PaymentProof::where('transaction_id', $cleanTxId)->exists()) {
            throw new Exception("This transaction ID has already been submitted. Please check your payment history.");
        }

        return DB::transaction(function () use (
            $user, $deliveryAddress, $cart, $shippingCost, $paymentMethod,
            $phoneNumber, $cleanTxId, $screenshotFile, $couponDiscount
        ) {
            $this->validateCartStock($cart);

            $subtotal = $cart->subtotal;
            $grandTotal = max(0, $subtotal + $shippingCost - $couponDiscount);

            // 2. Store Payment Screenshot Securely on Private Disk
            $path = $screenshotFile->store('payment_proofs/' . date('Y/m'), 'local');

            // 3. Create Order in 'payment_verification' status
            $order = Order::create([
                'order_number' => 'BD-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'coupon_discount' => $couponDiscount,
                'grand_total' => $grandTotal,
                'currency' => 'BDT',
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending_verification',
                'order_status' => 'payment_verification',
            ]);

            $this->createOrderAddress($order, $deliveryAddress);
            $this->processOrderItemsAndCommissions($order, $cart);

            // 4. Create Payment Record
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => $paymentMethod,
                'amount' => $grandTotal,
                'currency' => 'BDT',
                'status' => 'pending_verification',
            ]);

            // 5. Create Payment Proof
            PaymentProof::create([
                'payment_id' => $payment->id,
                'order_id' => $order->id,
                'payment_method' => $paymentMethod,
                'phone_number' => $phoneNumber,
                'transaction_id' => $cleanTxId,
                'screenshot_path' => $path,
                'amount' => $grandTotal,
                'currency' => 'BDT',
                'status' => 'pending_verification',
                'submitted_at' => now(),
            ]);

            // 6. Clear Cart
            $cart->items()->delete();

            return $order;
        });
    }

    /**
     * Admin Action: Verify Payment.
     * Marks payment as paid, order as confirmed, and activates vendor earnings.
     */
    public function verifyPayment(Payment $payment, User $adminUser, ?string $adminNote = null): void
    {
        DB::transaction(function () use ($payment, $adminUser, $adminNote) {
            $payment->update([
                'status' => 'paid',
            ]);

            $proof = $payment->proof;
            if ($proof) {
                $proof->update([
                    'status' => 'verified',
                    'verified_by' => $adminUser->id,
                    'verified_at' => now(),
                    'admin_note' => $adminNote,
                ]);
            }

            $order = $payment->order;
            $order->update([
                'payment_status' => 'paid',
                'order_status' => 'confirmed',
                'confirmed_at' => now(),
                'admin_note' => $adminNote,
            ]);

            // Settle vendor earnings to available balance
            foreach ($order->earnings as $earning) {
                $earning->update([
                    'status' => 'available',
                    'settled_at' => now(),
                ]);

                // Credit vendor balance
                $earning->vendor->increment('balance', $earning->net_earning);
                $earning->vendor->increment('total_sales', $earning->subtotal);
                $earning->vendor->increment('total_orders');
            }
        });
    }

    /**
     * Admin Action: Reject Payment.
     */
    public function rejectPayment(Payment $payment, User $adminUser, string $rejectionReason): void
    {
        DB::transaction(function () use ($payment, $adminUser, $rejectionReason) {
            $payment->update([
                'status' => 'rejected',
            ]);

            $proof = $payment->proof;
            if ($proof) {
                $proof->update([
                    'status' => 'rejected',
                    'verified_by' => $adminUser->id,
                    'verified_at' => now(),
                    'rejection_reason' => $rejectionReason,
                ]);
            }

            $order = $payment->order;
            $order->update([
                'payment_status' => 'rejected',
                'order_status' => 'cancelled',
                'rejection_reason' => $rejectionReason,
                'cancelled_at' => now(),
            ]);

            // Restore product inventory
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
                Inventory::create([
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity_change' => $item->quantity,
                    'action_type' => 'order_restoration',
                    'reference_id' => 'Order #' . $order->order_number,
                    'notes' => 'Payment rejected by admin. Stock restored.',
                ]);
            }

            // Cancel vendor earnings
            foreach ($order->earnings as $earning) {
                $earning->update(['status' => 'cancelled']);
            }
        });
    }

    private function validateCartStock(Cart $cart): void
    {
        if ($cart->items->isEmpty()) {
            throw new Exception("Your shopping cart is empty.");
        }

        foreach ($cart->items as $item) {
            if (!$item->product->hasStock($item->quantity)) {
                throw new Exception("Product '{$item->product->name}' does not have sufficient stock (Available: {$item->product->stock}).");
            }
        }
    }

    private function createOrderAddress(Order $order, Address $address): void
    {
        OrderAddress::create([
            'order_id' => $order->id,
            'type' => 'delivery',
            'full_name' => $address->full_name,
            'phone' => $address->phone,
            'division_name' => $address->division->name,
            'district_name' => $address->district->name,
            'upazila_name' => $address->upazila->name,
            'area' => $address->area,
            'full_address' => $address->full_address,
            'landmark' => $address->landmark,
            'postal_code' => $address->postal_code,
        ]);
    }

    private function processOrderItemsAndCommissions(Order $order, Cart $cart): void
    {
        $vendorSubtotals = [];

        foreach ($cart->items as $item) {
            $product = $item->product;
            $vendor = $product->vendor;

            $itemSubtotal = $item->quantity * $item->unit_price;
            $commRate = $vendor->commission_percentage;
            $commAmount = round(($itemSubtotal * $commRate) / 100, 2);
            $vendorNet = $itemSubtotal - $commAmount;

            // Create Order Item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'vendor_id' => $vendor->id,
                'product_id' => $product->id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => $product->name,
                'variant_label' => $item->variant?->sku ?? null,
                'sku' => $item->variant?->sku ?? $product->sku,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'subtotal' => $itemSubtotal,
                'commission_rate' => $commRate,
                'commission_amount' => $commAmount,
                'vendor_earning' => $vendorNet,
                'vendor_order_status' => 'pending',
            ]);

            // Create Commission Record
            VendorCommission::create([
                'order_id' => $order->id,
                'order_item_id' => $orderItem->id,
                'vendor_id' => $vendor->id,
                'item_subtotal' => $itemSubtotal,
                'commission_rate' => $commRate,
                'commission_amount' => $commAmount,
                'vendor_net_amount' => $vendorNet,
            ]);

            // Decrement Stock
            $product->decrement('stock', $item->quantity);
            Inventory::create([
                'product_id' => $product->id,
                'product_variant_id' => $item->product_variant_id,
                'quantity_change' => -$item->quantity,
                'action_type' => 'order_deduction',
                'reference_id' => 'Order #' . $order->order_number,
                'notes' => 'Customer purchased item.',
            ]);

            // Accumulate for vendor earning record
            if (!isset($vendorSubtotals[$vendor->id])) {
                $vendorSubtotals[$vendor->id] = [
                    'subtotal' => 0.0,
                    'commission' => 0.0,
                    'net' => 0.0,
                ];
            }
            $vendorSubtotals[$vendor->id]['subtotal'] += $itemSubtotal;
            $vendorSubtotals[$vendor->id]['commission'] += $commAmount;
            $vendorSubtotals[$vendor->id]['net'] += $vendorNet;
        }

        // Create VendorEarning records per vendor in this order
        foreach ($vendorSubtotals as $vendorId => $totals) {
            VendorEarning::create([
                'vendor_id' => $vendorId,
                'order_id' => $order->id,
                'subtotal' => $totals['subtotal'],
                'commission_deducted' => $totals['commission'],
                'net_earning' => $totals['net'],
                'status' => 'pending',
            ]);
        }
    }
}
