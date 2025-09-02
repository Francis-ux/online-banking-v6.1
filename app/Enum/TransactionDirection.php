<?php

namespace App\Enum;

enum TransactionDirection: string
{
    case Credit = 'credit';
    case Debit = 'debit';

    public function label(): string
    {
        return match ($this) {
            self::Credit => 'Credit',
            self::Debit => 'Debit',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Credit => '<span class="badge bg-success-subtle text-success fs-12 p-1">Credit</span>',
            self::Debit => '<span class="badge bg-danger-subtle text-danger fs-12 p-1">Debit</span>',
        };
    }
}
