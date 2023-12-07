<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasFactory ,SoftDeletes;


    
    protected $fillable = [
        'title',

        'content',
        'style',
        'script',
        'description',
        'photo',

        'active',
        'views',
        'likes',

        'subcategory_id',

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
        'photo',

        'subcategory_id',
        'created_at',

        'active',
        'views',
        'likes',

        'slug',
    );}

    protected function getPhotoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
    
    public function subcategory(){ 
        return $this ->belongsTo('App\Models\SubCategory','subcategory_id','id'); 
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
