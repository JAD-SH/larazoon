<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonGroup;
use App\Models\User;
use App\Models\Downloader;
use App\Events\AddViewLessonEvent;
use App\Events\AddLikeLessonEvent;
use Session;
use Spatie\SchemaOrg\Schema;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('categorySLUG',MainCategory::where('route','Course')->first()->slug);
            return $next($request);
        });
    }
    public function index()
    {
        $AllCourses = Course::active()->selection()->get();
        $schemaArray=[];
        foreach ($AllCourses as $key => $Course) {
            array_push($schemaArray,
                Schema::listItem()->position($key+1)->item(
                    Schema::course()->url($Course->slug)->name($Course->name)->description($Course->slug)
                    ->provider(Schema::organization()->name('HelloLaravel')->sameAs("https://www.example.com1"))
                )
            );
        }
        $schemaCourses = Schema::itemList()->itemListElement($schemaArray);
        $schemajspnscript = $schemaCourses->toScript();
        $maincategory = MainCategory::where('route','Course')->active()->selection()->first();
        return view('front.hellolaravel',compact('maincategory','schemajspnscript'));
    }
    public function faq()
    {
        return view('front.faq');
    }
    
    public function privacy_policy()
    {
        return view('front.privacy_policy');
    }
    public function about()
    {
        return view('front.about');
    }
    public function lesson($course_slug,$lesson_slug)
    {
        $lesson = Lesson::where('slug',$lesson_slug)->active()->selection()->first();
        if(!$lesson){
            return redirect()-> route('Course.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا الدرس غير موجود '
            ]);
        }

         
        $schemaLesson = Schema::article()->mainEntityOfPage(Schema::webPage()->identifier("هنا رابط الدرس"))
        ->headline($lesson->title)->description($lesson->description)->image($lesson->photo)->author(Schema::organization()->name('HelloLaravel')->url('http://localhost/HelloLaravel/'))->publisher(Schema::organization()->name('HelloLaravel')->logo(Schema::imageObject()->url('http://localhost/HelloLaravel/')))->datePublished($lesson->created_at)->dateModified($lesson->updated_at);
        $schemajspnscript = $schemaLesson->toScript();
        
        $course = Course::with('groups')->active()->selection()->where('slug',$course_slug)->first();

        $group_lessons = $course->groups()->with(['lessons' => function($query){
            $query -> active()->select('id','title','group_id','slug'); 
        }])->active()->selection()->get();

        $all_lesson = $course->lessons()->orderBy('group_id')->get()->toArray();
        foreach($all_lesson as $index=>$one_lesson){
            if($one_lesson['id'] == $lesson->id){
                  $current_lesson = $index;
            }
        }
        if(isset($current_lesson)){
            if($current_lesson > 0){
                $previous = $all_lesson[$current_lesson-1];
            }else $previous = null;

            if(count($all_lesson) > ($current_lesson+1)){
                $next = $all_lesson[$current_lesson+1];
            }else $next = null;
        }else {
            $previous = null;
            $next = null;
        }

        

        event(new AddViewLessonEvent($lesson));
        return view('front.lesson',compact('group_lessons','lesson','schemajspnscript','next','previous'));
    }
    public function course($course_slug)
    {
        $AllCourses = Course::active()->selection()->get();
        $schemaArray=[];
        foreach ($AllCourses as $key => $Course) {
            array_push($schemaArray,
                Schema::listItem()->position($key+1)->item(
                    Schema::course()->url($Course->slug)->name($Course->name)->description($Course->slug)
                    ->provider(Schema::organization()->name('HelloLaravel')->sameAs("https://www.example.com1"))
                )
            );
        }
        $schemaCourses = Schema::itemList()->itemListElement($schemaArray);
        $schemajspnscript = $schemaCourses->toScript();

        $course = Course::with('groups')->active()->selection()->where('slug',$course_slug)->first();
        
        if(!$course){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل',
                'notifyMsg' => 'هذا الكورس غير موجود'
            ]);
        }
        $group_lessons = $course->groups()->with(['lessons' => function($query){
            $query -> active()->select('id','title','group_id','slug'); 
        }])->active()->selection()->get();
        if(!$group_lessons){
            return redirect()-> route('Course.index')
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا الكورس غير موجود '
            ]);        
        }
        $lesson = Lesson::where('group_id',$group_lessons->first()->id)->active()->first();
        if(!$lesson){
            return redirect()-> route('Course.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'عد قريبا','notifyMsg' => ' لا يوجد دروس لهذا الكورس نعمل على اضافة دروس جديدة في اسرع وقت'
            ]);        
        }

        $all_lesson = $course->lessons()->orderBy('group_id')->get()->toArray();
        foreach($all_lesson as $index=>$one_lesson){
            if($one_lesson['id'] == $lesson->id){
                  $current_lesson = $index;
            }
        }
        $previous = null;

        if(count($all_lesson) > ($current_lesson+1)){
            $next = $all_lesson[$current_lesson+1];
        }else $next = null;

        event(new AddViewLessonEvent($lesson));
        //return 'aaa';
        return view('front.lesson',compact('lesson','group_lessons','schemajspnscript','next','previous'));
    }

    public function AddLike($id)
    {
        try{
            $lesson=Lesson::active()->find($id);
            if(!$lesson){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'هذا الدرس غير موجود'
                ]);
            }
            $status=event(new AddLikeLessonEvent($lesson));
            if(!$status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'الاعجاب بالدرس',
                    'notifyMsg' => 'شكرا لك انت بالفعل قد اعجبت بالدرس   '.$lesson->title
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الاعجاب بالدرس',
                'notifyMsg' => 'شكرا للإعجاب بالدرس  '.$lesson->title
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل الإعجاب بالدرس    '. $lesson->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function file_download($slug)
    {
        try{
            $downloader=Downloader::where('slug',$slug)->first();
            if(!$downloader){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل التحميل',
                    'notifyMsg' => 'هذا الملف غير موجود'
                ]);
            }
            
            return  response()->download($downloader->file); 

        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تحميل الملف لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    
   
}
