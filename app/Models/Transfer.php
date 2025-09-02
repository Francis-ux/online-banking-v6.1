<?php

namespace App\Models;

use App\Enum\TransferStatus;
use App\Enum\TransferType;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'bank_name',
        'account_number',
        'account_name',
        'amount',
        'description',
        'swift_code',
        'iban_code',
        'routing_number',
        'reference_id',
        'type',
        'status',
    ];

    protected $casts = [
        'status' => TransferStatus::class,
        'type' => TransferType::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
