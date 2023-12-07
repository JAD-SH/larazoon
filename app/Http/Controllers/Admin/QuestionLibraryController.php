<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\QuestionLibraryRequest;
use App\Models\QuestionLibrary;
use App\Models\Question;
use App\Models\MainCategory;
use App\Models\Mainable;
use Illuminate\Support\Str;
use Session;

class QuestionLibraryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-questionlibraries-section');
            return $next($request);
        });
    }
    
    public function index()
    {
        $questionlibraries = QuestionLibrary::selection()->paginate(PAGINATION_COUNT);

        $ques_top_views=Question::with('questionlibraries')->active()->selection()->orderBy('views', 'desc')->limit(5)->get();

        return view('admin.questionlibrary.index',compact('ques_top_views','questionlibraries'));
    }

   
    public function create()
    {
        return view('admin.questionlibrary.create');
    }

   
    public function store(QuestionLibraryRequest $request)
    {

        try{
            $main_category= MainCategory::where('route','Question')->first();
            $questionlibrary = QuestionLibrary::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'active' => $main_category->active,
                'section' => $request->section,
                'description' => $request->description,
            ]);
            
            //return "App\\Models\\".$main_category_id->route;
            Mainable::create([
                'main_category_id' => $main_category->id,
                'mainable_type' => "App\\Models\\QuestionLibrary",
                'mainable_id' => $questionlibrary->id,
            ]);

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء مكتبة اسئلة جديدة',
                'notifyMsg' => 'تم انشاء المكتبة  '.$request->title.'  بنجاح '
            ]);
           
        }catch (\Exception $ex){
            //return $ex;

            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء المكتبة    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
               
    }

    public function show($library_id)
    {
        $questionlibrary =  QuestionLibrary::with('questions') -> find($library_id);
        
        if(!$questionlibrary){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه المكتبة غير موجودة '
            ]);        
        }
        if(!$questionlibrary->questions->count() > 0){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد اسئلة لهذه المكتبة '
            ]);        
        }
        
        $questions =$questionlibrary ->questions()->selection()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        //return $library_id;
        Session::put('questions-filter','filter-index');
        return view('admin.questionlibrary.questions',compact('questions','library_id'));
    }

    
    public function edit($id)
    {
        
        $questionlibrary = QuestionLibrary::selection()->find($id);
        if(!$questionlibrary){
            return redirect()->route('QuestionLibrary-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
            ]);
        }
        return view('admin.questionlibrary.edit', compact('questionlibrary')); 
    }

    
    public function update(QuestionLibraryRequest $request, $id)
    {
         //return $request;
       try{
        $questionlibrary = QuestionLibrary::find($id);
            if(!$questionlibrary){
                return redirect()->route('QuestionLibrary-dashboard.index')
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }

            $questionlibrary ->update([
                'title' => $request->title,
                'section' => $request->section,
                'description' => $request->description,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('QuestionLibrary-dashboard.index')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث المكتبة ','notifyMsg' => 'تم تحديث المكتبة  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('QuestionLibrary-dashboard.index')
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث المكتبة    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function destroy($id)
    {
        try{
            $questionlibrary = QuestionLibrary::find($id);
            if(!$questionlibrary){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }

            if($questionlibrary->questions->count() > 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يمكنك حذف مكتبة الاسئلة هذه بسبب احتوائها على اسئلة بداخلها    '
                ]);
            }

            $questionlibrary ->delete();

            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف المكتبة ','notifyMsg' => 'تم حذف المكتبة  '.$questionlibrary->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف المكتبة    '. $questionlibrary->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function changeStatus($id)
    {
        try{
            $questionlibrary = QuestionLibrary::find($id);
            if(!$questionlibrary){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }
                     
            if($questionlibrary->maincategory->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'القسم الرئيسي الخاص بمكتبة الاسئلة هذه غير مفعل بالتالي لا يمكنك تعديل حالة المكتبة    '
                ]);
            }
             
            $status=$questionlibrary->active == 0 ? '1' : '0';
            
            //ther is Observer
            $questionlibrary->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة المكتبة  ','notifyMsg' => 'تم بنجاح... المكتبة    '.$questionlibrary->title.'  '.$questionlibrary->getActive().'  الأن  ',
                'active'=>$questionlibrary->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة المكتبة    '. $questionlibrary->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function destroy_question($id)
    {
        try{
            $question = Question::find($id);
            if(!$question){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا السؤال غير موجود    '
                ]);
            }


           
            $question ->delete();

            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف السؤال ','notifyMsg' => 'تم حذف السؤال  '.$question->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف السؤال    '. $question->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function question_status($id)
    {
        try{
            $question = Question::find($id);
            if(!$question){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا السؤال غير موجود    '
                ]);
            }
                
            /* 
            if($question->questionlibrary->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'مكتبة الاسئلة الخاصة بالسؤال  هذا غير مفعلة بالتالي لا يمكنك تعديل حالة السؤال    '
                ]);
            }
            */

            $status=$question->active == 0 ? '1' : '0';
            
            //return $question;
            $question->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة السؤال  ','notifyMsg' => 'تم بنجاح... السؤال    '.$question->title.'  '.$question->getActive().'  الأن  ',
                'active'=>$question->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة السؤال    '. $question->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
     
    public function trashed(){
        //return 'aaaa';
         $trashed = Question::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(50);
        if(!$trashed->count()){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'لا يوجد اسئلة في سلة المهملات    '
            ]);
        }
        return view('admin.questionlibrary.trashed',compact('trashed'));
    }

    public function restore($id){
        //return 'aaaa';
        try{
            $trashed_item = Question::onlyTrashed()->where('id', $id)->get();

            if(!$trashed_item){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا السؤال غير موجود '
                ]);        
            }
            Question::onlyTrashed()->where('id', $id)->restore();

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'استعادة السؤال',
                'notifyMsg' => 'تم استعادة السؤال بنجاح ',
                'item_id'=>$id
            ]);
           
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل استعادة السؤال لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
        
    }

    public function older($library_id)
    {
        $questionlibrary =  QuestionLibrary::find($library_id);
        if(!$questionlibrary){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه المكتبة غير موجودة '
            ]);        
        }
        $questions =$questionlibrary->questions()->selection()->paginate(PAGINATION_COUNT);
        Session::put('questions-filter','filter-older');
        return view('admin.questionlibrary.questions',compact('questions','library_id'));
    }
    public function un_active($library_id)
    {
        $questionlibrary =  QuestionLibrary::find($library_id);
        if(!$questionlibrary){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه المكتبة غير موجودة '
            ]);        
        }
        $questions =$questionlibrary->questions()->where('active','0')->selection()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);

        if(!$questions->count() > 0){
            return redirect()-> route('QuestionLibrary-dashboard.show',$library_id)
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد اسئلة غير مفعلة '
            ]);        
        }
        Session::put('questions-filter','filter-unactive');
        return view('admin.questionlibrary.questions',compact('questions','library_id'));
    }
    public function top_views($library_id)
    {
        $questionlibrary =  QuestionLibrary::find($library_id);
        if(!$questionlibrary){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه المكتبة غير موجودة '
            ]);        
        }
        $questions =$questionlibrary->questions()->selection()->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('questions-filter','filter-top-views');
        return view('admin.questionlibrary.questions',compact('questions','library_id'));
    }
    public function top_likes($library_id)
    {
        $questionlibrary =  QuestionLibrary::find($library_id);
        if(!$questionlibrary){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه المكتبة غير موجودة '
            ]);        
        }
        $questions =$questionlibrary->questions()->selection()->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('questions-filter','filter-top-likes');
        return view('admin.questionlibrary.questions',compact('questions','library_id'));
    }
    public function top_comments($library_id)
    {
        //هذه لم تفعلها بعد
        $questionlibrary =  QuestionLibrary::find($library_id);
        if(!$questionlibrary){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه المكتبة غير موجودة '
            ]);        
        }
        $questions =$questionlibrary->questions()->selection()->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);

        $questions = Question::where('library_id',$library_id)->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('questions-filter','filter-top-comments');
        return view('admin.questionlibrary.questions',compact('questions','library_id'));
    }

}

    
