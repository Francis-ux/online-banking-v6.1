<?php

namespace App\Models;

use App\Enum\NotificationType;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'type',
        'message',
        'is_read',
    ];

    protected $casts = [
        'type' => NotificationType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
