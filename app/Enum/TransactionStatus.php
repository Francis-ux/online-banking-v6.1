<?php

namespace App\Enum;

enum TransactionStatus: string
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Failed = 'failed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Completed => 'Completed',
            self::Failed => 'Failed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Pending => '<span class="badge bg-warning-subtle text-warning fs-12 p-1">Pending</span>',
            self::Completed => '<span class="badge bg-success-subtle text-success fs-12 p-1">Completed</span>',
            self::Failed => '<span class="badge bg-danger-subtle text-danger fs-12 p-1">Failed</span>',
            self::Cancelled => '<span class="badge bg-secondary-subtle text-secondary fs-12 p-1">Cancelled</span>',
        };
    }
}
