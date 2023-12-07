<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Course;
use App\Models\User;
use App\Models\Plan;
use App\Events\AddViewUserEvent;
use App\Events\AddLikeUserEvent;
use Session;
use Auth;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::forget('categorySLUG');
            return $next($request);
        });
    }
    public function showprofile($username)
    {
        try{
            if(Auth::user() && Auth::user()->username === $username){return view('front/profile');}
            $user = User::where('username',$username)->active()->UserAppear()->selection()->first();
            if($user === null){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا المسخدم  غير موجود او ربما يكون مخفي  '
                ]);
            }
            event(new AddViewUserEvent($user));
            return view('front.show_profile',compact('user'));
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل عرض المستخدم لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function AddLike($id)
    {
        try{
            $user=User::active()->UserAppear()->find($id);
            if(!$user){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'هذا المستخدم غير موجود'
                ]);
            }
            $status=event(new AddLikeUserEvent($user));
            if(!$status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'الاعجاب بالمستخدم',
                    'notifyMsg' => 'شكرا لك انت بالفعل قد اعجبت بالمستخدم   '.$user->name
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الاعجاب بالمستخدم',
                'notifyMsg' => 'شكرا للإعجاب بالمستخدم  '.$user->name
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل الإعجاب بالمستخدم    '. $user->name.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    
}
