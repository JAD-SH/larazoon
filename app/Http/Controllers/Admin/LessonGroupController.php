<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\LessonGroupRequest;
use App\Models\LessonGroup;
use Session;

class LessonGroupController extends Controller
{
    //

    public function create($course_id)
    {
        return view('admin.lessongroup.create',compact('course_id'));
    }

    public function store(LessonGroupRequest $request)
    {
        try{
            LessonGroup::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'إضافة جروب دروس ','notifyMsg' => 'تم إضافة جروب دروس بنجاح  '
            ]);
            
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل إضافة جروب دروس    '
            ]);
        }
                    
    }

    public function show($group_id)
    {
        $lessongroup =  LessonGroup::with('lessons') -> find($group_id);

        if(!$lessongroup){
            return redirect()-> route('Course-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا الجروب غير موجود '
            ]);        
        }
        if(!$lessongroup->lessons->count() > 0){
            return redirect()-> route('Course-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد دروس لهذا الجروب '
            ]);        
        }

        $lessons =$lessongroup->lessons()->selection()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('lessons-filter','filter-index');
        return view('admin.lesson.index',compact('lessons','group_id'));
    }
 
    public function edit($id)
    {
        
        $group = LessonGroup::selection()->find($id);
        //$course_id = $group->library->id;
        if(!$group){
            return redirect()->back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الجروب غير موجود    '
            ]);
        }
        return view('admin.lessongroup.edit', compact('group')); 
    }
 
    public function update(LessonGroupRequest $request, $id)
    {
         //return $request;

       try{
        $group = LessonGroup::find($id);
            if(!$group){
                return redirect()-> route('Course-dashboard.show',$request->course_id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الجروب غير موجود    '
                ]);
            }
             
            $group ->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('Course-dashboard.show',$request->course_id)
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث الجروب ','notifyMsg' => 'تم تحديث الجروب  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('Course-dashboard.show',$request->course_id)
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث الجروب    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
 
    public function destroy($id)
    {
        try{
            $group = LessonGroup::find($id);
            if(!$group){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الجروب غير موجود    '
                ]);
            }
            if($group->lessons->count() > 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يمكنك حذف هذا الجروب بسبب احتوائه على دروس بداخله    '
                ]);
            }
            $group ->delete();            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف الجروب ','notifyMsg' => 'تم حذف الجروب  '.$group->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف الجروب    '. $group->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function changeStatus($id)
    {
        try{
            $group = LessonGroup::find($id);
            if(!$group){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الجروب غير موجود    '
                ]);
            }
                
            if($group->course->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'الكورس الخاص بالجروب  هذا غير مفعل بالتالي لا يمكنك تعديل حالة الجروب    '
                ]);
            }

            $status=$group->active == 0 ? '1' : '0';
            
            $group->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة الجروب  ','notifyMsg' => 'تم بنجاح... الجروب    '.$group->title.'  '.$group->getActive().'  الأن  ',
                'active'=>$group->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة الجروب    '. $group->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
     
}
