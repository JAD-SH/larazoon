<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\SubCategoryObserver;

class SubCategory extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        SubCategory::observe(SubCategoryObserver::class);
    }
    
    protected $fillable = [
        'title',
        'icon',
        'color',
        'description',
        'active',
        'slug',
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
        'icon',
        'color',
        'description',
        'active',
        'slug',
        'created_at',
    );}

    public function categories(){ 
        return $this ->hasMany('App\Models\Category','subcategory_id','id'); 
    }

}
