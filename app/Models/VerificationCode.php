<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'length',
        'nature_of_code',
        'applicable_to',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'applicable_to', 'id');
    }
}
