<?php

namespace App\Enum;

enum CardStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';
    case Blocked = 'blocked';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Blocked => 'Blocked',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Pending => 'badge bg-warning-subtle text-warning fs-12 p-1',
            self::Active => 'badge bg-success-subtle text-success fs-12 p-1',
            self::Inactive => 'badge bg-secondary-subtle text-secondary fs-12 p-1',
            self::Blocked => 'badge bg-danger-subtle text-danger fs-12 p-1',
        };
    }
}
