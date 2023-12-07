<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Observers\CourseObserver;


class Course extends Model
{
    use HasFactory;

      
    protected static function boot()
    {
        parent::boot();
        Course::observe(CourseObserver::class);
    }
    

    protected $fillable = [
        'title',
        'photo',
        'color',

        
        'description',

        'active',
        'slug',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'updated_at',
        //'pivot',
    ];

    public function getActive(){ 
        return $this-> active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function scopeActive($query){
        return $query -> where('active',1);
    }
    
    public function scopeSelection($query){
        return $query -> select('courses.id',
        'title',
        'photo',
        'color',
        'description',
        'active',
        'slug',
        'courses.created_at',

    );}

    protected function getPhotoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
    }
    
    
    public function lessons(){
        return $this -> hasManyThrough('App\Models\Lesson','App\Models\LessonGroup','course_id','group_id','id','id');
    }

    public function groups(){ 
        return $this ->hasMany('App\Models\LessonGroup','course_id','id'); 
    }

    public function users(){ 
        return $this ->belongsToMany('App\Models\User','App\Models\User_Course','course_id','user_id','id')->select('id','name','username','photo','interest','active','user_appear'); 
    }

    public function plans(){ 
        return $this ->belongsToMany('App\Models\Plan','App\Models\Plan_Course','course_id','plan_id','id'); 
    }
    public function user_course(){ 
        return $this ->hasOne('App\Models\User_Course','course_id','id'); 
    }
    
    
    public function maincategory(): MorphToMany
    {
        return $this->morphToMany(MainCategory::class, 'mainable');
    }
}
