<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Observers\MainCategoryObserver;



class MainCategory extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }
    
    protected $fillable = [
        'title',
        'route',
        'light_photo',
        'dark_photo',
        'icon',
        'color',
        'description',
        'active',
        'slug',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
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
        'route',
        'light_photo',
        'dark_photo',
        'icon',
        'color',
        'description',       
        'created_at',
        'updated_at',

        'slug',
        'active'
    );}

    protected function getLightPhotoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
    }
    protected function getDarkPhotoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
    }
    /*
    تأكد من اهمية هذه العلاقة
    public function library(){ 
        return $this ->belongsTo('App\Models\Library','library_id','id'); 
    }
    */

    public function articlelibraries(): MorphToMany
    {
        return $this->morphedByMany(ArticleLibrary::class, 'mainable');
    }

    public function courses(): MorphToMany
    {
        return $this->morphedByMany(Course::class, 'mainable');
    }

    public function questionlibraries(): MorphToMany
    {
        return $this->morphedByMany(QuestionLibrary::class, 'mainable');
    }

    public function booklibraries(): MorphToMany
    {
        return $this->morphedByMany(BookLibrary::class, 'mainable');
    }

}
