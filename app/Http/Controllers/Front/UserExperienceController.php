<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserExperience;
use App\Models\User;
use App\Http\Requests\front\UserExperienceRequest;
use Auth;

class UserExperienceController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','verified']);
         
    }
    public function user_experience_page()
    {
        $experiences = UserExperience::orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
        return view('front.user_experience',compact('experiences'));
    }
    public function createExperience(UserExperienceRequest $request)
    {
        try{
           $experience = UserExperience::where('user_id',Auth::user()->id)->first();
           if($experience){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'تم من قبل',
                    'notifyMsg' => 'انت بالفعل قمت بنشر تجربتك من قبل . ولا يمكنك نشر تجربتك في الموقع اكثر من مرة واحدة'
                ]);
            }
            UserExperience::create([
                'reaction' => $request->reaction,
                'experience' => $request->experience,
                'user_id' => Auth::user()->id,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'نشر تجربتك',
                'notifyMsg' => 'تم نشر تجربتك بنجاح  '
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل نشر تجربتك لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
    }
    public function deleteExperience()
    {
        try{
            $experience = UserExperience::where('user_id',Auth::user()->id)->first();
            $experience_id = $experience->id;
            if($experience == null){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'عذرا ... هذه التجربة غير موجودة'
                ]);
            }
            $experience ->delete();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حذف التجربة ',
                'notifyMsg' => 'تم حذف التجربة بنجاح ',
                'item_id'=>$experience_id
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل حذف التجربة .... الرجاء المحاولة لاحقا'
            ]);
        }
    }


}
