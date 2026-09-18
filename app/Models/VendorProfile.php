<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'trade_license_number',
        'nid_number',
        'nid_front_path',
        'nid_back_path',
        'bank_name',
        'bank_branch',
        'bank_account_name',
        'bank_account_number',
        'bank_routing_number',
        'bkash_payout_number',
        'nagad_payout_number',
        'facebook_page',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
