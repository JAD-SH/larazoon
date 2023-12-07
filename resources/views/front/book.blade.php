
@extends('layouts.front.site')

@section('title',$book->title)
@section('description',$book->description)
@section('og:url',route('Book.show',$book->slug))
@section('og:image',asset($book->photo))
@section('og:image:url',asset($book->photo))


@section('css')
<link href="{{asset('public/assets/css/book.css')}}" rel="stylesheet" />
    <style>
    
    </style>
    {!!$schemajspnscript!!}
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route($book->booklibrary->maincategory->first()->route.'.index')}}">{{$book->booklibrary->maincategory->first()->title}} <i class="m-auto fa-sharp fa-solid fa-book"></i></a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$book->title}}</li>
@endsection

@section('content')


@verify

    <form action="{{route('save-book',$book->id)}}" method="POST">
        @csrf
        <button data-sos-once="true" data-sos="sos-right" id="save-items-continer" class=" bg-gradient-{{$book->booklibrary->maincategory->first()->color}} position-fixed rounded-1 d-none d-lg-block ajax-submit">
            <i id="save-items-btn" class="fa-solid fa-plus text-white p-3 "></i>
        </button>
    </form>
@else
    <button data-sos-once="true" data-sos="sos-right" id="save-items-continer" class=" bg-gradient-{{$book->booklibrary->maincategory->first()->color}} position-fixed rounded-1 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#LoginModal" >
        <i id="save-items-btn" class="fa-solid fa-plus text-white p-3 "></i>
    </button>
@endverify

    <div class="card  m-1 m-md-4 p-2 p-md-4  border-0 rounded-5  shadow-sm mb-3 overflow-hidden">
        <div class="round-squer bg-gradient-{{$book->booklibrary->maincategory->first()->color}} "></div>
        <div class="flex-column d-flex flex-md-row align-items-center justify-content-evenly p-3 pt-5  my-3 card-book">
            
        <div class="book me-n3 me-md-0">
            <div class="book-sign">
            </div>
            <div class="paper front-bage">
                <div class="spring">
                    <div class="spring-point"></div>
                    <div class="spring-point"></div>
                    <div class="spring-point"></div>
                    <div class="spring-point"></div>
                    
                </div>
                <img src="{{$book->photo}}" alt="">
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
        
            <div class=" py-3 pb-0 py-md-0  m-2 w-md-65">
                <div class="my-4 text-center  text-md-start">
                    <h1 class="mb-2 fs-3 fw-bolder text-dark d-inline" href="{{route($book->booklibrary->maincategory->first()->route.'.show',$book->slug)}}">
                        {{$book->title}} 
                    </h1>
                    
                </div>
                <div class="m-2 fw-bolder">

                    <span class=" badge text-sm text-secondary">
                        <i class="p-1 fs-6 fa-solid fa-download text-{{$book->booklibrary->maincategory->first()->color}}"></i>التحميلات {{$book->downloads}} 
                    </span>  
                    
                    <span class=" badge text-sm text-secondary">
                        <i class="p-1 fs-6 fa-solid fa-book text-{{$book->booklibrary->maincategory->first()->color}}"></i>حجم الكتاب {{$book->downloads}} 
                    </span> 
                    
                    <span class=" badge text-sm text-secondary">
                        <i class="p-1 fs-6 fa-solid fa-scroll  text-{{$book->booklibrary->maincategory->first()->color}}"></i>عدد الصفحات {{$book->downloads}}  
                    </span>  
                    
                    <span class="badge text-sm text-secondary " >
                        <i class="p-1 fa-solid fa-calendar-days  text-{{$book->booklibrary->maincategory->first()->color}}"></i>{{$book->created_at->diffForHumans()}} 
                    </span>
                </div>
            </div>
        </div>
        <div class="mx-3 mb-0">
            
            <div data-sos-once="true" data-sos="sos-top" class=" my-3 fw-bolder">
                <span class="text-dark fs-5">وصف الكتاب :</span> {{$book->description}}
            </div>
            
            <div data-sos-once="true" data-sos="sos-top" class=" my-3 fw-bolder">
                <span class="text-dark fs-5">لغة الكتاب :</span> {{$book->language}}
            </div>

            <div data-sos-once="true" data-sos="sos-top" class=" my-3 fw-bolder">
                <span class="text-dark fs-5">مؤلف الكتاب :</span> {{$book->author}}
            </div>
            
            <div data-sos-once="true" data-sos="sos-top" class=" my-3 fw-bolder">
                <span class="text-dark fs-5">رخصة الكتاب :</span> {{$book->description}}
            </div>
            
            <div data-sos-once="true" data-sos="sos-top" class=" my-3 fw-bolder">
                <span class="text-dark fs-5">المصدر :</span> {{$book->description}}
            </div>

            <div data-sos-once="true" data-sos="sos-top" class=" my-3 fw-bolder">
                <span class="text-dark fs-5">مكتبة الكتاب :</span> <span class="badge fs-6 bg-{{$book->booklibrary->maincategory->first()->color}} text-light rounded-pill" href="#" > {{$book->booklibrary->title}}</span>
            </div>
            <hr class="horizontal dark">
        </div>
        <div class="m-4 fw-bolder text-center">
            <a href="{{route('book.download',$book->id)}}">
                <button data-sos="sos-top"  class="btn bg-gradient-{{$book->booklibrary->maincategory->first()->color}} m-1 py-2 px-4 fs-5 border-2 rounded-4 fw-bolder ">
                    تحميل الكتاب  <i class="fs-4 fa-solid fa-download "></i>
                </button>
            </a>
        </div>
                
    </div>
    

    @include('front.includes.alerts.likes-views', 
       ['isliked' => 'book'.$book->id.'IsLiked' ,
        'likedroute' => route('Book.AddLike',$book->id) ,
        'color' => $book->booklibrary->maincategory->first()->color ,
        'name' => 'الكتاب',
        'likes' => $book->likes,'views' => $book->views])

@endsection


@section('script')

<script>
    //ajax_function();
    create_save_btn("{{$book->booklibrary->maincategory->first()->color}}","{{route('save-book',$book->id)}}");
</script>

@endsection