<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationReply extends Model
{
    use HasFactory;

       
    protected $fillable = [
        'message',
        'code',
        'notification_id',

        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function notification(){ 
        return $this ->belongsTo('App\Models\Notification','notification_id','id'); 
    }

}
