<?php

namespace App\Models;

use App\Enum\LoanStatus;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'amount',
        'interest_rate',
        'duration_months',
        'total_repayable',
        'purpose',
        'status',
        'reference_id',
        'disbursed_at',
        'due_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'total_repayable' => 'decimal:2',
        'disbursed_at' => 'datetime',
        'due_at' => 'datetime',
        'status' => LoanStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanRepayments()
    {
        return $this->hasMany(LoanRepayment::class);
    }
}
