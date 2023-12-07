<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use Cookie;


class LoginController extends Controller
{

    
    public function showAdminLogin(){

        return view('admin.login');
    } 

    public function login(Request $request){
        
        $remember_me=$request->has('remember_me')? true: false;
        $check=auth()->guard('admin') -> attempt([
            'email' => strip_tags($request->email),
            'password' => strip_tags($request->password)
        ],$remember_me);
        
        if($check){
            $admin = Admin::where('email',$request->email)->select('name')->get()->values();
            $name = implode((array) $admin[0]->name);
            //notify()->success('تم الدخول بنجاح');
            if($remember_me){
                Cookie::queue('email',$request->email,43200);
                Cookie::queue('password',$request->password,43200);
            }

            return redirect() -> route('dashboard')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تم تسجيل الدخول','notifyMsg' => 'مرحبا  '.$name.'  تم الدخول الى لوحة التحكم بنجاح '
            ]);
        }
        //notify()->error('خطأ في البيانات برجاء المحاولة مجددا');
        return redirect()->back()
        ->with([
            'notifyType' => 'dangerToast','notifyTitle' => 'فشل تسجيل الدخول','notifyMsg' => 'خطأ في البيانات برجاء المحاولة مجددا'
        ]);
        
    } 
    
    
}
/*
php artisan tinker
$admin = new App\Models\Admin();
$admin -> name ="amjad";
$admin -> email ="admin@admin.com";
$admin -> password =bcrypt("1357924680");
$admin ->save();
*/