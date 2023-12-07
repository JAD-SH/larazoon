<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleLibrary;
use App\Http\Requests\admin\ArticleRequest;
use Illuminate\Support\Str;
use Session;


class ArticleController extends Controller
{
   


    public function older($library_id)
    {
        $articles = Article::where('library_id',$library_id)->paginate(PAGINATION_COUNT);
        Session::put('articles-filter','filter-older');
        return view('admin.article.index',compact('articles','library_id'));
    }
    public function un_active($library_id)
    {
        $articles = Article::where('library_id',$library_id)->where('active','0')->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        if(!$articles->count() > 0){
            return redirect()-> route('ArticleLibrary-dashboard.show',$library_id)
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد مقالات غير مفعلة '
            ]);        
        }
        Session::put('articles-filter','filter-unactive');
        return view('admin.article.index',compact('articles','library_id'));
    }
    public function top_views($library_id)
    {
        $articles = Article::where('library_id',$library_id)->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('articles-filter','filter-top-views');
        return view('admin.article.index',compact('articles','library_id'));
    }
    public function top_likes($library_id)
    {
        $articles = Article::where('library_id',$library_id)->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('articles-filter','filter-top-likes');
        return view('admin.article.index',compact('articles','library_id'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($library_id)
    {
        
       // $library_id = $id;
        return view('admin.article.create',compact('library_id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        try{
            //return $request;
            $photoPath='default_photo.PNG';
            
            if($request->has('photo'))
                $photoPath=uploadFile($request->photo,'images/articles');

            $library_active = ArticleLibrary::find($request->library_id)->active;

            Article::create([
                'library_id' => $request->library_id,
                'title' => $request->title,
                'photo' => $photoPath,
                'active' => $library_active,
                'slug' => $request->slug,
                'description' => $request->description,
                'content' => $request->content,
                'style' => $request->style,
                'script' => $request->script,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء مقال جديد',
                'notifyMsg' => 'تم انشاء المقال  '.$request->title.'  بنجاح '
            ]);
           
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء المقال    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
            
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content =  Article:: find($id);

        if(!$content){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا المقال غير موجود '
            ]);        
        }
        return view('admin.item',compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::selection()->find($id);
        if(!$article){
            return redirect()->back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا المقال غير موجود    '
            ]);
        }
        return view('admin.article.edit', compact('article')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        //return $request;
        try{
            $article = Article::find($id);
            if(!$article){
                return redirect()->route('ArticleLibrary-dashboard.show',$request->library_id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا المقال غير موجود    '
                ]);
                
            }

            if($request->has('photo')){
                $photoPath=uploadFile($request->photo,'images/articles');
                $article ->update([
                    'photo'=>$photoPath,
                ]);
            }

            $article ->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'style' => $request->style,
                'script' => $request->script,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('ArticleLibrary-dashboard.show',$request->library_id)
            ->with([
                'notifyType' => 'successToast','notifyTitle' => ' التعديل على المقال ','notifyMsg' => 'تم التعديل على المقال  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('ArticleLibrary-dashboard.show',$request->library_id)
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث المقال    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
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
            $article = Article::find($id);
            if(!$article){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا المقال غير موجود    '
                ]);
            }
/*
            $photo = Str::after($article->photo, 'public/assets/');// public/assets/تحذف مسار الصورة وتترك باقي المسار الي بعد 
            $photo = base_path('public/assets/' . $photo);//ترجع مسار الصورة الكامل
            unlink($photo); //delete from folder
*/
            $article ->delete();
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'حذف المقال ',
                'notifyMsg' => 'تم حذف المقال  '.$article->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل حذف المقال    '. $article->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function changeStatus($id)
    {
        try{
            $article = Article::find($id);
            if(!$article){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا المقال غير موجود    '
                ]);
            }
                
            if($article->articlelibrary->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'مكتبة المقالات الخاصة بالمقال  هذا غير مفعلة بالتالي لا يمكنك تعديل حالة المقال    '
                ]);
            }

            $status=$article->active == 0 ? '1' : '0';
            
            $article->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'تغيير حالة المقال  ',
                'notifyMsg' => 'تم بنجاح... المقال    '.$article->getActive().'  الأن  ',
                'active'=>$article->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تغيير حالة المقال    '. $article->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function move(Request $Request ,$id)
    {
        try{
            $article = Article::find($id);
            $articlelibrary = ArticleLibrary::find($Request->library_id);

            if(!$article){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا المقال غير موجود    '
                ]);
            }
            if(!$articlelibrary){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'مكتبة المقالات هذه غير موجودة  '
                ]);
            }
                
            $article->update([
                'library_id'=>$Request->library_id,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'نقل المقال  ',
                'notifyMsg' => ' تم نقل المقال الى مكتبة المقالات  '.$articlelibrary->title.'  بنجاح  ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل نقل المقال    '. $article->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function tryit_page($tryitable_id)
    {
        try{
            $article = Article::find($tryitable_id);
            if(!$article){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المقالة غير موجودة    '
                ]);
            }
             $tryitcodes = $article->tryitCodes()->get();
             $tryitable_type = "Article";
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
            $article = Article::find($imageable_id);
            if(!$article){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المقالة غير موجودة    '
                ]);
            }
             $images = $article->images()->get();
             $imageable_type = "Article";
            return view('admin.image.index',compact('imageable_id','imageable_type','images'));

        }catch (\Exception $ex){
            return $ex;
            return redirect()->back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' حدث خطأ ما يرجى المحاولة لاحقا '
            ]);
        }
    }


}
