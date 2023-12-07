<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Requests\front\NotificationRequest;
use Auth;


class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
         
    }

    public function createMessage(NotificationRequest $request)
    {
        
        try{
           Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'طرح رسالة جديدة',
                'notifyMsg' => 'تم طرح الرسالة  '.$request->title.' بنجاح  '
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل طرح الرسالة    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
 
    }
}
