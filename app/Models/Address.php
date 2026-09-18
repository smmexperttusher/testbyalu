<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'division_id',
        'district_id',
        'upazila_id',
        'area',
        'full_address',
        'landmark',
        'postal_code',
        'type',
        'is_default_delivery',
        'is_default_billing',
    ];

    protected function casts(): array
    {
        return [
            'is_default_delivery' => 'boolean',
            'is_default_billing' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function getFormattedAddressAttribute(): string
    {
        $parts = array_filter([
            $this->full_address,
            $this->area,
            $this->upazila?->name,
            $this->district?->name,
            $this->division?->name,
            $this->postal_code ? "Postal Code: {$this->postal_code}" : null,
        ]);

        return implode(', ', $parts);
    }
}
