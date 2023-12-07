<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class Article extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title',
        'active',
        'slug',
        'views',
        'likes',
        'photo',
        'description',
        'content',
        'style',
        'script',
        'library_id',
        //'pointing',
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
        'active',
        'slug',
        'views',
        'content',
        'style',
        'script',
        'likes',
        'photo',
        'library_id',
        'created_at',

        'description',
        //'pointing',

        );
    }

    protected function getPhotoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
    
    public function articlelibrary(){ 
        return $this ->belongsTo('App\Models\ArticleLibrary','library_id','id'); 
    }

    public function tryitCodes(): MorphToMany
    {
        return $this->morphToMany(TryItCode::class, 'tryitable');
    }
    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

}
