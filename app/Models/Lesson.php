<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Lesson extends Model
{
    use HasFactory ,SoftDeletes;


      
    protected $fillable = [
        'title',

        'content',
        'style',
        'script',
        'description',
        'about',
        'photo',

        'active',
        'views',
        'likes',

        'group_id',
        'lesson_id',

        'slug',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'deleted_at',
    ];
    protected $hidden = [
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

        'content',
        'style',
        'script',
        'description',
        'about',
        'photo',

        'group_id',
        'created_at',
        'lesson_id',
        'group_id',
        'active',
        'views',
        'likes',

        'slug',
    );}

    protected function getPhotoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
    
    public function group(){ 
        return $this ->belongsTo('App\Models\LessonGroup','group_id','id'); 
    }
 

    /*public function course(){ 
        return $this ->belongsTo('App\Models\Course','group_id','id'); 
    }*/

    public function exams(){ 
        return $this ->hasMany('App\Models\Exam','lesson_id','id'); 
    }
    /*public function tryitCodes(){ 
        return $this ->hasMany('App\Models\TryItCode','lesson_id','id'); 
    }*/
    public function tryitCodes(): MorphToMany
    {
        return $this->morphToMany(TryItCode::class, 'tryitable');
    }
    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
    public function accessors()
    {
        return $this->hasMany(self::class, 'lesson_id');
    }
    public function lesson()
    {
        return $this->belongsTo(self::class, 'lesson_id');
    }
}
