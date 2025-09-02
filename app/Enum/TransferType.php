<?php

namespace App\Enum;

enum TransferType: string
{
    case InternationalTransfer = 'international_transfer';
    case LocalTransfer = 'local_transfer';

    public function label(): string
    {
        return match ($this) {
            self::InternationalTransfer => 'International Transfer',
            self::LocalTransfer => 'Local Transfer',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::InternationalTransfer => 'badge bg-primary-subtle text-primary fs-12 p-1',
            self::LocalTransfer => 'badge bg-info-subtle text-info fs-12 p-1',
        };
    }
}
