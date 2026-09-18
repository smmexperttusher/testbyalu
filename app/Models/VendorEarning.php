<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorEarning extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'order_id',
        'subtotal',
        'commission_deducted',
        'net_earning',
        'status',
        'settled_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'commission_deducted' => 'decimal:2',
            'net_earning' => 'decimal:2',
            'settled_at' => 'datetime',
        ];
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
