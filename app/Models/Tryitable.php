<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryitable extends Model
{
    use HasFactory;

    protected $fillable = [
        'try_it_code_id',        
        'tryitable_type',        
        'tryitable_id',        
        'created_at',        
        'updated_at',        
    ];

    
    protected $hidden = [
        'updated_at',
    ];

    
    public function tryitable(){ 
        return $this ->morphTo(); 
    }
}
