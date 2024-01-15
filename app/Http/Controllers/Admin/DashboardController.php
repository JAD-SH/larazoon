<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use Session;

class DashboardController extends Controller
{
    
    protected function SiteInformation(){
        return $data = [
            'site_name'=>'sitename',
            'ar_site_name'=>'اسم الموقع',
            'site_description'=>',هذا وصف عن الموقع بشكل عام',
            'site_photo'=>'images/site/CS8eBzzYIfzQJ5VsASmbz7AvEKHpgvtaPqxb4xJg.jpg',
            'site_logo'=>'images/site/pc4giAPoJVvNCoLX6QdIsyt4tos2cywkA3fQ8jD5.png',
            'facebook'=>'https://facebook.com/JAD-SH',
            'twitter'=>'https://twitter.com/JAD-SH',
            'instagram'=>'https://instagram.com/JAD-SH',
            'github'=>'https://github.com/JAD-SH',
            //'site_sm_logo'=>'-',
            'user_profile_background'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
        ];
    }
   
    public function __construct() {
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-dashboard-section');
            return $next($request);
        });
    }

    public function index(){

        if(Site::count() == 0){
            $Site_info = $this->SiteInformation();
            Site::create([
                'site_name'=> $Site_info['site_name'],
                'ar_site_name'=> $Site_info['ar_site_name'],
                'site_description'=> $Site_info['site_description'],
                'site_photo'=> $Site_info['site_photo'],
                'site_logo'=> $Site_info['site_logo'],
                //'site_sm_logo' => $Site_info['site_sm_logo'],
                'facebook'=> $Site_info['facebook'],
                'twitter'=> $Site_info['twitter'],
                'instagram'=> $Site_info['instagram'],
                'github'=> $Site_info['github'],
                'user_profile_background' => $Site_info['user_profile_background'],
            ]);
        }

        return view('admin.dashboard');
    }
}
