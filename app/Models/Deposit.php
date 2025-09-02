<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'reference_id',
        'amount',
        'proof',
        'method',
        'wallet_address',
        'card_number',
        'cvv',
        'card_expiry_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
