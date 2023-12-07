<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course_id',
        'active',
        'created_at',
        'updated_at',
    ];
 
    public function getActive(){ 
        return $this-> active == 1 ? 'مفعل' : 'غير مفعل';
    }
    
    public function scopeActive($query){
        return $query -> where('active',1);
    }
    
    public function scopeSelection($query){
        return $query -> select('id',
        'title',
        'course_id',
        'active',
        'created_at',
        'updated_at',
        );
    }
    public function course(){ 
        return $this ->belongsTo('App\Models\Course','course_id','id'); 
    }

    public function lessons(){ 
        return $this ->hasMany('App\Models\Lesson','group_id','id'); 
    }

    public function exams(){ 
        return $this ->hasManyThrough('App\Models\Exam','App\Models\Lesson','group_id','lesson_id','id'); 
    }


}
