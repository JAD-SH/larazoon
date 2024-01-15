@extends('layouts.front.site')

@section('css')
    <link href="{{asset('public/assets/css/maincategory.css')}}" rel="stylesheet" />
    <style>
        ::-webkit-scrollbar-thumb {
            background: var(--bs-{{$maincategory->color}});
        }
        @media screen and (min-width: 767px){
            .article-image img{
                border-radius: .25rem 1rem 1rem .25rem;
                height:124px !important; 
                width: 250px !important;
            }
        }
        @media screen and (max-width: 767px){
            .article-image{
                padding-top: 1rem!important;
            }
            .article-image img{
                border-radius:  1rem  1rem .25rem .25rem;
                height:140px !important; 
            }
            .new-box {
                top: 8% !important;
                left: -35% !important;
            }
        }
        .addvertismrnt .card{
            border-radius:  1rem  .25rem .25rem 1rem  !important;
        }
        @media screen and (min-width: 1140px){
            .content .card{
                border-radius: .25rem 1rem 1rem .25rem !important;
            }
        }   
        @media screen and (max-width: 1140px){
            .addvertismrnt .card{
                border-radius: 1rem !important;
            }
        } 
    </style>
@endsection

@if($articles -> count() > 0)

    @section('title',$maincategory->title)
    @section('description',$maincategory->description)
    @section('og:url',route($maincategory->route.'.index'))
    @section('og:image',asset($maincategory->photo))
    @section('og:image:url',asset($maincategory->photo))

    @section('path')
        <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$maincategory->title}} <i class="m-auto fa-solid fa-newspaper"></i></li>
    @endsection

    @section('content')

    @include('front.includes.alerts.title-description-photo', ['category' => $maincategory])

        @if($maincategory->articlelibraries()->count() > 0)
            <div data-sos-once="true" data-sos="sos-top" class="card border-0 text-center mx-1 mx-md-4 bg-none  rounded-5 py-4 d-block shadow-sm">
                <a href="{{route('Article.index')}}" class="btn 
                @isset($searchtype)
                    @if($searchtype == 'index')
                        btn-dark
                    @else
                        btn-{{$maincategory->color}}
                    @endif
                @else
                    btn-{{$maincategory->color}}
                @endisset
                m-1 fw-bolder rounded-3 fs-6">احدث المقالات</a>
                <a href="{{route('article-top-likes')}}" class="btn 
                @isset($searchtype)
                    @if($searchtype == 'likes')
                        btn-dark
                    @else
                        btn-{{$maincategory->color}}
                    @endif
                @else
                    btn-{{$maincategory->color}}
                @endisset
                m-1 fw-bolder rounded-3 fs-6">الاعلى اعجابا</a>
                <a href="{{route('article-top-views')}}" class="btn 
                @isset($searchtype)
                    @if($searchtype == 'views')
                        btn-dark
                    @else
                        btn-{{$maincategory->color}}
                    @endif
                @else
                    btn-{{$maincategory->color}}
                @endisset
                m-1 fw-bolder rounded-3 fs-6">الاكثر مشاهدة</a>
                @foreach($maincategory->articlelibraries as $articlelibrary)
                <a id="{{$articlelibrary->id}}" href="{{route('article-search',$articlelibrary->slug)}}" class="btn  
                @isset($currentarticlelibrary)
                    @if($articlelibrary ->id == $currentarticlelibrary->id)
                        btn-dark
                    @else
                        btn-{{$maincategory->color}}
                    @endif
                @else
                    btn-{{$maincategory->color}}
                @endisset
                m-1 fw-bolder rounded-3 fs-6 ">{{$articlelibrary->title}}</a>
                @endforeach
            </div>
        @endif
    <div class="row m-0 p-0">
        @isset($articles)
        <div class="col-xl-9 p-0 content ">
            @foreach($articles as $index=>$article)
            <div  data-sos-once="true" data-sos="sos-left" class="position-relative card px-3 mx-1 mx-md-4 my-3 shadow-sm border-0 rounded-5  ">
                @if($article->created_at->diffInDays() <= 20)
                    <div class="position-absolute overflow-hidden continer-new-box">
                        <div class="  w-100 bg-gradient-danger  position-absolute text-white font-weight-bolder text-center text-sm new-box" >جديد</div>
                    </div>
                @endif
                <a class=" d-md-flex flex-md-row align-items-center " href="{{route('Article.show',$article->slug)}}">
                <div class="article-image  text-center overflow-hidden" >
                    <img class="w-100" src="{{asset($article->photo)}}" alt="{{$article->title}}">
                </div>
                <div class=" py-3 py-md-0 ps-md-3">
                    <div class="mb-2 fs-5 text-dark fw-bolder ">{{$article->title}}</div>
                    <span class="mb-2  fw-bolder">{{$article->description}}</span>
                    <div class="my-3  m-md-2">
                        <span class="badge bg-gradient-{{$article->articlelibrary->maincategory->first()->color}}  text-light rounded-pill text-sm"># {{$index+1}} </span>
                        <span class="badge bg-gradient-{{$article->articlelibrary->maincategory->first()->color}}  text-light rounded-pill text-sm"> <i class="fa-solid fa-tag"></i>  {{$article->articlelibrary->title}}</span>
                    </div>
                    <div class="m-md-2 fw-bolder  ">
                    @if( $index <= 2)<span class="badge text-sm"><i class="fa-solid fa-ranking-star text-warning"></i>  </span>@endif
                        <span class="badge text-secondary text-sm"><i class="fa-sharp fa-solid fa-eye text-{{$article->articlelibrary->maincategory->first()->color}}"></i>  {{$article->views}} <span class="d-none d-md-inline-block">المشاهدات</span></span>
                        <span class="badge text-secondary text-sm"><i class="fa-solid fa-heart text-{{$article->articlelibrary->maincategory->first()->color}}"></i>  {{$article->likes}} <span class="d-none d-md-inline-block">الاعجابات</span></span>
                        <span class="badge text-secondary text-sm"><i class="fa-solid fa-calendar-days text-{{$article->articlelibrary->maincategory->first()->color}}"></i>{{$article->created_at->diffForHumans()}} </span>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
            <div class=" d-flex align-items-center justify-content-center mt-3">
                {!! $articles ->onEachSide(2)-> links() !!}
            </div>
        </div>
        <div  class="col-xl-3  bg-info p-0 addvertismrnt" style="height:100%;">
            <div class="card border-0  rounded-5 shadow-sm py-4  p-3 me-xl-4 my-xl-3 text-dark" style="height:500px;">هنا الاعلان</div>
            <div class="card border-0  rounded-5 shadow-sm py-4  p-3 me-xl-4  my-xl-3 text-dark">هنا الاعلان</div>
        </div>
        @endisset 
    </div>
    @endsection
@else
    @section('content')
        <div data-sos-once="true" data-sos="sos-zoom-in" class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة مقالات بعد</div>
    @endsection
@endif

@section('script')
    <script src="{{asset('public/assets/js/maincategory.js')}}"></script>      
    <script>
        create_ele_img();
    </script>
@endsection
