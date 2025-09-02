<?php

namespace App\Enum;

enum CardType: string
{
    case Virtual = 'virtual';
    case Physical = 'physical';

    public function label(): string
    {
        return match ($this) {
            self::Virtual => 'Virtual Card',
            self::Physical => 'Physical Card',
        };
    }

    public function badge(): string
    {
        return match ($this) {
            self::Virtual => 'badge bg-info-subtle text-info fs-12 p-1',
            self::Physical => 'badge bg-primary-subtle text-primary fs-12 p-1',
        };
    }
}
