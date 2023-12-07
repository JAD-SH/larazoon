<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'active',
        'description',
        'created_at',
        'updated_at',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getActive(){ 
        return $this-> active == 1 ? 'مفعل' : 'غير مفعل';
    }
    
    public function scopeActive($query){
        return $query -> where('active',1);
    }

    public function courses(){ 
        return $this ->belongsToMany('App\Models\Course','App\Models\Plan_Course','plan_id','course_id','id'); 
    }

    public function users(){ 
        return $this ->hasMany('App\Models\User','plan_id','id')->select('id','name','username','photo','interest','active','user_appear'); //يمكن هاد select مالو داعي ويمكن يعمل اخطاء
    }
    
    
}
