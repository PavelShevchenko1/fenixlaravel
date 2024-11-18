<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FxFcmNotificationAttempt extends Model
{
    use HasFactory;

    protected $casts = [
        'planned' => 'datetime',
        'sended' => 'datetime',
    ];


    public function notification() {
        return $this->belongsTo(FxFcmNotification::class, 'notification_id');
    }
}
