<?php

namespace App\Enum;

enum TransferStatus: string
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Failed = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Completed => 'Completed',
            self::Failed => 'Failed',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Pending => 'badge bg-warning-subtle text-warning fs-12 p-1',
            self::Completed => 'badge bg-success-subtle text-success fs-12 p-1',
            self::Failed => 'badge bg-danger-subtle text-danger fs-12 p-1',
        };
    }
}
