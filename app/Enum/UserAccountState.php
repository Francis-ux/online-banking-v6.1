<?php

namespace App\Enum;

enum UserAccountState: int
{
    case Active = 1;
    case Disabled = 2;
    case Kyc = 3;
    case Frozen = 4;

    public function badge(): string
    {
        return match ($this) {
            self::Active => '<span class="badge bg-success-subtle text-success px-2 py-1 fs-12">Active</span>',
            self::Disabled => '<span class="badge bg-danger-subtle text-danger px-2 py-1 fs-12">Disabled</span>',
            self::Kyc => '<span class="badge bg-warning-subtle text-warning px-2 py-1 fs-12">KYC Pending</span>',
            self::Frozen => '<span class="badge bg-secondary-subtle text-secondary px-2 py-1 fs-12">Frozen</span>',
        };
    }
}
