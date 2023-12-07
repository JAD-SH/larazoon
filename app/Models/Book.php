<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory , SoftDeletes;


    
    protected $fillable = [
        'title',
        'photo',
        'file',
        'active',
        'language',
        'downloads',
        'likes',
        'author',
        'description',
        'views',
        'slug',
        'library_id',
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
        return $query -> select('books.id',
        'title',
        'photo',
        'file',
        'active',
        'language',
        'downloads',
        'likes',
        'author',
        'description',
        'views',
        'slug',
        'library_id',//اذا لم تمرر هذا المتغير فستفشل العلاقة
        'books.created_at',

    );}

    protected function getPhotoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
    protected function getFileAttribute($value){
        return ($value !== null) ? public_path('assets/'.$value) : '';
    }

    public function booklibrary(){ 
        return $this ->belongsTo('App\Models\BookLibrary','library_id','id'); 
    }

}
