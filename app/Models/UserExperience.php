<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'experience',
        'reaction',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function getReactionAttribute($value){
        
        switch($value){
            case 1:
                return 'fa-solid fa-face-sad-tear text-danger';
            case 2:
                return 'fa-solid fa-meh text-warning';
            case 3:
                return 'fa-solid fa-sharp fa-light fa-face-smile text-info';
            case 4:
                return 'fa-solid fa-face-grin-hearts text-success';
            default:
                return '';
        }
    }

    public function user(){ 
        return $this ->belongsTo('App\Models\User','user_id','id'); 
    }

}
