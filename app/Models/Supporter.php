<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'support_value',
        'support_by',
        'verification',
        'user_id',
        'massage',
        'watch',

        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
     
    public function user(){ 
        return $this ->belongsTo('App\Models\User','user_id','id')->select('id','name','facebook','twitter','instagram','github','username','photo','interest','active','user_appear'); 
    }
}
