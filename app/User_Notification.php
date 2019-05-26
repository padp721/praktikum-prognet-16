<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class User_Notification extends DatabaseNotification
{
    protected $table = 'user_notifications';

    public function user()
    {
        return $this->belongsTo('App\User', 'notifiable_id');
    }
}
