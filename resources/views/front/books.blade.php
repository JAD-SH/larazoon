@extends('layouts.front.site')

@section('css')
    <link href="{{asset('public/assets/css/book.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/css/maincategory.css')}}" rel="stylesheet" />
    <style>
        ::-webkit-scrollbar-thumb {
            background: var(--bs-{{$maincategory->color}});
        }
        .top-3-books{
         height: 10px;
        }
    </style>
@endsection

@if($books->count() > 0)

@section('title',$maincategory->title)
@section('description',$maincategory->description)
@section('og:url',route($maincategory->route.'.index'))
@section('og:image',asset($maincategory->photo))
@section('og:image:url',asset($maincategory->photo))

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$maincategory->title}} <i class="m-auto fa-sharp fa-solid fa-book"></i></li>
@endsection

@section('content')


@include('front.includes.alerts.title-description-photo', ['category' => $maincategory])

@if($maincategory->booklibraries()->count() > 0)
    <div data-sos-once="true" data-sos="sos-top"  class="card border-0 text-center  m-1 m-md-4 mb-4 rounded-5 py-4 d-block shadow-sm">
        <a href="{{route('Book.index')}}" class="btn 
        @isset($searchtype)
            @if($searchtype == 'index')
                btn-dark
            @else
                btn-{{$maincategory->color}}
            @endif
        @else
            btn-{{$maincategory->color}}
        @endisset
             m-1 fw-bolder rounded-3 fs-6">احدث الكتب</a>
        <a href="{{route('book-top-likes')}}" class="btn 
        @isset($searchtype)
            @if($searchtype == 'likes')
                btn-dark
            @else
                btn-{{$maincategory->color}}
            @endif
        @else
            btn-{{$maincategory->color}}
        @endisset
             m-1 fw-bolder rounded-3 fs-6">الاعلى تقييما</a>
        <a href="{{route('book-top-downloads')}}" class="btn 
        @isset($searchtype)
            @if($searchtype == 'downloads')
                btn-dark
            @else
                btn-{{$maincategory->color}}
            @endif
        @else
            btn-{{$maincategory->color}}
        @endisset
             m-1 fw-bolder rounded-3 fs-6">الاكثر تحميلا</a>
        @foreach($maincategory->booklibraries as $booklibrary)
        <a id="{{$booklibrary->id}}" href="{{route('book-search',$booklibrary->slug)}}" class="btn 
        @isset($currentbooklibrary)
            @if($booklibrary ->id == $currentbooklibrary->id)
                btn-dark
            @else
                btn-{{$maincategory->color}}
            @endif
        @else
            btn-{{$maincategory->color}}
        @endisset 
         m-1 fw-bolder rounded-3 fs-6">{{$booklibrary->title}}</a>
        
        @endforeach
    </div>
@endif




<div class="row m-0 mx-md-4 content justify-content-center">  
    @foreach($books as $index=>$book)
        <div data-sos-once="true" data-sos="sos-zoom-in" class="col-sm-11 col-md-6 col-lg-4 p-0">
            <div class=" position-relative card d-flex  align-items-center justify-content-around   m-2 border-0 rounded-5  shadow-sm card-book overflow-hidden">
                <div class="position-absolute w-100 bg-gradient-@if( $index <= 2)danger @else{{$maincategory->color}} @endif top-0 top-3-books"></div>
                <a class="w-100  " href="{{route('Book.show',$book->slug)}}">
                    <div class="w-100 justify-content-center align-items-center d-flex px-3 pb-3  pt-5">
                        <div class="book my-3 me-n3 me-md-0">
                            <div class="book-sign">
                            </div>
                            <div class="paper front-bage">
                                <div class="spring">
                                    <div class="spring-point"></div>
                                    <div class="spring-point"></div>
                                    <div class="spring-point"></div>
                                    <div class="spring-point"></div>
                                </div>
                                <img src="{{$book->photo}}" alt="{{$book->title}}">
                            </div>
                            <div class="paper middle-bages bg-1"></div>
                            <div class="paper middle-bages bg-2"></div>
                            <div class="paper middle-bages bg-3"></div>
                            <div class="paper middle-bages bg-4"></div>
                            <div class="paper middle-bages bg-5"></div>
                            <div class="paper back-bage"></div>
                        </div>
                    </div>    
                    <div class=" p-3 mx-md-3 mx-lg-0 w-100 text-start">
                        <div class="mb-2 mt-2 mt-md-0 fs-5 text-dark fw-bolder ">{{$book->title}}</div>
                        <div class="my-3  my-md-2  ">
                            <span class="badge bg-gradient-{{$maincategory->color}}  text-light rounded-pill text-sm"># {{$index}} </span>
                            <span class="badge bg-gradient-{{$maincategory->color}}  text-light rounded-pill text-sm"><i class="fa-solid fa-tag"></i>  {{$book->booklibrary->title}}</span>
                        </div>
                        <div class="my-2 fw-bolder ">
                            @if( $index <= 2)<span class="badge text-sm"><i class="fa-solid fa-ranking-star text-warning"></i>  </span>@endif
                            <span class="badge text-secondary text-sm"><i class="fa-sharp fa-solid fa-eye text-{{$maincategory->color}}"></i>  {{$book->views}}</span>
                            <span class="badge text-secondary text-sm"><i class="fa-solid fa-heart text-{{$maincategory->color}}"></i>  {{$book->likes}}</span>
                            <span class="badge text-secondary text-sm"><i class="fa-solid fa-download text-{{$maincategory->color}}"></i>  {{$book->downloads}}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div> 
    @endforeach
    <div class=" d-flex align-items-center justify-content-center mt-3">
        {!! $books ->onEachSide(2)-> links() !!}
    </div>
</div>



@endsection

@else
    @section('content')
        <div data-sos-once="true" data-sos="sos-zoom-in" class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة كتب بعد</div>
    @endsection
@endif

@section('script')
    <script src="{{asset('public/assets/js/maincategory.js')}}"></script>  
    <script>
    create_ele_img();
    </script>
@endsection