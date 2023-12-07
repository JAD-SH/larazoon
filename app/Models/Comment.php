<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'code',
        'user_id',
        'watch',
        'question_id',
        'comment_id',
        'likes',

        'created_at',
        'updated_at',
    ];

    protected $hidden = [
    ];
    
    
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->diffInHours(),
        );
    }

    public function scopeSelection($query){
        return $query -> select('id',
        'comment',
        'code',
        'likes',
        'user_id',
        'watch',
        'question_id',
        'comment_id',
        'created_at',
        'updated_at',
        );
    }

    public function question(){ 
        return $this ->belongsTo('App\Models\Question','question_id','id'); 
    }
    public function user(){ 
        return $this ->belongsTo('App\Models\User','user_id','id')->select('id','name','username','photo','interest','active','user_appear'); 
    }
    public function comment_replies(){ 
        return $this ->hasMany($this,'comment_id','id'); 
    }

}
