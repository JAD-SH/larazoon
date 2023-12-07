<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Question;
use App\Models\QuestionLibrary;
use App\Http\Requests\front\QuestionRequest;
use App\Events\AddViewQuestionEvent;
use App\Events\AddLikeQuestionEvent;
use Auth;
use DB;
use Session;
use Spatie\SchemaOrg\Schema;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified'])->only(['createQuestion', 'deleteQuestion']);
        $this->middleware(function ($request, $next){
            Session::put('categorySLUG',MainCategory::where('route','Question')->first()->slug);
            return $next($request);
        });
    }
    public function index()
    {
        $questions = Question::active()->selection()->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
        $maincategory = MainCategory::where('route','Question')->active()->selection()->first();
        $searchtype = 'index';
        return view('front.questions',compact('questions','maincategory','searchtype'));
    }
    public function top_likes()
    {
        $questions = Question::active()->selection()->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        $maincategory = MainCategory::where('route','Question')->active()->selection()->first();
        $searchtype = 'likes';
        return view('front.questions',compact('questions','maincategory','searchtype'));
    }
    public function top_views()
    {
        $questions = Question::active()->selection()->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        $maincategory = MainCategory::where('route','Question')->active()->selection()->first();
        $searchtype = 'views';
        return view('front.questions',compact('questions','maincategory','searchtype'));
    }
    public function show($slug)
    {
        try{
            $question = Question::where('slug',$slug)->active()->selection()->first();
            if(!$question){
                return redirect()->route('Question.index')
                ->with([
                    'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا السؤال غير موجود    '
                ]);
            }
            $suggestedAnswer = $question->comments()->orderBy('likes', 'desc')->limit(4)->get();
            if($suggestedAnswer->count() > 0){
                $schemaArray=[];
                foreach ($suggestedAnswer as $key => $Answer) {
                    if($key == 0)
                        continue;
                    array_push($schemaArray,Schema::answer()->text($Answer->comment)->upvoteCount($Answer->likes)->url("https://example.com/question1#suggestedAnswer1")->datePublished($Answer->created_at));
                }
                $localBusiness = Schema::QAPage()->mainEntity(
                    Schema::question()->name($question->title)->text($question->description)->answerCount($question->comments()->count())->upvoteCount($question->likes)
                    ->acceptedAnswer(Schema::answer()->text($suggestedAnswer->first()->comment)->upvoteCount($suggestedAnswer->first()->likes)->url("https://example.com/question1#acceptedAnswer"))
                    ->suggestedAnswer($schemaArray)->datePublished($question->created_at)
                );
                $schemajspnscript = $localBusiness->toScript();
            }else{
                $schemaQuestion = Schema::article()->mainEntityOfPage(Schema::webPage()->identifier("هنا رابط المقال"))
                ->headline($question->title)->description($question->title)->author(Schema::organization()->name($question->user->name)->url('هنا رابط الشخص'))->publisher(Schema::organization()->name($question->user->name)->url('هنا رابط الشخص'))->datePublished($question->created_at)->dateModified($question->updated_at);
                $schemajspnscript = $schemaQuestion->toScript();
            }
            if(Auth::user()){
                DB::beginTransaction();//بما تواجه مشكلة فس المستقبل بسبب DB
                if(Auth::user()->id == $question->user->id){
                    $commentsNotWatches = $question->comments()->where('watch','0')->get();
                    if($commentsNotWatches !== null){
                        foreach ($commentsNotWatches as $comment) {
                            if($comment->watch == 0){
                                $comment ->update([
                                    'watch' => '1',
                                ]);
                            }
                        }
                    }
                    $comments_repliesNotWatches = $question->comments()->whereHas('comment_replies')->with('comment_replies')->get()->pluck('comment_replies')->flatten()->where('watch','0');
                    if($comments_repliesNotWatches->count() > 0){
                        foreach ($comments_repliesNotWatches as $comment_reply) {
                            if($comment_reply->watch == 0){
                                $comment_reply ->update([
                                    'watch' => '1',
                                ]);
                            }
                        }
                    }
                }
                $OwnerComments_repliesNotWatches = Auth::user()->OwnerComments()->where('question_id',$question->id)->where('watch','0')->get();
                if($OwnerComments_repliesNotWatches->count() > 0){
                    foreach ($OwnerComments_repliesNotWatches as $owner_comment_reply) {
                        if($owner_comment_reply->watch == 0){
                            $owner_comment_reply ->update([
                                'watch' => '1',
                            ]);
                        }
                    }
                }
                DB::commit();
            }
            event(new AddViewQuestionEvent($question));
            return view('front.question', compact('question','schemajspnscript'));
        }catch (\Exception $ex){
            DB::rollback();
            return redirect()->back()->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل عرض السؤال لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function question_search($slug)
    {
        try{
            $currentquestionlibrary = QuestionLibrary::where('slug',$slug)->active()->selection()->first();
            if(!$currentquestionlibrary){
                return redirect()->route('Question.index')->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد مكتبة اسئلة بهذا العنوان'
                ]);
            }
            $questions = $currentquestionlibrary->questions()->active()->selection()->orderBy('id','desc')->paginate(PAGINATION_COUNT);
            if($questions->count() == 0){
                return redirect()->route('Question.index')->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد اسئلة في مكتبة الاسئلة هذه'
                ]);
            }
            $maincategory = MainCategory::where('route','Question')->active()-selection()->first();
            return view('front.questions',compact('questions','maincategory','currentquestionlibrary'));
        }catch (\Exception $ex){
            return redirect()->route('Question.index')->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تصفية الاسئلة لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    /*
        public function question_ajax_search(Request $request, $id)
        {
            //return $id;
            try {
                if($request->ajax()){
                    $questionLibrary= QuestionLibrary::where('id',$id)->active()->selection()->first();

                    $questions =  $questionLibrary->questions()->active()->selection()->orderBy('id', 'desc')->limit(40)->get();

                    if($questions->count() > 0){
                        $output='';
                        foreach($questions as $index=>$question){
                            $output.=
                                '

                                
                            <div class="col-lg-8 card d-flex flex-md-row align-items-center justify-content-around p-3 shadow-sm border-0 rounded-5 my-3">
                                <div class="py-2 p-md-2">
                                    <a class="nav-link " href="'.route('Question.show',$question->id).'">
                                        <div class="text-dark fw-bolder fs-5">
                                        '.$question->title.'
                                        </div>
                                        <div class="my-3  m-md-2 fw-bolder">
                                        '.$question->getDescription().'
                                        </div>
                                    </a>
                                    <div class="my-3  m-md-2 ">
                                        
                                        <span class="badge bg-gradient-'.$questionLibrary->maincategory->first()->color.' text-sm text-light rounded-pill"># '.($index+1).' </span>
                                        ';
                                        foreach($question->questionlibraries as $questionlibrary) {
                                            $output.='<span class="badge bg-gradient-'.$questionLibrary->maincategory->first()->color.' text-sm text-light rounded-pill"> '.$questionlibrary->title.'</span>'; 
                                        }
                                    $output.='           
                                    </div>
                                    <div class="m-2 fw-bolder d-flex justify-content-between align-items-baseline">
                                        <div>
                                            <span class="badge text-sm text-secondary"><i class="fa-sharp fa-solid fa-eye text-'.$questionLibrary->maincategory->first()->color.' "></i>  '.$question->views.' المشاهدات</span>
                                            <span class="badge text-sm text-secondary"><i class="fa-solid fa-thumbs-up text-'.$questionLibrary->maincategory->first()->color.' "></i>  '.$question->likes.' الاعجابات</span>
                                            </div>
                                            <span class="badge text-sm text-secondary">'.$question->created_at->diffForHumans().' <i class="fa-solid fa-calendar-days text-'.$questionLibrary->maincategory->first()->color.' "></i></span>
                                    </div>
                                </div>
                            </div>

                            ';
                        }
                    }
                    else{
                        $output='<div class="fs-4 text-center p-5 font-weight-bolder pt-1">لم يتم إضافة كتب لهذه المكتبة بعد </div>';
                    }
                    return $output;
                }
            }catch (\Exception $ex){
                return redirect()->back() -> with([
                    'notifyType' => 'dangerToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'حدث خطأ ما يرجى المحاولة لاحقا '
                ]);
            }

        }
    */
    public function AddLike($id)
    {
        try{
            $question=Question::active()->find($id);
            if(!$question){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'هذا السؤال غير موجود'
                ]);
            }
            $status=event(new AddLikeQuestionEvent($question));
            if(!$status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'الاعجاب بالسؤال',
                    'notifyMsg' => 'شكرا لك انت بالفعل قد اعجبت بالسؤال   '.$question->title
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الاعجاب بالسؤال',
                'notifyMsg' => 'شكرا للإعجاب بالسؤال  '.$question->title
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل الإعجاب بالسؤال    '. $question->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function createQuestion(QuestionRequest $request)
    {
        try{
            $last_question = Auth::user()->questions()->orderBy('created_at', 'desc')->first();
            if($last_question != null){

                if($last_question->created_at->diffInHours() < 10){
                    return response() -> json([
                        'notifyType' => 'warningToast',
                        'notifyTitle' => 'فشل طرح سؤال جديد  ',
                        'notifyMsg' => 'لا يمكنك طرح سؤال جديد اكثر من مرة خلال 10 ساعات ... الوقت المتبقي لامكانية طرح سؤال جديد  ' . (10 - $last_question->created_at->diffInHours()) .' ساعة',
                    ]);
                }
            }

            DB::beginTransaction();
            $question=Question::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
            ]);
            $question->questionlibraries()->syncWithoutDetaching($request->questionlibraries);
            DB::commit();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'طرح سؤال جديد',
                'notifyMsg' => 'تم طرح السؤال  '.$request->title.' بنجاح  '
            ]);
        }catch (\Exception $ex){
            DB::rollback();
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل طرح السؤال  '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function deleteQuestion($question_id)
    {
        try{
            $question=Question::where('user_id',Auth::user()->id)->find($question_id);
            if($question == null){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'عذرا ... هذا السؤال غير موجود'
                ]);
            }
            $question_comments = $question -> comments() -> count();
            if($question_comments > 0){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'عذرا ... هذا السؤال لديه '.$question_comments.' إجابة من اشخاص اخرين بالتالي لا يمكنك حذفه'
                ]);
            }
            $question ->delete();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حذف السؤال ',
                'notifyMsg' => 'تم حذف السؤال بنجاح ',
                'item_id'=>$question_id
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل حذف السؤال .... الرجاء المحاولة لاحقا'
            ]);
        }
    }
}
