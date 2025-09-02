<?php

namespace App\Enum;

enum IdentityVerificationStatus: int
{
    case Approved = 1;
    case Reject = 2;
    case Pending = 3;
}
