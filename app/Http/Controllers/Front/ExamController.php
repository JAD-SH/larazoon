<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\User_Course;
use App\Models\UserLesson;
use Auth;
 
class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
         
    }
    public function CheckLessonAnswers(Request $request)
    {
          
        try{
            $lesson = Lesson::active()->find($request->lesson_id);
            if(!$lesson){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'غير موجود',
                    'notifyMsg' => 'لم يتم العثور على هذا الدرس'
                ]);
            }
            if(Auth::user()){
                if(Auth::user()->lessons->where('lesson_id',$request->lesson_id)->first() !== null && Auth::user()->lessons->where('lesson_id',$request->lesson_id)->first()->result !== null){
                    return response() -> json([
                        'notifyType' => 'successToast',
                        'notifyTitle' => 'تم الاختبار من قبل',
                        'notifyMsg' => 'انت بالفعل اجتزت هذا الاختبار   '
                    ]);
                }
            }
            if(session()->has('lessonExam'.$request->lesson_id.'IsExamine')){
             
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'تم الاختبار من قبل',
                    'notifyMsg' => 'انت بالفعل اجتزت هذا الاختبار   '
                ]);
            }
            $all_questions = $lesson->exams()->select('id')->pluck('id');
            $question_count = $lesson->exams()->count();
            $question_mark = 100/$question_count;
            $result = 0;
            foreach ($all_questions as $index => $item) {
                $option = $request[''.$item.''];
                if(!$option){
                    return response() -> json([
                        'notifyType' => 'warningToast',
                        'notifyTitle' => 'فشل الاختبار ',
                        'notifyMsg' => 'لم تجيب على بعض الاسئلة .. الرجاء اعادة الاختبار والاجابة على كافة الاسئلة'
                    ]);
                }
                $exam=Exam::active()->find($item);
                if($exam){
                    if($exam->right_answer === $option){
                        $result+=$question_mark;
                    }
                }
            }
            $exam_status=true;
            if(Auth::user()){
                if(Auth::user()->lessons->where('lesson_id',$lesson->id)->first() === null){
                    UserLesson::create([
                        'user_id'=>Auth::user()->id,
                        'lesson_id'=>$lesson->id,
                        'course_id'=>$lesson->group->course->id,//group
                        'result'=>$result,
                    ]);
                }else{
                    $user_lesson = UserLesson::where('user_id',Auth::user()->id)
                    ->where('lesson_id',$lesson->id)->first();
                    if($user_lesson !== null){
                        if($user_lesson->result === null){
                            $user_lesson ->update([
                                'result'=>$result,
                                'watch'=>1,
                            ]);
                        }
                        else {
                            $exam_status=false;
                        }
                    }
                }
            }
            else{
                session()->put('lessonExam'.$request->lesson_id.'IsExamine',$request->lesson_id);
            }
            
            if(!$exam_status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'تم الاختبار من قبل',
                    'notifyMsg' => 'انت بالفعل اجتزت هذا الاختبار   '
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تم الاختبار',
                'notifyMsg' => 'نتيجتك في هذا الاختبار   '.$result.'%'
            ]);
            
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشلت عملية الاختبار لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function course_exams($slug)
    {
        $course=Course::active()->where('slug',$slug)->first();
        if(!$course){
            return redirect()->route('profile')
            ->with([
                'notifyType' => 'warningToast',
                'notifyTitle' => 'فشل',
                'notifyMsg' => 'هذا الكورس غير موجود'
            ]);
        }
        $user_course = User_Course::where('user_id',Auth::user()->id)->where('course_id',$course->id)->first();
        if($user_course->isexamine == 1){
            return redirect()->route('profile')
            ->with([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تم مسبقا',
                'notifyMsg' => 'انت بالفعل اجتزت هذا الاختبار مسبقا'
            ]);
        }
        return view('front.exams',compact('course'));
    }
    public function CheckCourseAnswers(Request $request)
    {
        try{
            $course = Course::find($request->course_id);
            $user_course = User_Course::where('user_id',Auth::user()->id)->where('course_id',$course->id)->first();
            if($user_course->isexamine == 1){
                return redirect()->route('profile')
                ->with([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'تم مسبقا',
                    'notifyMsg' => 'انت بالفعل اجتزت هذا الاختبار مسبقا'
                ]);
            }
            $all_questions = $course->exams()->select('exams.id')->pluck('exams.id');
            
            $question_count = $all_questions->count();
            
            $question_mark = 100/$question_count;
            $result = 0;
            $correctAnswers = [];
            foreach ($all_questions as $index => $item) {
                $option = $request[''.$item.''];
                if(!$option){
                    return response() -> json([
                        'notifyType' => 'warningToast',
                        'notifyTitle' => 'فشل الاختبار ',
                        'notifyMsg' => 'لم تجيب على بعض الاسئلة .. الرجاء اعادة الاختبار والاجابة على كافة الاسئلة'
                    ]);
                }
                $exam=Exam::active()->find($item);
                if($exam){
                    $correctAnswers[$item] = $exam->right_answer;
                    if($exam->right_answer === $option){
                        $result+=$question_mark;
                    }
                }
            }

            
            foreach ($course->lessons as $key => $lesson) {
                
                if(Auth::user()->lessons->where('lesson_id',$lesson->id)->first() === null){
                    UserLesson::create([
                        'user_id'=>Auth::user()->id,
                        'lesson_id'=>$lesson->id,
                        'course_id'=>$request->course_id,
                        'result'=>$result,
                    ]);
                }else{
                    continue;
                }
            }

            $user_course ->update([
                'isexamine' => 1,
            ]);

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تم الاختبار',
                'notifyMsg' => 'نتيجتك في هذا الاختبار   '.$result.'%',
                'correctAnswers' => $correctAnswers
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشلت عملية الاختبار لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }

}
