<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\User; 
use App\Models\Supporter; 
use Session;
use Spatie\SchemaOrg\Schema;
use App\Http\Requests\front\SupporterRequest;
use Auth;

class SupporterController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('categorySLUG',MainCategory::where('route','Course')->first()->slug);
            return $next($request);
        });
        
    }
 
    public function support_us()
    {
        return view('front.support_us');
    }
   
    public function score_support()//يجب عمل هذا ميدلوير انه لايمكن لغير المسجلين دخول الذهاب اليه
    {
        return view('front.score_support');
    }
   
    public function supporters_page()
    {
        $top_supporters = User::active()->UserAppear()->where('total_donations','>',0)->orderBy('total_donations', 'desc')->limit(12)->get();
          
        return view('front.supporters',compact('top_supporters'));
    }
   
    public function all_supporters_page()
    {
        $all_supporters_before_filter = collect(User::active()->UserAppear()->where('total_donations','>',0)->orderBy('total_donations', 'desc')->get());//->slice(12)
        $all_supporters = $all_supporters_before_filter->slice(12);
        return view('front.supporters',compact('all_supporters'));
    }
    public function save_score_support(SupporterRequest $request)
    {
        try{
            //return Auth::user()->username;
            Supporter::create([
                'username' => Auth::user()->username,
                'email' => $request->email,
                'support_value' => $request->support_value,
                'support_by' => $request->support_by,
            ]);
            
            return redirect()-> route('supporters_page')
            ->with([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الداعمين',
                'notifyMsg' => 'تم ادخال بياناتك بنجاح سيتم التحقق والتأكد منها من قبل الادمن والرد عليك في مدة اقصاها 24 ساعة   '
            ]);
           
        }catch (\Exception $ex){
            return $ex;
            return redirect()-> route('supporters_page')
            ->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل ادخال البيانات لسبب ما الرجاء المحاولة لاحقا '
        
            ]);
        }
    }
   
   
}
