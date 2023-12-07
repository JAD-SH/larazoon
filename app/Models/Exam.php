<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'question',
        'right_answer',
        'wrong_answer_1',
        'wrong_answer_2',
        'wrong_answer_3',
        'lesson_id',
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
    
    public function lesson(){ 
        return $this ->belongsTo('App\Models\Lesson','lesson_id','id'); 
    }
}
