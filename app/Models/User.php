<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\UserAccountState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'email_code',
        'registration_token',
        'dob',
        'gender',
        'marital_status',
        'dial_code',
        'phone',
        'professional_status',
        'address',
        'state',
        'nationality',
        'currency',
        'account_type',
        'password',
        'password_text',
        'should_login_require_code',
        'login_code',
        'should_transfer_fail',
        'transfer_pin',
        'transfer_pin_text',
        'transfer_pin_reset_by_admin',
        'account_number',
        'is_account_verified',
        'account_state',
        'account_state_reason',
        'balance',
        'image',
        'id_front',
        'id_back',
        'is_ID_verified',
        'last_login_time',
        'last_login_device',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'transfer_pin'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'account_state' => UserAccountState::class
        ];
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
}
