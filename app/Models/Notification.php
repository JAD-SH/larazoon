<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

       
    protected $fillable = [
        'title',
        'message',
        'type',
        'watch',
        'user_id',

        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function getType(){ 
        switch($this-> type){
            case 'ask':
                return 'اسأل الادمن ';
            case 'message':
                return 'ابلاغات المستخدمين عن مشكلة';
            default:
                return '__';
        }
    }

    public function getWatch(){ 
        return $this-> watch == 1 ? 'تم مشاهدته من قبل' : 'لم يتم مشاهدته بعد';
    }
    
    public function scopeWatch($query){
        return $query -> where('watch',0);
    }
    
    public function user(){ 
        return $this ->belongsTo('App\Models\User','user_id','id')->select('id','name','username','photo','interest','active','user_appear'); 
    }
    
    public function notificationreply(){ 
        return $this ->hasOne('App\Models\NotificationReply','notification_id','id'); 
    }


}
