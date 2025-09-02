<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'loan_interest_rate',
        'virtual_card_fee',
        'physical_card_fee',
    ];
}
