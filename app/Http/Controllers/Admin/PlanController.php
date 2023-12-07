<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\PlanRequest;

use App\Models\Plan;
use App\Models\Course;
use App\Models\Plan_Course;
use Session;


class PlanController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-plans-section');
            return $next($request);
        });
    }
    //

    public function index()
    {
        $plans = Plan::paginate(PAGINATION_COUNT);
        
        return view('admin.plan.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_plan_course($plan_id)
    {
        $courses = Course::select('id','title')->get();
        return view('admin.plan.create',compact('courses','plan_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        try{
            //return $request;
            Plan::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'إضافة خطة تعلم ','notifyMsg' => 'تم إضافة خطة تعلم بنجاح  '
            ]);
            
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل إضافة خطة تعلم    '
            ]);
        }
            
            
        
    }

    public function show($id)
    { 
        $plan= Plan::with('users') ->find($id);

        if(!$plan){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه الخطة غير موجودة    '
            ]);
        }
        $users = $plan->users()->selection()->paginate(PAGINATION_COUNT);
        return view('admin.plan.followers',compact('users'));
    }


    public function store_plan_course(Request $request)
    {
        try{
           // return 'aaaaaaaaaa';
            $plan = Plan::find($request->plan_id);
             $request_count= count($request->except('_token','plan_id'));
            if(!$request_count > 0 && !$plan){
                return redirect()-> back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل إضافة كورسات للخطة    '
                ]);
            }
            Plan_Course::where('plan_id',$plan->id)->delete();
            
            $plan->courses()->syncWithoutDetaching($request->courses);
            
            return redirect()-> route('Plan-dashboard.index')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'إضافة كورسات للخطة ','notifyMsg' => 'تم إضافة كورسات للخطة بنجاح  '
            ]);
            
        }catch (\Exception $ex){
            //return $ex;
            return redirect()-> back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل إضافة كورسات للخطة    '
            ]);
        }
            
            
        
    }
/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //return $request;
       try{
        $plan = Plan::find($id);
            if(!$plan){
                return redirect()-> back()-> with([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذه الخطة غير موجودة    '
                ]);
            }

            $plan ->update([
                'title'=> $request->title,
                'description'=> $request->description,
            ]);
            return redirect()-> back()-> with([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تعديل الخطة ',
                'notifyMsg' => 'تم تعديل الخطة  '.$plan->title.'  بنجاح ',
            ]);
        }catch (\Exception $ex){
            return redirect()-> back()-> with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تعديل الخطة    '. $plan->title.'  لسبب ما يرجى المحاولة لاحقا '
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
            $plan = Plan::find($id);
            if(!$plan){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذه الخطة غير موجودة    '
                ]);
            }

            $plan ->delete();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حذف الخطة ',
                'notifyMsg' => 'تم حذف الخطة  '.$plan->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل حذف الخطة    '. $plan->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function changeStatus($id)
    {
        try{
            $plan = Plan::find($id);
            if(!$plan){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذه الخطة غير موجودة    '
                ]);
            }
                
            $status=$plan->active == 0 ? '1' : '0';
            
            $plan->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تغيير حالة الخطة  ',
                'notifyMsg' => 'تم بنجاح... الخطة    '.$plan->getActive().'  الأن  ',
                'active'=>$plan->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تغيير حالة الخطة    '. $plan->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
}
