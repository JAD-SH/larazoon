<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookLibrary;
use App\Http\Requests\admin\BookRequest;
use Illuminate\Support\Str;
use Session;

class BookController extends Controller
{



    public function older($library_id)
    {
        $books = Book::where('library_id',$library_id)->paginate(PAGINATION_COUNT);
        Session::put('books-filter','filter-older');
        return view('admin.book.index',compact('books','library_id'));
    }
    public function un_active($library_id)
    {
        $books = Book::where('library_id',$library_id)->where('active','0')->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        if(!$books->count() > 0){
            return redirect()-> route('BookLibrary-dashboard.show',$library_id)
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد كتب غير مفعلة '
            ]);        
        }
        Session::put('books-filter','filter-unactive');
        return view('admin.book.index',compact('books','library_id'));
    }
    public function top_downloads($library_id)
    {
        $books = Book::where('library_id',$library_id)->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('books-filter','filter-top-downloads');
        return view('admin.book.index',compact('books','library_id'));
    }
    public function top_likes($library_id)
    {
        $books = Book::where('library_id',$library_id)->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('books-filter','filter-top-likes');
        return view('admin.book.index',compact('books','library_id'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($library_id)
    {
       // $library_id = $id;
        return view('admin.book.create',compact('library_id'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        //return $request;
        try{
            $photoPath='default_photo.PNG';
            
            $photoPath=uploadFile($request->photo,'images/books');
            $filePath=uploadFile($request->file,'files/books');
            
            $library_active = BookLibrary::find($request->library_id)->active;

            Book::create([
                'title' => $request->title,
                'photo' => $photoPath,
                'file' => $filePath,
                'active' => $library_active,
                'slug' => $request->slug,
                'language' => $request->language,
                'author' => $request->author,
                'description' => $request->description,
                'library_id' => $request->library_id,
            ]);

            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء كتاب جديد',
                'notifyMsg' => 'تم انشاء الكتاب  '.$request->title.'  بنجاح '
            ]);
           
        }catch (\Exception $ex){
            return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء الكتاب    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
       
       
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $book = Book::selection()->find($id);
        //$library_id = $book->library->id;
        if(!$book){
            return redirect()->back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكتاب غير موجود    '
            ]);
        }
        return view('admin.book.edit', compact('book')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
         //return $request;

       try{
        $book = Book::find($id);
            if(!$book){
                return redirect()-> route('BookLibrary-dashboard.show',$request->library_id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكتاب غير موجود    '
                ]);
            }

            if($request->has('photo')){
                $photoPath=uploadFile($request->photo,'images/books');
                $book ->update([
                    'photo'=>$photoPath,
                ]);
            }
            if($request->has('file')){
                $filePath=uploadFile($request->file,'files/books');
                $book ->update([
                    'file'=>$filePath,
                ]);
            }
            $book ->update([
                'title' => $request->title,
                'language' => $request->language,
                'author' => $request->author,
                'description' => $request->description,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('BookLibrary-dashboard.show',$request->library_id)
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث الكتاب ','notifyMsg' => 'تم تحديث الكتاب  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
           // return $ex;
            return redirect()-> route('BookLibrary-dashboard.show',$request->library_id)
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث الكتاب    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
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
            $book = Book::find($id);
            if(!$book){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكتاب غير موجود    '
                ]);
            }
/*
            $photo = Str::after($book->photo, 'public/assets/');// public/assets/تحذف مسار الصورة وتترك باقي المسار الي بعد 
            $photo = base_path('public/assets/' . $photo);//ترجع مسار الصورة الكامل
            unlink($photo); //delete from folder
            */
            $book ->delete();            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف الكتاب ','notifyMsg' => 'تم حذف الكتاب  '.$book->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف الكتاب    '. $book->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function changeStatus($id)
    {
        try{
            $book = Book::find($id);
            if(!$book){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكتاب غير موجود    '
                ]);
            }
                
            if($book->booklibrary->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'مكتبة الكتب الخاصة بالكتاب  هذا غير مفعلة بالتالي لا يمكنك تعديل حالة الكتاب    '
                ]);
            }

            $status=$book->active == 0 ? '1' : '0';
            
            $book->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة الكتاب  ','notifyMsg' => 'تم بنجاح... الكتاب    '.$book->title.'  '.$book->getActive().'  الأن  ',
                'active'=>$book->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة الكتاب    '. $book->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function move(Request $Request ,$id)
    {
        try{
            $book = Book::find($id);
            $booklibrary = BookLibrary::find($Request->library_id);

            if(!$book){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذا الكتاب غير موجود    '
                ]);
            }
            if(!$booklibrary){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'مكتبة الكتب هذه غير موجودة  '
                ]);
            }
                
            $book->update([
                'library_id'=>$Request->library_id,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'نقل الكتاب  ',
                'notifyMsg' => ' تم نقل الكتاب الى مكتبة الكتب  '.$booklibrary->title.'  بنجاح  ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل نقل الكتاب    '. $book->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
}
