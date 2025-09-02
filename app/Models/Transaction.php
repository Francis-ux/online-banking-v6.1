<?php

namespace App\Models;

use App\Enum\TransactionDirection;
use App\Enum\TransactionStatus;
use App\Enum\TransactionType;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'type',
        'direction',
        'description',
        'amount',
        'current_balance',
        'transaction_at',
        'reference_id',
        'status',
    ];

    protected $casts = [
        'status' => TransactionStatus::class,
        'direction' => TransactionDirection::class,
        'type' => TransactionType::class
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transfer()
    {
        return $this->belongsTo(Transfer::class, 'reference_id', 'reference_id');
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'reference_id', 'reference_id');
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class, 'reference_id', 'reference_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'reference_id', 'reference_id');
    }
}
