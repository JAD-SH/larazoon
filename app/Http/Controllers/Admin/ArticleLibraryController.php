<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleLibrary;
use App\Models\Mainable;
use App\Models\Article;
use App\Models\MainCategory;
use App\Http\Requests\admin\ArticleLibraryRequest;
use Session;

class ArticleLibraryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-articlelibraries-section');
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articlelibraries = ArticleLibrary::selection()->paginate(PAGINATION_COUNT);

        $art_top_likes=Article::with('articlelibrary')->active()->selection()->orderBy('likes', 'desc')->limit(5)->get();
        $art_top_views=Article::with('articlelibrary')->active()->selection()->orderBy('views', 'desc')->limit(5)->get();

        return view('admin.articlelibrary.index',compact('art_top_likes','art_top_views','articlelibraries'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articlelibrary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleLibraryRequest $request)
    {
        $main_category=  MainCategory::where('route','Article')->first();

        try{
            $articlelibrary = ArticleLibrary::create([
                'title' => $request->title,
                'active' => $main_category->active,
                'slug' => $request->slug,
                'section' => $request->section,
                'description' => $request->description,
            ]);

            //return "App\\Models\\".$main_category_id->route;
            Mainable::create([
                'main_category_id' => $main_category->id,
                'mainable_type' => "App\\Models\\ArticleLibrary",
                'mainable_id' => $articlelibrary->id,
            ]);

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء مكتبة مقالات جديدة',
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($library_id)
    {

        $articlelibrary =  ArticleLibrary::with('articles') -> find($library_id);

        if(!$articlelibrary){
            return redirect()-> route('ArticleLibrary-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه المكتبة غير موجودة '
            ]);        
        }

        if(!$articlelibrary->articles->count() > 0){
            return redirect()-> route('ArticleLibrary-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد مقالات لهذه المكتبة '
            ]);        
        }

        $articles =$articlelibrary ->articles()->selection()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('articles-filter','filter-index');

        return view('admin.article.index',compact('articles','library_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $articlelibrary = ArticleLibrary::selection()->find($id);
        if(!$articlelibrary){
            return redirect()->route('ArticleLibrary-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
            ]);
        }
        return view('admin.articlelibrary.edit', compact('articlelibrary')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleLibraryRequest $request, $id)
    {
         //return $request;
       try{
        $articlelibrary = ArticleLibrary::find($id);
            if(!$articlelibrary){
                return redirect()->route('ArticleLibrary-dashboard.index',$id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }

            $articlelibrary ->update([
                'title' => $request->title,
                'section' => $request->section,
                'description' => $request->description,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('ArticleLibrary-dashboard.index')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث المكتبة ','notifyMsg' => 'تم تحديث المكتبة  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('ArticleLibrary-dashboard.index')
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث المكتبة    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
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
            //return 'aaazzz';
            $articlelibrary = ArticleLibrary::find($id);
            if(!$articlelibrary){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }
            if($articlelibrary->articles->count() > 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يمكنك حذف مكتبة المقالات هذه بسبب احتوائها على مقالات بداخلها    '
                ]);
            }

            $articlelibrary ->delete();

            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف المكتبة ','notifyMsg' => 'تم حذف المكتبة  '.$articlelibrary->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف المكتبة    '. $articlelibrary->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function changeStatus($id)
    {
        try{
            $articlelibrary = ArticleLibrary::find($id);
            if(!$articlelibrary){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }
                
            if($articlelibrary->maincategory->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'القسم الرئيسي الخاص بمكتبة المقالات هذه غير مفعل بالتالي لا يمكنك تعديل حالة المكتبة    '
                ]);
            }
            
            $status=$articlelibrary->active == 0 ? '1' : '0';
            
            //ther is Observer
            $articlelibrary->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة المكتبة  ','notifyMsg' => 'تم بنجاح... المكتبة    '.$articlelibrary->title.'  '.$articlelibrary->getActive().'  الأن  ',
                'active'=>$articlelibrary->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة المكتبة    '. $articlelibrary->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    
    public function trashed(){
        //return 'aaaa';
         $trashed = Article::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(50);
        if(!$trashed->count()){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'لا يوجد مقالات في سلة المهملات    '
            ]);
        }
        return view('admin.articlelibrary.trashed',compact('trashed'));
    }

    public function restore($id){
        //return 'aaaa';
        try{
            $trashed_item = Article::onlyTrashed()->where('id', $id)->get();

            if(!$trashed_item){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا المقال غير موجود '
                ]);        
            }
            Article::onlyTrashed()->where('id', $id)->restore();

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'استعادة المقال',
                'notifyMsg' => 'تم استعادة المقال بنجاح ',
                'item_id'=>$id
            ]);
           
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل استعادة المقال لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
        
    }
}
