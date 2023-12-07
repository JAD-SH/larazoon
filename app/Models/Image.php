<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    protected $fillable = [
        'slug',
        'image',
        'created_at',
        'updated_at',
    ];
   
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function scopeSelection($query){
        return $query -> select('id',
            'slug',
            'image',
        );
    }

    protected function getImageAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
     
    public function lesson(): MorphToMany
    {
        return $this->morphedByMany(Lesson::class, 'imageable');
    }
    public function category(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'imageable');
    }
    public function article(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'imageable');
    }
}
