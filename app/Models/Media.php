<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'slug',
        'type',
        'media',
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
            'type',
            'media',
        );
    }
     
    public function getType(){ 
        $type = substr($this-> type, 0, strpos($this-> type, '/'));
        switch ($type) {
            case 'image':
                return 'صور';
                break;
            case 'video':
                return 'فيديو';
                break;
            case 'audio':
                return 'صوت';
                break;
            default:
                return 'غير معروف';
                break;
        }
    }
 
    protected function getMediaAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
    }
    
}
