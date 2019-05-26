<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class Admin_Notification extends DatabaseNotification
{
    protected $table = 'admin_notifications';

    public function admin()
    {
        return $this->belongsTo('App\Admin', 'notifiable_id');
    }
}
