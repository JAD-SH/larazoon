<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Mainable;
use App\Models\MainCategory;
use App\Models\TryItCode;
use App\Models\Media;
use App\Models\Downloader;
use App\Http\Requests\admin\CourseRequest;
use Illuminate\Support\Str;
use Session;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-courses-section');
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::selection()->paginate(PAGINATION_COUNT);
        return view('admin.course.index',compact('courses'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {

        try{
            $photoPath='default_photo.PNG';
            
            if($request->has('photo'))
                $photoPath=uploadFile($request->photo,'images/courses');
            
            $main_category= MainCategory::where('route','Course')->first();

            $course=Course::create([
                'title'=> $request->title,
                'color'=> $request->color,
                'description'=> $request->description,
                'active'=> $main_category->active,
                'slug'=> $request->slug,
                'photo' => $photoPath,
            ]);

            //return "App\\Models\\".$main_category_id->route;
            Mainable::create([
                'main_category_id' => $main_category->id,
                'mainable_type' => "App\\Models\\Course",
                'mainable_id' => $course->id,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء كورس جديد',
                'notifyMsg' => 'تم انشاء الكورس  '.$request->title.'  بنجاح '
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء الكورس    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }

        
       
       
    }
 
    public function show($course_id)
    {
        $course =  Course::with('groups')->find($course_id);

        if(!$course){
            return redirect()-> route('Course-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا الكورس غير موجود '
            ]);        
        }
         
        $groups =$course->groups()->selection()->paginate(PAGINATION_COUNT);
        return view('admin.lessongroup.index',compact('groups','course_id'));
    }


    public function followers($id)
    {
        try{////////تابع من هنا
             $course = Course::with('users')->find($id);

             $users= $course->users()->paginate(50);
            if(!$course){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكورس غير موجود    '
                ]);
            }

            return view('admin.course.followers',compact('users','course'));

        }catch (\Exception $ex){
            return redirect()->back()
                ->with([
                    'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'حدث خطأ ما يرجى المحاولة لاحقا    '
                ]);
        }
    }
 
    public function edit($id)
    {
        
        $course = Course::selection()->find($id);
        if(!$course){
            return redirect()->route('Course-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكورس غير موجود    '
            ]);
        }
        return view('admin.course.edit', compact('course')); 
    }
 
    public function update(CourseRequest $request, $id)
    {
         //return $request;
       try{
        $course = Course::find($id);
            if(!$course){
                return redirect()->route('Course-dashboard.index',$id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكورس غير موجود    '
                ]);
            }

            if($request->has('photo')){
                $photoPath=uploadFile($request->photo,'images/courses');
                $course ->update([
                    'photo'=>$photoPath,
                ]);
            }
            
            $course ->update([
                'title'=> $request->title,
                'color'=> $request->color,
                'description'=> $request->description,
                'slug'=> $request->slug,
            ]);
            return redirect()-> route('Course-dashboard.index')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث الكورس ','notifyMsg' => 'تم تحديث الكورس  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return $ex;
            return redirect()-> route('Course-dashboard.index')
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث الكورس    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
 
    public function destroy($id)
    {
        try{
            $course = Course::find($id);
            if(!$course){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكورس غير موجود    '
                ]);
            }
            if($course->groups->count() > 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يمكنك حذف هذا الكورس بسبب احتوائه على محتوى بداخله    '
                ]);
            }

            $photo = Str::after($course->photo, 'public/assets/');// public/assets/تحذف مسار الصورة وتترك باقي المسار الي بعد 
            $photo = base_path('public/assets/' . $photo);//ترجع مسار الصورة الكامل
            unlink($photo); //delete from folder
            
            $course ->delete();
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف الكورس ','notifyMsg' => 'تم حذف الكورس  '.$course->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف الكورس    '. $course->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function changeStatus($id)
    {
        try{
            $course = Course::find($id);
            if(!$course){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكورس غير موجود    '
                ]);
            }

            if($course->maincategory->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'القسم الرئيسي الخاص بهذا الكورس غير مفعل بالتالي لا يمكنك تعديل حالة الكورس    '
                ]);
            }
                
            $status=$course->active == 0 ? '1' : '0';
            
            //ther is Observer
            $course->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تغيير حالة الكورس  ',
                'notifyMsg' => 'تم بنجاح... الكورس    '.$course->title.'  '.$course->getActive().'  الأن  ',
                'active'=>$course->active
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة الكورس    '. $course->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    
    public function tryit_page($type=null)
    {
        try{
            if($type){
                $tryitcodes = TryItCode::where('type',$type)->orWhere('type1',$type)
                ->orWhere('type2',$type)->selection()->paginate(PAGINATION_COUNT);
                $search_type = $type;
            }
            else{
                $tryitcodes = TryItCode::selection()->paginate(PAGINATION_COUNT);
                $search_type = "index";
            }
             
            return view('admin.tryit.index',compact('tryitcodes','search_type'));

        }catch (\Exception $ex){
            //return $ex;
            return redirect()->back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' حدث خطأ ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function media_page($type=null)
    {
        try{
            if($type){
                $media = Media::where('type','like','%'.$type.'%')->selection()->paginate(PAGINATION_COUNT);
                $search_type = $type;
            }
            else{
                $media = Media::selection()->paginate(PAGINATION_COUNT);
                $search_type = "index";
            }
             
            return view('admin.media.index',compact('media','search_type'));

        }catch (\Exception $ex){
            return $ex;
            return redirect()->back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' حدث خطأ ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function downloader_page()
    {
        try{
            $downloaders = Downloader::selection()->paginate(PAGINATION_COUNT);
             
            return view('admin.downloader.index',compact('downloaders'));

        }catch (\Exception $ex){
            return $ex;
            return redirect()->back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' حدث خطأ ما يرجى المحاولة لاحقا '
            ]);
        }
    }
     
}
