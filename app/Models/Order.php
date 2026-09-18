<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number',
        'user_id',
        'subtotal',
        'discount_amount',
        'coupon_discount',
        'shipping_cost',
        'tax_amount',
        'grand_total',
        'currency',
        'payment_method',
        'payment_status',
        'order_status',
        'customer_note',
        'admin_note',
        'rejection_reason',
        'confirmed_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'coupon_discount' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'grand_total' => 'decimal:2',
            'confirmed_at' => 'datetime',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function paymentProof(): HasOne
    {
        return $this->hasOne(PaymentProof::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(VendorCommission::class);
    }

    public function earnings(): HasMany
    {
        return $this->hasMany(VendorEarning::class);
    }

    public function isVerified(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isVerificationPending(): bool
    {
        return $this->payment_status === 'pending_verification';
    }
}
