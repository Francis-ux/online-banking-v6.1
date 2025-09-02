<?php

namespace App\Enum;

enum LoanRepaymentStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';

    public function badge(): string
    {
        return match ($this) {
            self::PENDING => '<span class="badge bg-warning-subtle text-warning fs-12 p-1">Pending</span>',
            self::PAID => '<span class="badge bg-success-subtle text-success fs-12 p-1">Paid</span>',
        };
    }
}
