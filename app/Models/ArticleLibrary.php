<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Observers\ArticleLibraryObserver;


class ArticleLibrary extends Model
{
    use HasFactory;

    
    protected static function boot()
    {
        parent::boot();
        ArticleLibrary::observe(ArticleLibraryObserver::class);
    }
    

    protected $fillable = [
        'title',
        'active',
        'slug',
        'description',
        'created_at',
        'updated_at',
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
        'active',
        'slug',
        'description',
        'created_at',
        );
    }

    public function articles(){ 
        return $this ->hasMany('App\Models\Article','library_id','id'); 
    }
    
    public function maincategory(): MorphToMany
    {
        return $this->morphToMany(MainCategory::class, 'mainable');
    }
}
