<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonGroup;
use Session;
use App\Http\Requests\admin\LessonRequest;

class LessonController extends Controller
{
    

    public function lessonaccessor($lesson_id)
    {
        $lessons = Lesson::where('lesson_id',$lesson_id)->paginate(PAGINATION_COUNT);
        Session::put('lessons-filter','filter-older-accessor');
        return view('admin.lessonaccessor.index',compact('lessons','lesson_id'));
    }
    public function older($group_id)
    {
        $lessons = Lesson::where('group_id',$group_id)->paginate(PAGINATION_COUNT);
        Session::put('lessons-filter','filter-older');
        return view('admin.lesson.index',compact('lessons','group_id'));
    }
    public function un_active($group_id)
    {
        $lessons = Lesson::where('group_id',$group_id)->where('active','0')->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        if(!$lessons->count() > 0){
            return redirect()-> route('LessonGroup-dashboard.show',$group_id)
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد مقالات غير مفعلة '
            ]);        
        }
        Session::put('lessons-filter','filter-unactive');
        return view('admin.lesson.index',compact('lessons','group_id'));
    }
    public function top_views($group_id)
    {
        $lessons = Lesson::where('group_id',$group_id)->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('lessons-filter','filter-top-views');
        return view('admin.lesson.index',compact('lessons','group_id'));
    }
    public function top_likes($group_id)
    {
        $lessons = Lesson::where('group_id',$group_id)->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('lessons-filter','filter-top-likes');
        return view('admin.lesson.index',compact('lessons','group_id'));
    }
    public function create($group_id)
    {
       // $group_id = $id;
        return view('admin.lesson.create',compact('group_id'));
    }
    public function store(LessonRequest $request)
    {
        $photoPath = 'default.png';
        if($request->has('photo'))
            $photoPath=uploadFile($request->photo,'images/lessons');

        $group_active = LessonGroup::find($request->group_id)->active;
        
        try{
            Lesson::create([
                'title' => $request->title,
                'active' => $group_active,
                'slug' => $request->slug,
                'description' => $request->description,
                'photo' => $photoPath,
                'content' => $request->content,
                'style' => $request->style,
                'script' => $request->script,
                'group_id' => $request->group_id,
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
    public function show($id)
    {
        $content =  Lesson:: find($id);

        if(!$content){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا الدرس غير موجود '
            ]);        
        }
        return view('admin.item',compact('content'));
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
        return view('admin.lesson.edit', compact('lesson')); 
    }
    public function update(LessonRequest $request, $id)
    {
         //return $request;

       try{
        $lesson = Lesson::find($id);
            if(!$lesson){
                return redirect()-> route('LessonGroup-dashboard.show',$request->group_id)
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
                'style' => $request->style,
                'script' => $request->script,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('LessonGroup-dashboard.show',$request->group_id)
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث الدرس ','notifyMsg' => 'تم تحديث الدرس  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('LessonGroup-dashboard.show',$request->group_id)
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث الدرس    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function destroy($id)
    {
        try{
            $lesson = Lesson::find($id);
            if(!$lesson){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود    '
                ]);
            }

            $lesson ->delete();            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف الدرس ','notifyMsg' => 'تم حذف الدرس  '.$lesson->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف الدرس    '. $lesson->title.'  لسبب ما يرجى المحاولة لاحقا '
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
    public function trashed($id){
        //return 'aaaa';
         $trashed = Lesson::onlyTrashed()->where('group_id',$id)->orderBy('deleted_at', 'desc')->paginate(50);
        if(!$trashed->count()){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'لا يوجد دروس في سلة المهملات    '
            ]);
        }
        return view('admin.lesson.trashed',compact('trashed'));
    }

    public function restore($id){
        //return 'aaaa';
        try{
            $trashed_item = Lesson::onlyTrashed()->where('id', $id)->get();

            if(!$trashed_item){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا الدرس غير موجود '
                ]);        
            }
            Lesson::onlyTrashed()->where('id', $id)->restore();

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'استعادة الدرس',
                'notifyMsg' => 'تم استعادة الدرس بنجاح ',
                'item_id'=>$id
            ]);
           
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل استعادة الدرس لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
        
    }
    public function move(Request $Request ,$id)
    {
        try{
            $lesson = Lesson::find($id);
            $group = LessonGroup::find($Request->group_id);

            if(!$lesson){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا الدرس غير موجود    '
                ]);
            }
            if(!$group){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'الجروب هذا غير موجود  '
                ]);
            }
                
            $lesson->update([
                'group_id'=>$Request->group_id,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'نقل الدرس  ',
                'notifyMsg' => ' تم نقل الدرس الى الجروب  '.$group->title.'  بنجاح  ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل نقل الدرس    '. $lesson->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function tryit_page($tryitable_id)
    {
        try{
            $lesson = Lesson::find($tryitable_id);
            if(!$lesson){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود    '
                ]);
            }
             $tryitcodes = $lesson->tryitCodes()->get();
             $tryitable_type = "Lesson";
            return view('admin.tryit.index',compact('tryitable_id','tryitable_type','tryitcodes'));

        }catch (\Exception $ex){
            return $ex;
            return redirect()->back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' حدث خطأ ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function image_page($imageable_id)
    {
        try{
            $lesson = Lesson::find($imageable_id);
            if(!$lesson){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود    '
                ]);
            }
             $images = $lesson->images()->get();
             $imageable_type = "Lesson";
            return view('admin.image.index',compact('imageable_id','imageable_type','images'));

        }catch (\Exception $ex){
            return $ex;
            return redirect()->back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' حدث خطأ ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function accessors($lesson_id)
    {
        $lesson =  Lesson::with('accessors')->find($lesson_id);

        if(!$lesson){
            return redirect()-> route('Course-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا الدرس غير موجود '
            ]);        
        }
         
        $accessors =$lesson->accessors()->selection()->paginate(PAGINATION_COUNT);
        //return $accessors->first()->lesson()->get()->flatten();
        return view('admin.lessonaccessor.index',compact('accessors','lesson_id'));
    }
}
