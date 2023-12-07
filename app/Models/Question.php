<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Question extends Model
{
    use HasFactory ,SoftDeletes ,HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected $fillable = [
        'title',
        'views',
        'likes',
        'user_id',
        'description',
        'active',
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
    
    public function getDescription(){ 
        if(strlen($this-> description) >150)
            return mb_substr($this-> description,0,150).'...';
        return $this-> description;
    }

    public function scopeActive($query){
        return $query -> where('active',1);
    }
    
    public function scopeSelection($query){
        return $query -> select('questions.id',
        'title',
        'views',
        'likes',
        'user_id',
        'description',
        'active',
        'slug',
        'questions.created_at',

    );}
   
    public function user(){ 
        return $this ->belongsTo('App\Models\User','user_id','id')->select('id','name','username','photo','interest','active','user_appear'); 
    }
   
    public function comments(){ 
        return $this ->hasMany('App\Models\Comment','question_id','id')->orderBy('likes', 'desc'); 
    }
    
    public function questionlibraries(){ 
        return $this ->belongsToMany('App\Models\QuestionLibrary','App\Models\QuestionLibrary_Question','question_id','library_id','id'); 
    }
    
}
