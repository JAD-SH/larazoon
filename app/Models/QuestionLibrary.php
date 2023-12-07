<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Observers\QuestionLibraryObserver;



class QuestionLibrary extends Model
{
    use HasFactory;

    
    protected static function boot()
    {
        parent::boot();
        QuestionLibrary::observe(QuestionLibraryObserver::class);
    }
    

    protected $fillable = [
        'title',
        'active',
        'description',
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
        'active',
        'description',
        'slug',
        'created_at',
        );
    }

    public function questions(){ 
        return $this ->belongsToMany('App\Models\Question','App\Models\QuestionLibrary_Question','library_id','question_id','id'); 
    }
    
    public function maincategory(): MorphToMany
    {
        return $this->morphToMany(MainCategory::class, 'mainable');
    }
}
