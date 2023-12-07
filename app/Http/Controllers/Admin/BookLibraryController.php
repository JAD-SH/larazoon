<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookLibrary;
use App\Models\Mainable;
use App\Models\Book;
use App\Models\MainCategory;
use App\Http\Requests\admin\BookLibraryRequest;
use Illuminate\Support\Str;
use Session;

class BookLibraryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-booklibraries-section');
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
        $booklibraries = BookLibrary::selection()->paginate(PAGINATION_COUNT);
        
        $book_top_downloads=Book::with('booklibrary')->active()->selection()->orderBy('downloads', 'desc')->limit(5)->get();
        $book_top_views=Book::with('booklibrary')->active()->selection()->orderBy('views', 'desc')->limit(5)->get();

        return view('admin.booklibrary.index',compact('book_top_downloads','book_top_views','booklibraries'));
    }


//تابع يجب تعديل جميع الاسماء للمكتبة Library الى BookLibraries مع تعديل ملحقاتها مثل viewe , model الخ


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.booklibrary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookLibraryRequest $request)
    {

        try{
            
            $main_category= MainCategory::where('route','Book')->first();

            $booklibrary = BookLibrary::create([
                'title' => $request->title,
                'active' => $main_category->active,
                'slug' => $request->slug,
                'section' => $request->section,
                'description' => $request->description,
            ]);
            
            //return "App\\Models\\".$main_category_id->route;
            Mainable::create([
                'main_category_id' => $main_category->id,
                'mainable_type' => "App\\Models\\BookLibrary",
                'mainable_id' => $booklibrary->id,
            ]);

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء مكتبة جديدة',
                'notifyMsg' => 'تم انشاء المكتبة  '.$request->title.'  بنجاح '
            ]);
           
            }catch (\Exception $ex){
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
        $booklibrary =  BookLibrary::with('books') -> find($library_id);

        if(!$booklibrary){
            return redirect()-> route('BookLibrary-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه المكتبة غير موجودة '
            ]);        
        }

        if(!$booklibrary->books->count() > 0){
            return redirect()-> route('BookLibrary-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد كتب لهذه المكتبة '
            ]);        
        }
        $books =$booklibrary ->books()->selection()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('books-filter','filter-index');
        return view('admin.book.index',compact('books','library_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $booklibrary = BookLibrary::selection()->find($id);
        if(!$booklibrary){
            return redirect()->route('BookLibrary-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
            ]);
        }
        return view('admin.booklibrary.edit', compact('booklibrary')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookLibraryRequest $request, $id)
    {
         //return $request;
       try{
        $booklibrary = BookLibrary::find($id);
            if(!$booklibrary){
                return redirect()->route('BookLibrary-dashboard.index',$id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }

           
            $booklibrary ->update([
                'title' => $request->title,
                'section' => $request->section,
                'description' => $request->description,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('BookLibrary-dashboard.index')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث المكتبة ','notifyMsg' => 'تم تحديث المكتبة  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('BookLibrary-dashboard.index')
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
            $booklibrary = BookLibrary::find($id);
            if(!$booklibrary){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }

            if($booklibrary->books->count() > 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يمكنك حذف مكتبة الكتب هذه بسبب احتوائها على كتب بداخلها    '
                ]);
            }

            
            $booklibrary ->delete();

            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف المكتبة ','notifyMsg' => 'تم حذف المكتبة  '.$booklibrary->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف المكتبة    '. $booklibrary->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function changeStatus($id)
    {
        try{
            $booklibrary = BookLibrary::find($id);
            if(!$booklibrary){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه المكتبة غير موجودة    '
                ]);
            }
              /*
            if($booklibrary->maincategory->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'القسم الرئيسي الخاص بمكتبة الكتب هذه غير مفعل بالتالي لا يمكنك تعديل حالة المكتبة    '
                ]);
            }
           */

            $status=$booklibrary->active == 0 ? '1' : '0';
            
            //ther is Observer
            $booklibrary->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة المكتبة  ','notifyMsg' => 'تم بنجاح... المكتبة    '.$booklibrary->title.'  '.$booklibrary->getActive().'  الأن  ',
                'active'=>$booklibrary->active
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة المكتبة    '. $booklibrary->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    
    public function trashed(){
        //return 'aaaa';
         $trashed = Book::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(50);
        if(!$trashed->count()){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'لا يوجد كتب في سلة المهملات    '
            ]);
        }
        return view('admin.booklibrary.trashed',compact('trashed'));
    }

    public function restore($id){
        //return 'aaaa';
        try{
            $trashed_item = Book::onlyTrashed()->where('id', $id)->get();

            if(!$trashed_item){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا الكتاب غير موجود '
                ]);        
            }
            Book::onlyTrashed()->where('id', $id)->restore();

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'استعادة الكتاب',
                'notifyMsg' => 'تم استعادة الكتاب بنجاح ',
                'item_id'=>$id
            ]);
           
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل استعادة الكتاب لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
        
    }
}
