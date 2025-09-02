<?php

namespace App\Models;

use App\Enum\LoanRepaymentStatus;
use Illuminate\Database\Eloquent\Model;

class LoanRepayment extends Model
{
    protected $fillable = ['uuid', 'loan_id', 'amount', 'repaid_at', 'status'];

    protected $casts = [
        'amount' => 'decimal:2',
        'repaid_at' => 'datetime',
        'status' => LoanRepaymentStatus::class,
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
