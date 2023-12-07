<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Str;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-users-section');
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    //يجب المتابعة من هنا  بحيث التعديل على الدوال التالية بحيث تعمل بالشكل المطلوب ..  بالأضافة الى اشاء راوتات لكل دالة ... بالأضافة الى الانتباه انه يجب حل مشكلة ان الدوال المتشابهة في  url تقوم بإظهار نفس الدالة


    public function index()
    {
        $users = User::paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function female()
    {
        $users = User::where('gender','1')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function male()
    {
        $users = User::where('gender','0')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function top_views()
    {
        $users = User::orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function top_likes()
    {
        $users = User::orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function blocked()
    {
        $users = User::where('active','0')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function front_end()
    {
        $users = User::where('interest','Front End')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function back_end()
    {
        $users = User::where('interest','Back End')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function full_stuck()
    {
        $users = User::where('interest','Full Stuck')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }
    public function programming()
    {
        $users = User::where('interest','Programming')->paginate(PAGINATION_COUNT);
        return view('admin.user.index',compact('users'));
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = User::selection()->find($id);
            //return $user->photo;
            if(!$user){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا المستخدم غير موجود    '            
                ]);
            }
            return view('admin.profile',compact('user'))->with([
                'notifyType' => 'successToast',
                'notifyTitle' => 'عرض مستخدم  ',
                'notifyMsg' => 'هذا الملف الشخصي الخاص بالمستخدم  '.$user->title    
            ]);
        }catch (\Exception $ex){
            return redirect()-> back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل عرض الملف الشخصي لسبب ما .... يرجى المحاولة لاحقا '
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id);
            if(!$user){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا المستخدم غير موجود    '
                ]);
            }

            $user ->delete();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حذف المستخدم ',
                'notifyMsg' => 'تم حذف المستخدم  '.$user->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل حذف المستخدم    '. $user->title.'  لسبب ما ... يرجى المحاولة لاحقا '
            ]);
        }
    }
   

    public function changeStatus($id)
    {
        //return 'aaaaaa';
        try{
            $user = User::find($id);

            if(!$user){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا المستخدم غير موجود    '
                ]);
            }
                
            $status=$user->active == 0 ? '1' : '0';
            
            $user->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تغيير حالة المستخدم  ',
                'notifyMsg' => 'تم بنجاح... المستخدم    '.$user->getActive().'  الان  ',
                'active'=>$user->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تغيير حالة المستخدم    '. $user->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }


}
