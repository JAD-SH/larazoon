<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Lesson;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($lesson_id)
    {
        $lesson =  Lesson::with('exams') -> find($lesson_id);
        
        if(!$lesson){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' حدث خطأ ما ربما هذا الدرس ليس له اختبار بعد '
            ]);        
        }
        
        //return $lesson_id;

        return view('admin.exam.index',compact('lesson','lesson_id'));
    }


    public function store_question(Request $request, $lesson_id)
    {
        try{
            Exam::create([
                'question' => $request->question,
                'right_answer' => $request->right_answer,
                'wrong_answer_1' => $request->wrong_answer_1,
                'wrong_answer_2' => $request->wrong_answer_2,
                'wrong_answer_3' => $request->wrong_answer_3,
                'lesson_id' => $lesson_id,
            ]);
            
            return redirect()-> back()
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'إضافة سؤال ','notifyMsg' => 'تم إضافة سؤال للدرس بنجاح  '
            ]);
            
           
        }catch (\Exception $ex){
            return $ex;
            return redirect()-> back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل إضافة سؤال للدرس    '
            ]);
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lesson_id)
    {
       //return $lesson_id;
        return view('admin.exam.create',compact('lesson_id'));
    }

    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $exam = Exam::find($id);
            if(!$exam){
                return redirect()-> back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا السؤال غير موجود    '
                ]);
            }
           
            $exam ->update([
                'question' => $request->question,
                'right_answer' => $request->right_answer,
                'wrong_answer_1' => $request->wrong_answer_1,
                'wrong_answer_2' => $request->wrong_answer_2,
                'wrong_answer_3' => $request->wrong_answer_3,
            ]);

            return redirect()-> back()
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث السؤال ','notifyMsg' => 'تم تحديث السؤال بنجاح '
            ]);
            
        }catch (\Exception $ex){
            return redirect()-> back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث السؤال لسبب ما يرجى المحاولة لاحقا '
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
            $exam = Exam::find($id);
            if(!$exam){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الاختبار غير موجود    '
                ]);
            }

            $exam ->delete();            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف الاختبار ','notifyMsg' => 'تم حذف الاختبار  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف الاختبار لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            //return $request;
            $request_count= count($request->all())-2;
            if(!$request_count > 0){
                return redirect()-> back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل إضافة اخنبار للدرس    '
                ]);
            }
            
           
            for ($i=0; $i < $request_count; $i++) { 
                
                $xx=$i+1;
                Exam::create([

                    'question' => $request->input('question_'.$xx)[0],
                    'right_answer' => $request->input('question_'.$xx)[1],
                    'wrong_answer_1' => $request->input('question_'.$xx)[2],
                    'wrong_answer_2' => $request->input('question_'.$xx)[3],
                    'wrong_answer_3' => $request->input('question_'.$xx)[4],
                    'lesson_id' => $request->lesson_id,
                ]);
            }
            
            return redirect()->route('LessonGroup-dashboard.show',Lesson::find($request->lesson_id)->group->id)
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'إضافة اخنبار ','notifyMsg' => 'تم إضافة اخنبار للدرس بنجاح  '
            ]);
            
        }catch (\Exception $ex){
            return $ex;
            return redirect()-> back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل إضافة اخنبار للدرس    '
            ]);
        }
    }
    
    public function destroy_exam($lesson_id)
    {        
        try{

            $exams = Exam::where('lesson_id',$lesson_id)->get();
            if(!$exams){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود او ربما ليس له اختبار    '
                ]);
            }
                
            foreach ($exams as $exam) {
                
                $exam->delete();
            }
            //return $lesson;
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تم بنجاح  ','notifyMsg' => '  تم حذف الاختبار بنجاح',
            ]);
        }catch (\Exception $ex){
        
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' فشل حذف الاختبار ربما ليس لهذا الدرس اختبار'
            ]);
        }
        
    }
    public function changeStatus_exam($lesson_id)
    {
        try{
            $exams = Exam::where('lesson_id',$lesson_id)->get();
            if(!$exams){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود او ربما ليس له اختبار    '
                ]);
            }
                
            foreach ($exams as $exam) {
                $status=$exam->active == 0 ? '1' : '0';
                
                $exam->update([
                    'active'=>$status,
                ]);
            }
            //return $lesson;
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تم بنجاح  ','notifyMsg' => '  تم تغيير حالة الاختبار بنجاح',
            ]);
        }catch (\Exception $ex){
           
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' فشل تغيير حالة الاختبار لسبب ما ربما ليس لهذا الدرس اختبار'
            ]);
        }
        
    }
}
