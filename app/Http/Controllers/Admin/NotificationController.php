<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\NotificationReply;
use App\Http\Requests\admin\NotificationReplyRequest;
use Session;

class NotificationController extends Controller
{
    

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-notifications-section');
            return $next($request);
        });
    }

    public function index()
    {

        $asks = Notification::where('type','ask')->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
        $messages = Notification::where('type','message')->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
        $all_notification= Notification::where('watch','0');
        $all_notification ->update([
            'watch' => '1',
        ]);

        return view('admin.notification',compact('asks','messages'));

    }
    public function NotificationOld()
    {

        $asks = Notification::where('type','ask')->paginate(PAGINATION_COUNT);
        $messages = Notification::where('type','message')->paginate(PAGINATION_COUNT);

        return view('admin.notification',compact('asks','messages'));

    }
    public function NotificationReply()
    {

        $asks = Notification::whereHas('notificationreply')->where('type','ask')->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
        $messages = Notification::where('type','message')->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);

        return view('admin.notification',compact('asks','messages'));

    }
    public function NotificationNotReply()
    {

        $asks = Notification::whereDoesntHave('notificationreply')->where('type','ask')->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
        $messages = Notification::where('type','message')->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);

        return view('admin.notification',compact('asks','messages'));

    }

    public function reply_message(NotificationReplyRequest $request)
    {
        try{
           // return $request;
            NotificationReply::create([
             'message' => $request->message,
             'code' => $request->code,
             'notification_id' => $request->notification_id,
             ]);
             
            // return 'aaa';
             return response() -> json([
                 'notifyType' => 'successToast',
                 'notifyTitle' => 'إضافة رد',
                 'notifyMsg' => 'تم إضافة رد بنجاح  ',
                 //'item_id'=>$request->notification_id
             ]);
            
         }catch (\Exception $ex){
             //return $ex;
             return response() -> json([
                 'notifyType' => 'dangerToast',
                 'notifyTitle' => 'فشل  ',
                 'notifyMsg' => 'فشل إضافة رد لسبب ما يرجى المحاولة لاحقا '
         
             ]);
         }

    }

}
