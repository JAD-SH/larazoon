<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'ar_site_name',
        'site_description',
        'site_photo',
        'site_logo',
        //'site_sm_logo',
        'user_profile_background',
        'created_at',
        'updated_at',
        
    ];

    protected function getSiteSmLogoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
    protected function getSiteLogoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
    protected function getSitePhotoAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
    protected function getUserProfileBackgroundAttribute($value){
        return ($value !== null) ? asset('public/assets/'.$value) : '';
        
    }
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
