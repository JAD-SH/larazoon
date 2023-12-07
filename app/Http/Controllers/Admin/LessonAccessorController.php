<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LessonAccessor;
use App\Models\Lesson;
use Session;
use App\Http\Requests\admin\LessonRequest;

class LessonAccessorController extends Controller
{
    
    public function older($lesson_id)
    {
        $lessons = Lesson::where('lesson_id',$lesson_id)->paginate(PAGINATION_COUNT);
        Session::put('lessons-filter','filter-older-accessor');
        return view('admin.lesson.index',compact('lessons','lesson_id'));
    }
    public function un_active($lesson_id)
    {
        $lessons = Lesson::where('lesson_id',$lesson_id)->where('active','0')->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        if(!$lessons->count() > 0){
            return redirect()-> route('LessonGroup-dashboard.show',$lesson_id)
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد مقالات غير مفعلة '
            ]);        
        }
        Session::put('lessons-filter','filter-unactive-accessor');
        return view('admin.lesson.index',compact('lessons','lesson_id'));
    }
    public function top_views($lesson_id)
    {
        $lessons = Lesson::where('lesson_id',$lesson_id)->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('lessons-filter','filter-top-views-accessor');
        return view('admin.lesson.index',compact('lessons','lesson_id'));
    }
    public function top_likes($lesson_id)
    {
        $lessons = Lesson::where('lesson_id',$lesson_id)->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('lessons-filter','filter-top-likes-accessor');
        return view('admin.lesson.index',compact('lessons','lesson_id'));
    }
    public function create($lesson_id)
    {
       // $lesson_id = $id;
        return view('admin.lessonaccessor.create',compact('lesson_id'));
    }
    public function store(LessonRequest $request)
    {

        $photoPath = 'default.png';
        if($request->has('photo'))
            $photoPath=uploadFile($request->photo,'images/lessons');

        $lesson_active = Lesson::find($request->lesson_id)->active;
        try{
            Lesson::create([
                'lesson_id' => $request->lesson_id,
                'title' => $request->title,
                'active' => $lesson_active,
                'slug' => $request->slug,
                'description' => $request->description,
                'photo' => $photoPath,
                'content' => $request->content,
                'about' => $request->about,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء درس جديد',
                'notifyMsg' => 'تم انشاء الدرس  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء الدرس    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
        
       
       
    }
    public function edit($id)
    {
        
        $lesson = Lesson::selection()->find($id);
         if(!$lesson){
            return redirect()->back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود    '
            ]);
        }
        return view('admin.lessonaccessor.edit', compact('lesson')); 
    }
    public function update(LessonRequest $request, $id)
    {
 
        try{
            $lesson = Lesson::find($id);
            if(!$lesson){
                return redirect()-> route('LessonGroup-dashboard.show',$request->lesson_id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود    '
                ]);
            }
            if($request->has('photo')){
                $photoPath=uploadFile($request->photo,'images/lessons');
                $lesson ->update([
                    'photo'=>$photoPath,
                ]);
            }
            $lesson ->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'about' => $request->about,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('LessonGroup-dashboard.show',$request->lesson_id)
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث الدرس ','notifyMsg' => 'تم تحديث الدرس  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('LessonGroup-dashboard.show',$request->lesson_id)
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث الدرس    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function changeStatus($id)
    {
        try{
            $lesson = Lesson::find($id);
            if(!$lesson){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود    '
                ]);
            }
                
            if($lesson->group->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'الكورس الخاص بالدرس  هذا غير مفعل بالتالي لا يمكنك تعديل حالة الدرس    '
                ]);
            }

            $status=$lesson->active == 0 ? '1' : '0';
            
            //return $lesson;
            $lesson->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة الدرس  ','notifyMsg' => 'تم بنجاح... الدرس    '.$lesson->title.'  '.$lesson->getActive().'  الأن  ',
                'active'=>$lesson->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة الدرس    '. $lesson->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function trashed($id)
    {
        $trashed = Lesson::onlyTrashed()->where('lesson_id',$id)->orderBy('deleted_at', 'desc')->paginate(50);
        if(!$trashed->count()){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'لا يوجد دروس في سلة المهملات    '
            ]);
        }
        return view('admin.lessonaccessor.trashed',compact('trashed'));
    }
     
}
