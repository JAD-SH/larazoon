<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'watch',
        'owner_id',
        'question_id',
        'created_at',
        'updated_at',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
    ];

    public function owner(){ 
        return $this ->belongsTo('App\Models\User','owner_id','id')->select('id','name','username','photo','interest','active','user_appear'); 
    }
    

}
