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
        $this->middleware(['auth','verified'])->only(['score_support']);
        $this->middleware(function ($request, $next){
            Session::put('categorySLUG',MainCategory::where('route','Course')->first()->slug);
            return $next($request);
        });
        
    }
    public function support_us()
    {
        return view('front.support_us');
    }
    public function score_support()
    {
        return view('front.score_support');
    }
    public function supporters_page()
    {
        $top_supporters = Supporter::with(['user' => function($query){
            $query -> active()->UserAppear(); 
        }])->where('verification',2)->orderBy('support_value','desc')->limit(12)->get();
        return view('front.supporters',compact('top_supporters'));
    }
    public function supporter_archive($username)
    {
        try{
            $user = User::where('username',$username)->active()->UserAppear()->selection()->first();
            if(!$user){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا المسخدم  غير موجود او ربما يكون مخفي  '
                ]);
            }
            if(Auth::user() && $user->id == Auth::user()->id){
                $supports_not_watch = Supporter::where('user_id',Auth::user()->id)->where('watch','0')->get();
                foreach ($supports_not_watch as $support) {
                    $support->update([
                        'watch' => '1'
                    ]);
                }
            }
            return view('front.supporter_archive',compact('user'));
        }catch (\Exception $ex){
            return redirect()-> back()->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل عرض سجل الدعم الخاص بالمستخدم لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function all_supporters_page()
    {
        try{
            $all_supporters_before_filter = collect(Supporter::with(['user' => function($query){
                $query -> active()->UserAppear(); 
            }])->where('verification',2)->orderBy('support_value', 'desc')->get());
            $all_supporters = $all_supporters_before_filter->slice(12);
            return view('front.supporters',compact('all_supporters'));
        }catch (\Exception $ex){
            return redirect()-> back()->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل عرض سجل الداعمين لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function save_score_support(SupporterRequest $request)
    {
        try{
            Supporter::create([
                'user_id' => Auth::user()->id,
                'email' => $request->email,
                'support_value' => $request->support_value,
                'support_by' => $request->support_by,
            ]);
            return redirect()-> route('supporters_page')->with([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الداعمين',
                'notifyMsg' => 'تم ادخال بياناتك بنجاح سيتم التحقق والتأكد منها من قبل الادمن والرد عليك في مدة اقصاها 24 ساعة   '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('supporters_page')->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل ادخال البيانات لسبب ما الرجاء المحاولة لاحقا '
            ]);
        }
    }
   
   
}
