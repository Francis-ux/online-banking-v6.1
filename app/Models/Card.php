<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Card extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'card_number',
        'expiry_date',
        'cvv',
        'type',
        'status',
        'reference_id',
        'daily_limit',
        'issuance_fee',
        'issued_at'
    ];

    protected $casts = [
        'daily_limit' => 'decimal:2',
        'issuance_fee' => 'decimal:2',
        'issued_at' => 'datetime',
        'status' => \App\Enum\CardStatus::class,
        'type' => \App\Enum\CardType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Encrypt card_number and cvv
    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = Crypt::encryptString($value);
    }

    public function getCardNumberAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function setCvvAttribute($value)
    {
        $this->attributes['cvv'] = Crypt::encryptString($value);
    }

    public function getCvvAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }
}
