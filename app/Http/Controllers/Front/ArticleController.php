<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Article;
use App\Models\ArticleLibrary;
use App\Events\AddViewArticleEvent;
use App\Events\AddLikeArticleEvent;
use Session;
use Spatie\SchemaOrg\Schema;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('categorySLUG',MainCategory::where('route','Article')->first()->slug);
            return $next($request);
        });
    }
    public function index()
    {
        //قرر هل تريد تفعيل schema لهذه الميثود
        /*
            $AllMainCategories = MainCategories();
            $AllSubCategories = SubCategories();
            $schemaArray=[];
            foreach ($AllMainCategories as $key => $mainCategory) {
                array_push($schemaArray,
                    Schema::listItem()->position($key+1)->item(
                        Schema::course()->url($Course->slug)->name($Course->name)->description($Course->slug)
                        ->provider(Schema::organization()->name('HelloLaravel')->sameAs("https://www.example.com1"))
                    )
                );
                
            }
            $schemaCourses = Schema::itemList()->itemListElement($schemaArray);
            
            echo $schemaCourses->toScript();
        */
        $articles = Article::active()->selection()->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
        $maincategory = MainCategory::active()->selection()->where('route','Article')->first();
        $searchtype = 'index';
        return view('front.articles',compact('articles','maincategory','searchtype'));
    }
    public function top_likes()
    {
        $articles = Article::active()->selection()->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        $maincategory = MainCategory::active()->selection()->where('route','Article')->first();
        $searchtype = 'likes';
        return view('front.articles',compact('articles','maincategory','searchtype'));
    }
    public function top_views()
    {
        $articles = Article::active()->selection()->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        $maincategory = MainCategory::active()->selection()->where('route','Article')->first();
        $searchtype = 'views';
        return view('front.articles',compact('articles','maincategory','searchtype'));
    }
    public function show($slug)
    {
        try{
            $article = Article::where('slug',$slug)->active()->selection()->first();
            $moreArticles = Article::where('library_id',$article->library_id)->whereNot('id',$article->id)->active()->selection()->orderBy('views', 'desc')->limit(6)->get();
            if(!$article){
                return redirect()->route('Article.index')
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا المقال غير موجود    '
                ]);
            }
            event(new AddViewArticleEvent($article));
    
            $schemaArticle = Schema::article()->mainEntityOfPage(Schema::webPage()->identifier("هنا رابط المقال"))
            ->headline($article->title)->description($article->description)->image($article->photo)->author(Schema::organization()->name('HelloLaravel')->url('http://localhost/HelloLaravel/'))->publisher(Schema::organization()->name('HelloLaravel')->logo(Schema::imageObject()->url('http://localhost/HelloLaravel/')))->datePublished($article->created_at)->dateModified($article->updated_at);
            $schemajspnscript = $schemaArticle->toScript();

            return view('front.article', compact('article','moreArticles','schemajspnscript'));
        }catch (\Exception $ex){
            return redirect()->route('Article.index')
            ->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل عرض المقال لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function article_search($slug)
    {
        try{
            $currentarticlelibrary = ArticleLibrary::where('slug',$slug)->active()->selection()->first();
            if(!$currentarticlelibrary){
                return redirect()->route('Article.index')
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => ' مكتبة المقالات هذه غير موجودة'
                ]);
            }
            $articles = Article::where('library_id',$currentarticlelibrary->id)->active()->selection()->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
            if($articles->count() == 0){
                return redirect()->route('Article.index')
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد مقالات في مكتبة المقالات هذه'
                ]);
            }
            $maincategory = MainCategory::where('route','Article')->active()->selection()->first();
            return view('front.articles',compact('articles','maincategory','currentarticlelibrary'));
        }catch (\Exception $ex){
            return redirect()->route('Article.index')
            ->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تصفية المقالات لسبب ما يرجى المحاولة لاحقا '
            ]);
        }

    }
    /* هذا بحث عبر اجاكس لا احتاجه لكن في المستقبل ربما تريده
        public function article_ajax_search(Request $request, $id)
        {
            try {
                return ArticleLibrary::first();
                if($request->ajax()){
                    $articles = Article::with('articlelibrary')->active()->where('library_id',$id)->selection()->limit(40)->get();
                    if($articles->count() > 0){
                        $output='';
                        foreach($articles as $index=>$article){
                            $output.=
                                '




                                
                                <div class=" card px-3 mx-1 mx-md-4 my-3 shadow-sm border-0 rounded-5 overflow-hidden">
                                    <a class="d-md-flex flex-md-row align-items-center" href="'.route("Article.show",$article->id).'">
                                        <div class=" article-image text-center  overflow-hidden">
                                            
                                            <img class="w-100" src="'.asset($article->photo).'" alt="">
                                            
                                        </div>
                                    
                                        <div class="py-3 py-md-0 ps-md-3">
                                            
                                                <div class="mb-2 fs-5 text-dark fw-bolder">
                                                '.$article->title.' 
                                                </div>
                                                <span class="mb-2  fw-bolder">
                                                '.$article->description.' 
                                                </span>
                                            
                                            <div class="my-3  m-md-2">
                                                
                                            <span class="badge bg-gradient-'.$article->articlelibrary->maincategory->first()->color.'  text-light rounded-pill text-sm"># '.($index+1).' </span>
                                            <span class="badge bg-gradient-'.$article->articlelibrary->maincategory->first()->color.'  text-light rounded-pill text-sm"> '.$article->articlelibrary->title.'</span>
                                                                
                                            </div>
                                            <div class="m-md-2 fw-bolder d-md-flex justify-content-between align-items-baseline">
                                                <span class="badge text-secondary text-sm"><i class="fa-sharp fa-solid fa-eye text-'.$article->articlelibrary->maincategory->first()->color.'"></i>  '.$article->views.' <span class="d-none d-md-inline-block">المشاهدات</span></span>
                                                <span class="badge text-secondary text-sm"><i class="fa-solid fa-thumbs-up text-'.$article->articlelibrary->maincategory->first()->color.'"></i>  '.$article->likes.' <span class="d-none d-md-inline-block">الاعجابات</span></span>
                                                <span class="badge text-secondary text-sm">'.$article->created_at->diffForHumans().'<i class="fa-solid fa-calendar-days text-'.$article->articlelibrary->maincategory->first()->color.'"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                '
                            ;
                        }
                    }
                    else{
                        $output='<div class="fs-4 text-center p-5 font-weight-bolder pt-1">لم يتم إضافة مقالات لهذا القسم بعد </div>';
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
            $article=Article::active()->find($id);
            if(!$article){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'هذا المقال غير موجود'
                ]);
            }
            $status=event(new AddLikeArticleEvent($article));
            if(!$status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'الاعجاب بالمقال',
                    'notifyMsg' => 'شكرا لك انت بالفعل قد اعجبت بالمقال   '.$article->title
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الاعجاب بالمقال',
                'notifyMsg' => 'شكرا للإعجاب بالمقال  '.$article->title
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل الإعجاب بالمقال    '. $article->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
}
