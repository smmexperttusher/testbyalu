<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PaymentProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'order_id',
        'payment_method',
        'phone_number',
        'transaction_id',
        'screenshot_path',
        'amount',
        'currency',
        'status',
        'submitted_at',
        'verified_by',
        'verified_at',
        'admin_note',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'submitted_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Get secure temporary or stream URL for admin inspection.
     * Proof screenshots are never stored on public disk.
     */
    public function getSecureUrlAttribute(): string
    {
        return route('admin.payments.screenshot', ['id' => $this->id]);
    }
}
