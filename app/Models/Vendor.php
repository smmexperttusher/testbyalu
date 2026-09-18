<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'store_name',
        'store_slug',
        'logo',
        'banner',
        'description',
        'phone',
        'email',
        'address',
        'commission_percentage',
        'balance',
        'pending_balance',
        'total_sales',
        'total_orders',
        'total_products',
        'approval_status',
        'status',
        'rejection_reason',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'commission_percentage' => 'decimal:2',
            'balance' => 'decimal:2',
            'pending_balance' => 'decimal:2',
            'total_sales' => 'decimal:2',
            'approved_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(VendorProfile::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(VendorCommission::class);
    }

    public function earnings(): HasMany
    {
        return $this->hasMany(VendorEarning::class);
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
