<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\front\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Plan;
use App\Models\Lesson;
use App\Models\Notification;
use App\Models\Savedable;
use App\Models\Question;
use App\Models\Book;
use App\Models\Category;
use App\Models\Article;
use Auth;
use DB;
use Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware(function ($request, $next){
            Session::forget('categorySLUG');
            return $next($request);
        });
    }
    public function index()
    { 
        return view('front.profile');
    }
    public function showmyprofile()
    { 
        $user = User::where('username',Auth::user()->username)->active()->UserAppear()->selection()->first();
        if($user === null){
            return redirect()->back() -> with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا المسخدم  غير موجود او ربما يكون مخفي  '
            ]);
        }
        return view('front.show_profile',compact('user'));
    }
    public function update(ProfileRequest $request)
    {
       try{
        $user = Auth::user(); 
            if($user->updated_at->diffInDays() < 2){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'فشل تعديل الملف الشخصي  ',
                    'notifyMsg' => 'لا يمكن تعديل بيانات الملف الشخصي لاكثر من مرة خلال 48 ساعة ... الوقت المتبقي لامكانية التعديل  ' . (48 - $user->updated_at->diffInHours()),
                ]);
            }
            DB::beginTransaction();
            if($request->has('photo')){
                $photoPath=uploadFile($request->photo,'images/users');
                $user ->update([
                    'photo'=>$photoPath,
                ]);
            }
            if($request->has('name')){
                $user ->update([
                    'name'=>$request->name,
                ]);
            }
            if($request->has('birth_date')){
                $user ->update([
                    'birth_date'=>$request->birth_date,
                ]);
            }
            if($request->has('gender')){
                $user ->update([
                    'gender'=>$request->gender,
                ]);
            }
            if($request->has('description')){
                $user ->update([
                    'description'=>$request->description,
                ]);
            }
            if($request->has('facebook')){
                $user ->update([
                    'facebook'=>$request->facebook,
                ]);
            }
            if($request->has('twitter')){
                $user ->update([
                    'twitter'=>$request->twitter,
                ]);
            }
            if($request->has('instagram')){
                $user ->update([
                    'instagram'=>$request->instagram,
                ]);
            }
            if($request->has('github')){
                $user ->update([
                    'github'=>$request->github,
                ]);
            }
            DB::commit();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تعديل الملف الشخصي  ',
                'notifyMsg' => 'تم التعديل على ملفك الشخصي بنجاح  ',
            ]);
            
        }catch (\Exception $ex){
            DB::rollback();
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل التعديل على الملف الشخصي لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function change_visible(Request $request)
    {
        try{
            $user=Auth::user();
            $user_appear = $request->user_appear;
            if($user_appear == null){
                return response() -> json([
                    'notifyType' => 'dangerToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'قمت بإدخال قيمة غير صحيحة  ',
                ]);
            }
            if($user_appear != 0 && $user_appear != 1 && $user_appear != 2 ){
                return response() -> json([
                    'notifyType' => 'dangerToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'قمت بإدخال قيمة غير صحيحة',
                ]);
            }
            $user->update([
                'user_appear'=>$user_appear,
            ]);
            switch($user_appear){
                case 0:
                    $notifyTitle = 'إخفار ملفك الشخصي';
                    $notifyMsg = $user->name.'  تم إخفاء ملفك الشخصي عن الجميع بما في ذلك جميع الاسئلة  والاجوبة الخاصة بك   ';
                    break;
                case 1:
                    $notifyTitle = 'إظهار ملفك الشخصي';
                    $notifyMsg = $user->name.'  تم إظهار ملفك الشخصي للجميع    ';
                    break;
                case 2:
                    $notifyTitle = 'إخفار المعلومات الشخصية';
                    $notifyMsg = $user->name.'  تم إخفار المعلومات الشخصية من , صورة شخصية , بريد الكتروني , عمر , جنس , مواقع التواصل الاجتماعي   ';
                    break;
                default:
                    $notifyTitle = 'تغيير حالة ملفك الشخصي';
                    $notifyMsg = $user->name.'  تم تغيير حالة ملفك الشخصي بنجاح   ';
                    break;
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => $notifyTitle,
                'notifyMsg' => $notifyMsg
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' =>  $user->name.'    فشل تغيير حالة ملفك الشخصي لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function site_notification()
    {
        try{
            $user = Auth::user();
            $status=$user->site_notification == 0 ? '1' : '0';
            $user->update([
                'site_notification'=>$status,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تغيير حالة إشعارات الموقع  ',
                'notifyMsg' => 'تم بنجاح... إشعارات الموقع    '.$user->getStatusSiteNotification().'  الأن  ',
                'site_notification'=>$user->site_notification
            ]);
            
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة الكورس    '. $user->name.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function follow_course($course_id)
    {
        try{
            $user = Auth::user();
            $course = Course::active()->find($course_id);
            if(!$course){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكورس غير موجود    '
                ]);
            }
            if($user->courses->where('id',$course_id)->first()){
                return response() -> json([
                    'notifyType' => 'successToast','notifyTitle' => 'فشل  ','notifyMsg' => 'انت بالفعل متابع لهذا الكورس '
                ]);
            }
            $user->courses()->syncWithoutDetaching($course_id);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'متابعة الكورس  ',
                'notifyMsg' => 'تم متابعة الكورس    '.$course->title.'  بنجاح ... يمكنك مشاهدته من ملفك الشخصي  ',
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل متابعة الكورس    '. $course->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function un_follow_course($course_id)
    {
        try{
            $user = Auth::user();
            $course = Course::active()->find($course_id);
            if(!$course){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكورس غير موجود    '
                ]);
            }
            $user->courses()->detach($course_id);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الغاء متابعة الكورس  ',
                'notifyMsg' => 'تم الغاء متابعة الكورس    '.$course->title.'  بنجاح  ',
                'item_id'=>$course_id
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل الغاء متابعة الكورس    '. $course->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function follow_plan($plan_id)
    {
        try{
            $user = Auth::user();
            $plan = Plan::active()->find($plan_id);
            if(!$plan){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه الخطة غير موجودة    '
                ]);
            }
            if($user->plan_id == $plan_id){
                return redirect()->back() -> with([
                    'notifyType' => 'successToast','notifyTitle' => 'متابعة الخطة  ','notifyMsg' => 'انت بالفعل متابع لهذه الخطة    '
                ]);
            }
            DB::beginTransaction();
            $user->update([
                'plan_id' => $plan->id,
            ]);
            foreach ($plan->courses as $course) {
                $user->courses()->syncWithoutDetaching([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
            }
            DB::commit();
            return redirect()->route('profile') -> with([
                'notifyType' => 'successToast',
                'notifyTitle' => 'متابعة الخطة  ',
                'notifyMsg' => 'تم متابعة الخطة    '.$plan->title.'  بنجاح  ',
            ]);
        }catch (\Exception $ex){
            DB::rollback();
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل متابعة الخطة  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }            
    public function un_follow_plan()
    {
        try{
            $user = Auth::user();
            $user->update([
                'plan_id'=> null,
            ]);
            return redirect()->back() -> with([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الغاء متابعة الخطة  ',
                'notifyMsg' => 'تم الغاء متابعة الخطة بنجاح  ',
            ]);
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل الغاء متابعة الخطة لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function site_media_page()
    {
        try{
            $notifies = Notification::where('type','ask')->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
            if($notifies->count() <= 0){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد اي رسائل قمت بارسالها الى الادمن '
                ]);
            }
            foreach ($notifies as $key => $value) {
                if($value->notificationreply()->first() != null && $value->notificationreply()->first()->watch == 0){
                    $value->notificationreply()->update(['watch' => '1']);
                }
            }
            return view('front.site_media',compact('notifies'));
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل عرض الرسائل لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function site_inform_page()
    {
        try{
            $notifies = Notification::where('type','message')->orderBy('id', 'desc')->paginate(30);
            if($notifies->count() <= 0){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد اي ابلاغات قمت بارسالها الى الادمن '
                ]);
            }
            return view('front.site_media',compact('notifies'));
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل عرض الابلاغات لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function archive_lessons()
    {
        try{
            $archiveItems = Auth::user()->savedLessons()->paginate(PAGINATION_COUNT);
            if($archiveItems->count() <= 0){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد اي دروس قمت بحفظها '
                ]);
            }
            $className = 'الدروس';
            return view('front.archive',compact('archiveItems','className'));
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل عرض الدروس المحفوظة لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function archive_articles()
    {
        try{
            $archiveItems = Auth::user()->savedArticles()->paginate(PAGINATION_COUNT);
            if($archiveItems->count() <= 0){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد اي مقالات قمت بحفظها '
                ]);
            }
            $className = 'المقالات';
            return view('front.archive',compact('archiveItems','className'));
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل عرض المقالات المحفوظة لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function archive_books()
    {
        try{
            $archiveItems = Auth::user()->savedBooks()->paginate(PAGINATION_COUNT);
            if($archiveItems->count() <= 0){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد اي كتب قمت بحفظها '
                ]);
            }
            $className = 'الكتب';
            return view('front.archive',compact('archiveItems','className'));
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل عرض الكتب المحفوظة لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function archive_questions()
    {
        try{
            $archiveItems = Auth::user()->savedQuestions()->paginate(PAGINATION_COUNT);
            if($archiveItems->count() <= 0){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد اي اسئلة قمت بحفظها '
                ]);
            }
            $className = 'الاسئلة';
            return view('front.archive',compact('archiveItems','className'));
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل عرض الاسئلة المحفوظة لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function archive_categories()
    {
        try{
            $archiveItems = Auth::user()->savedCategories()->paginate(PAGINATION_COUNT);
            if($archiveItems->count() <= 0){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد اي فقرات قمت بحفظها '
                ]);
            }
            $className = 'الفقرات';
            return view('front.archive',compact('archiveItems','className'));
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل عرض الفقرات المحفوظة لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function remove_from_archive($id)
    {
        try{
            $item = Savedable::find($id);
            if(!$item){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا العنصر غير موجود '
                ]);
            }
            $item ->delete();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حذف العنصر ',
                'notifyMsg' => 'تم حذف العنصر بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل حذف العنصر  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function studied_lesson($id)
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
            $user_lesson = Auth::user()->lessons()->where('lesson_id',$id)->first();
            if(!$user_lesson){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'لم يتم حفظ التقدم',
                    'notifyMsg' => Auth::user()->name.'  يجب ان تقوم بخوض اختبار الدرس لتتمكن من حفظ التقدم'
                ]);
            }
            $status=$user_lesson->watch == 0 ? '1' : '0';
            $user_lesson->update(['watch' => $status,]);
            if($status == '1')
                $status_msg = ' تم حفظ الدرس '.$lesson->title.' على انه تمت دراسته' ;
            else
                $status_msg = ' تم الغاء حفظ الدرس '.$lesson->title.' من قائمة الدروس التي تم دراستها' ;
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حفظ التقدم',
                'notifyMsg' => $status_msg
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل حفظ التقدم لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function save_article($article_id)
    {
        try{
            $article = Article::active()->find($article_id);
            if(!$article){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا المقال غير موجود    '
                ]);
            }
            $savedArticle = Savedable::where('user_id',Auth::user()->id)
            ->where('savedable_type','App\\Models\\Article')
            ->where('savedable_id',$article_id)->first();
            if($savedArticle){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'موجود مسبقا','notifyMsg' => 'هذا المقال بالفعل موجود في سلة المحفوظات يمكنك الاطلاع عليه من ملفك الشخصي    '
                ]);
            }
            Savedable::create([
                'user_id' => Auth::user()->id,
                'savedable_type' => "App\\Models\\Article",
                'savedable_id' => $article_id,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حفظ المقال',
                'notifyMsg' => 'تم حفظ المقال بنجاح يمكنك الاطلاع عليه من ملفك الشخصي'
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حفظ المقال لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function save_lesson($lesson_id)
    {
        try{
            $lesson = Lesson::active()->find($lesson_id);
            if(!$lesson){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الدرس غير موجود    '
                ]);
            }
            $savedLesson = Savedable::where('user_id',Auth::user()->id)
            ->where('savedable_type','App\\Models\\Lesson')
            ->where('savedable_id',$lesson_id)->first();
            if($savedLesson){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'موجود مسبقا','notifyMsg' => 'هذا الدرس بالفعل موجود في سلة المحفوظات يمكنك الاطلاع عليه من ملفك الشخصي    '
                ]);
            }
            Savedable::create([
                'user_id' => Auth::user()->id,
                'savedable_type' => "App\\Models\\Lesson",
                'savedable_id' => $lesson_id,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حفظ الدرس',
                'notifyMsg' => 'تم حفظ الدرس بنجاح يمكنك الاطلاع عليه من ملفك الشخصي'
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حفظ الدرس لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function save_question($question_id)
    {
        try{
            $question = Question::active()->find($question_id);
            if(!$question){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا السؤال غير موجود    '
                ]);
            }
            $savedQuestion = Savedable::where('user_id',Auth::user()->id)
            ->where('savedable_type','App\\Models\\Question')
            ->where('savedable_id',$question_id)->first();
            if($savedQuestion){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'موجود مسبقا','notifyMsg' => 'هذا السؤال بالفعل موجود في سلة المحفوظات يمكنك الاطلاع عليه من ملفك الشخصي    '
                ]);
            }
            Savedable::create([
                'user_id' => Auth::user()->id,
                'savedable_type' => "App\\Models\\Question",
                'savedable_id' => $question_id,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حفظ السؤال',
                'notifyMsg' => 'تم حفظ السؤال بنجاح يمكنك الاطلاع عليه من ملفك الشخصي'
            ]);
            
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حفظ السؤال لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function save_book($book_id)
    {
        try{
            $book = Book::active()->find($book_id);
            if(!$book){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكتاب غير موجود    '
                ]);
            }
            $savedBook = Savedable::where('user_id',Auth::user()->id)
            ->where('savedable_type','App\\Models\\Book')
            ->where('savedable_id',$book_id)->first();
            if($savedBook){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'موجود مسبقا','notifyMsg' => 'هذا الكتاب بالفعل موجود في سلة المحفوظات يمكنك الاطلاع عليه من ملفك الشخصي    '
                ]);
            }
            Savedable::create([
                'user_id' => Auth::user()->id,
                'savedable_type' => "App\\Models\\Book",
                'savedable_id' => $book_id,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حفظ الكتاب',
                'notifyMsg' => 'تم حفظ الكتاب بنجاح يمكنك الاطلاع عليه من ملفك الشخصي'
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حفظ الكتاب لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function save_category($category_id){
        try{
            $category = Category::active()->find($category_id);
            if(!$category){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الفقرة غير موجود    '
                ]);
            }

            $savedCategory = Savedable::where('user_id',Auth::user()->id)
            ->where('savedable_type','App\\Models\\Category')
            ->where('savedable_id',$category_id)->first();
            if($savedCategory){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'موجود مسبقا','notifyMsg' => 'هذه الفقرة بالفعل موجودة في سلة المحفوظات يمكنك الاطلاع عليها من ملفك الشخصي    '
                ]);
            }
            Savedable::create([
                'user_id' => Auth::user()->id,
                'savedable_type' => "App\\Models\\Category",
                'savedable_id' => $category_id,
            ]);
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حفظ الفقرة',
                'notifyMsg' => 'تم حفظ الفقرة بنجاح يمكنك الاطلاع عليه من ملفك الشخصي'
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حفظ الفقرة لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
}
