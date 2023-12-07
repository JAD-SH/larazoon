<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supporter; 
use Session;
use App\Http\Requests\admin\SupporterRequest;
use Illuminate\Http\Request;

class SupporterController extends Controller
{
     
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-supporters-section');
            return $next($request);
        });
    }
    public function index()
    {
        $supporters = Supporter::paginate(PAGINATION_COUNT);
        return view('admin.supporter.index',compact('supporters'));
    }
    public function supporter_archive($user_id)
    {
        $supporter_archive = Supporter::where('user_id',$user_id)->get();
        return view('admin.supporter.supporter_archive',compact('supporter_archive'));
    }
   
    public function verification(Request $request ,$id)
    {
        try{
            $supporter = Supporter::find($id);
            if(!$supporter){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الداعم غير موجود    '
                ]);
            }
            if($request->verification != 1 && $request->verification != 2){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'تحقق خاطئ'
                ]);
            }
                
            if($request->verification == 1){
                $supporter->update([
                    'massage'=> 'نعتذر منكم .. لم يتم اكتشاف اي عملية دعم خاصة بهذا البريد الالكتروني . قم بالتأكد من البريد الالكتروني الذي قمت بإدخاله ووسيلة الدعم وشكرا'
                ]);
            }elseif($request->verification == 2){
                $supporter->update([
                    'massage'=> 'شكرا لكرمكم .. تم التأكد من عملية الدعم الخاصة بهذا البريد الالكتروني نعمل بجد من اجل ارتقاء موقعكم ليصل للمستوى المطلوب وشكرا'
                ]);
            }
            //return $supporter;
            $supporter->update([
                'verification'=>$request->verification
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تعديل قيمة الدعم  ','notifyMsg' => 'تم تعديل قيمة الدعم بنجاح  ',
                'active'=>$supporter->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تعديل قيمة الدعم لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
   
    public function edit_value(SupporterRequest $request ,$id)
    {
        try{
            $supporter = Supporter::find($id);
            if(!$supporter){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الداعم غير موجود'
                ]);
            } 
            $supporter ->update([
                'support_value' => $request->support_value,
            ]);
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => ' التعديل على قيمة الدعم ','notifyMsg' => 'تم التعديل على قيمة الدعم بنجاح '
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل التعديل على قيمة الدعم لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

}
