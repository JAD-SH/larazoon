<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savedable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',        
        'savedable_type',        
        'savedable_id',        
        'created_at',        
        'updated_at',        
    ];

    
    protected $hidden = [
        'updated_at',
    ];

    
    public function savedable(){ 
        return $this ->morphTo(); 
    }

}
