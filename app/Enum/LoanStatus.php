<?php

namespace App\Enum;

enum LoanStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Active = 'active';
    case Repaid = 'repaid';
    case Rejected = 'rejected';


    /**
     * Get bootstrap badge class for status
     */
    public function badge(): string
    {
        return match ($this) {
            self::Pending   => 'badge bg-warning-subtle text-warning fs-12 p-1',
            self::Approved  => 'badge bg-primary-subtle text-primary fs-12 p-1',
            self::Active    => 'badge bg-info-subtle text-info fs-12 p-1',
            self::Repaid    => 'badge bg-success-subtle text-success fs-12 p-1',
            self::Rejected  => 'badge bg-danger-subtle text-danger fs-12 p-1',
        };
    }

    /**
     * Get human readable label
     */
    public function label(): string
    {
        return ucfirst($this->value);
    }
}
