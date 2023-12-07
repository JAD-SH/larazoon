<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TryItCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'code',
        'type',
        'code1',
        'type1',
        'code2',
        'type2',
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
            'code',
            'type',
            'code1',
            'type1',
            'code2',
            'type2',
        );
    }

    /*public function lesson(){ 
        return $this ->belongsTo('App\Models\Lesson',','id'); 
    }*/

    public function lesson(): MorphToMany
    {
        return $this->morphedByMany(Lesson::class, 'tryitable');
    }
    public function category(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'tryitable');
    }
    public function article(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'tryitable');
    }
}
