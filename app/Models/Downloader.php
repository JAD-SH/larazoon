<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downloader extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'description',
        'file',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function scopeSelection($query){
        return $query -> select('id',
            'title',
            'slug',
            'description',
            'file',
        );
    }

    protected function getFileAttribute($value){
        return ($value !== null) ? public_path('assets/'.$value) : '';
    }
}
