<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens'; // Ensure the table name is correct

    public $timestamps = false; // The table doesn't have `created_at` and `updated_at` timestamps by default

    protected $primaryKey = 'email'; // Specify the primary key as `email`
    public $incrementing = false; // Tell Eloquent that the primary key is not auto-incrementing
    protected $keyType = 'string'; // Since the primary key is a string

    protected $fillable = ['email', 'token', 'created_at'];

     protected $casts = [
        'created_at' => 'datetime',
    ];
}
