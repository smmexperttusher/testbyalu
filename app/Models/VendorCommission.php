<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_item_id',
        'vendor_id',
        'item_subtotal',
        'commission_rate',
        'commission_amount',
        'vendor_net_amount',
    ];

    protected function casts(): array
    {
        return [
            'item_subtotal' => 'decimal:2',
            'commission_rate' => 'decimal:2',
            'commission_amount' => 'decimal:2',
            'vendor_net_amount' => 'decimal:2',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
