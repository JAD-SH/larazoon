<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Book;
use App\Models\BookLibrary;
use App\Events\AddViewBookEvent;
use App\Events\AddLikeBookEvent;
use Session;
use Spatie\SchemaOrg\Schema;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('categorySLUG',MainCategory::where('route','Book')->first()->slug);
            return $next($request);
        });
    }
    public function index()
    {
        $books = Book::active()->selection()->orderBy('id', 'desc')->paginate(PAGINATION_COUNT+2);
        $maincategory = MainCategory::where('route','Book')->active()->selection()->first();
        $searchtype = 'index';
        return view('front.books',compact('books','maincategory','searchtype'));
    }
    public function top_likes()
    {
        $books = Book::active()->selection()->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        $maincategory = MainCategory::where('route','Book')->active()->selection()->first();
        $searchtype = 'likes';
        return view('front.books',compact('books','maincategory','searchtype'));
    }
    public function top_downloads()
    {
        $books = Book::active()->selection()->orderBy('downloads', 'desc')->paginate(PAGINATION_COUNT);
        $maincategory = MainCategory::where('route','Book')->active()->selection()->first();
        $searchtype = 'downloads';
        return view('front.books',compact('books','maincategory','searchtype'));
    }
    public function show($slug)
    {
        try{
            $book = Book::where('slug',$slug)->active()->selection()->first();
            if(!$book){
                return redirect()->route('Book.index')
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكتاب غير موجود    '
                ]);
            }
            event(new AddViewBookEvent($book));
            $schemaBook = Schema::article()->mainEntityOfPage(Schema::webPage()->identifier("هنا رابط الكتاب"))
            ->headline($book->title)->description($book->description)->image($book->photo)->author(Schema::organization()->name('HelloLaravel')->url('http://localhost/HelloLaravel/'))->publisher(Schema::organization()->name('HelloLaravel')->logo(Schema::imageObject()->url('http://localhost/HelloLaravel/')))->datePublished($book->created_at)->dateModified($book->updated_at);
            $schemajspnscript = $schemaBook->toScript();
            return view('front.book', compact('book','schemajspnscript'));
        }catch (\Exception $ex){
            return redirect()->route('Book.index')
            ->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل عرض الكتاب لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function book_search($slug)
    {
        try{
            $currentbooklibrary = BookLibrary::where('slug',$slug)->active()->selection()->first();
            if(!$currentbooklibrary){
                return redirect()->route('Book.index')
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => ' مكتبة الكتب هذه غير موجودة'
                ]);
            }
            $books = Book::where('library_id',$currentbooklibrary->id)->active()->selection()->orderBy('id', 'desc')->paginate(PAGINATION_COUNT);
            if($books->count() == 0){
                return redirect()->route('Book.index')
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'لا يوجد كتب في مكتبة الكتب هذه'
                ]);
            }
            $maincategory = MainCategory::where('route','Book')->active()->selection()->first();
            return view('front.books',compact('books','maincategory','currentbooklibrary'));
        }catch (\Exception $ex){
            return redirect()->route('Book.index')
            ->with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تصفية الكتب لسبب ما يرجى المحاولة لاحقا '
            ]);
        }

    }
    /*
        public function book_ajax_search(Request $request, $id)
        {
            try {
                
                if($request->ajax()){
                    $books = Book::with('booklibrary')->active()->where('library_id',$id)->selection()->limit(40)->get();
                    if($books->count() > 0){
                        $output='';
                        foreach($books as $index=>$book){
                            $output.=
                                '

                                <div class="col-sm-11 col-md-6 col-lg-4 p-0">

                                    <div class=" position-relative card d-flex  align-items-center justify-content-around   m-2 border-0 rounded-5  shadow-sm card-book overflow-hidden">
                                        <div class="position-absolute w-100 bg-gradient-';
                                        if($index <= 2){$output.='danger';}else{$output.=$books[0]->booklibrary->maincategory->first()->color;} 
                                        $output.=' top-0 top-3-books"></div>
                                        <a class="w-100  " href="'.route('Book.show',$book->id).'">
                                        <div class="w-100 justify-content-center align-items-center d-flex p-3">
                                        
                                            <div class="book my-3 me-n3 me-md-0">
                                                <div class="book-sign bg-dark">
                                                </div>
                                                <div class="paper front-bage">
                                                    <div class="spring">
                                                        <div class="spring-point"></div>
                                                        <div class="spring-point"></div>
                                                        <div class="spring-point"></div>
                                                        <div class="spring-point"></div>
                                                        
                                                    </div>
                                                    <img src="'.$book->photo.'" alt="">
                                                </div>
                                                <div class="paper middle-bages bg-1">
                    
                                                </div>
                                                <div class="paper middle-bages bg-2">
                    
                                                </div>
                                                <div class="paper middle-bages bg-3">
                    
                                                </div>
                                                <div class="paper middle-bages bg-4">
                    
                                                </div>
                                                <div class="paper middle-bages bg-5">
                    
                                                </div>
                                                <div class="paper back-bage">
                    
                                                </div>
                                            </div>
                                        </div>    
                                        <div class=" p-3 mx-md-3 mx-lg-0 w-100 text-start">
                                                <div class="mb-2 mt-2 mt-md-0 fs-5 text-dark fw-bolder ">
                                                    '.$book->title.'
                                                </div>
                                                
                                            
                                            <div class="my-3  my-md-2  ">
                                                
                                                <span class="badge bg-gradient-'.$books[0]->booklibrary->maincategory->first()->color.'  text-light rounded-pill text-sm"># '.($index+1).' </span>
                                                <span class="badge bg-gradient-'.$books[0]->booklibrary->maincategory->first()->color.'  text-light rounded-pill text-sm"> '.$book->booklibrary->title.'</span>
                                                                    
                                            </div>
                                            <div class="my-2 fw-bolder ">
                                                @if( $index <= 2)<span class="badge text-sm"><i class="fa-solid fa-ranking-star text-warning"></i>  </span>@endif
                                                <span class="badge text-secondary text-sm"><i class="fa-sharp fa-solid fa-eye text-'.$books[0]->booklibrary->maincategory->first()->color.'"></i>  '.$book->views.'</span>
                                                <span class="badge text-secondary text-sm"><i class="fa-solid fa-thumbs-up text-'.$books[0]->booklibrary->maincategory->first()->color.'"></i>  '.$book->likes.'</span>
                                                <span class="badge text-secondary text-sm"><i class="fa-solid fa-download text-'.$books[0]->booklibrary->maincategory->first()->color.'"></i>  '.$book->downloads.'</span>
                                                <span class="badge text-secondary text-sm"> <i class="fa-solid fa-calendar-days text-'.$books[0]->booklibrary->maincategory->first()->color.'"></i>'.$book->created_at->diffForHumans().'</span>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div> 

                                '
                            ;
                        }
                    }
                    else{
                        $output='<div class="fs-4 text-center p-5 fw-bolder pt-1">لم يتم إضافة كتب لهذه المكتبة بعد </div>';
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
            $book=Book::active()->find($id);
            if(!$book){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'هذا الكتاب غير موجود'
                ]);
            }
            $status=event(new AddLikeBookEvent($book));
            if(!$status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'الاعجاب بالكتاب',
                    'notifyMsg' => 'شكرا لك انت بالفعل قد اعجبت بالكتاب   '.$book->title
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الاعجاب بالكتاب',
                'notifyMsg' => 'شكرا للإعجاب بالكتاب  '.$book->title
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل الإعجاب بالكتاب    '. $book->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
    public function book_download($id)
    {
        try{
            $book=Book::active()->find($id);
            if(!$book){
                return redirect()->back() -> with([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل التحميل',
                    'notifyMsg' => 'هذا الكتاب غير موجود'
                ]);
            }
            $downloads = $book -> downloads +1;
            $book->update([
                'downloads'=> $downloads,
            ]);
            return  response()->download($book->file);           
        }catch (\Exception $ex){
            return redirect()->back() -> with([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل تحميل الكتاب  '. $book->title.' لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
}

