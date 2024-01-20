@extends('layouts.front.site')


@section('title',$article->title)
@section('description',$article->description)
@section('og:url',route('Article.show',$article->slug))
@section('og:image',asset($article->photo))
@section('og:image:url',asset($article->photo))

@section('css')
    <!-- syntax code -->
    @isset($_COOKIE['DarkMode']) 
    <link id="prism_css" href="{{asset('public/assets/prism/dark-prism.css')}}" rel="stylesheet" />
    @else
    <link id="prism_css" href="{{asset('public/assets/prism/light-prism.css')}}" rel="stylesheet" />
    @endisset
    <link href="{{asset('public/assets/css/lesson.css')}}" rel="stylesheet" />
    <style>
        ::-webkit-scrollbar-thumb {
            background: var(--bs-{{$article->articlelibrary->maincategory->first()->color}});
        }
    </style>
    {!!$article->style!!}
    {!!$schemajspnscript!!}
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route($article->articlelibrary->maincategory->first()->route.'.index')}}">{{$article->articlelibrary->maincategory->first()->title}}  <i class="m-auto fa-solid fa-newspaper"></i></a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$article->title}}</li>
@endsection

@section('content')

@include('front.includes.alerts.title-page-save', 
    ['color' => $article->articlelibrary->maincategory->first()->color ,
    'title' => $article->title,'librarytitle' => $article->articlelibrary->title,
    'createdat' => $article->created_at->diffForHumans(),
    'saveroute' => route('save-article',$article->id)])

    {!!$article->content!!}

    @include('front.includes.alerts.likes-views', 
       ['isliked' => 'article'.$article->id.'IsLiked' ,
        'likedroute' => route('Article.AddLike',$article->id) ,
        'color' => $article->articlelibrary->maincategory->first()->color ,
        'name' => 'المقال',
        'likes' => $article->likes,'views' => $article->views])
          
    @if($moreArticles->count() > 0)
    <div class="my-3">
        <h2 class="header-2" id="myid">مقالات ذات صلة</h2>
        <div class="text-center">
            @foreach($moreArticles as $article)
            <a class="card py-4 col-5 col-md-3 col-lg-3 col-xl-2 d-inline-block" href="{{route('Article.show',$article->slug)}}">
                <img class="card-img-top" src="{{$article->photo}}" alt="{{$article->title}}">
                <div class="card-body">
                    <h5 class="card-title">{{$article->title}}</h5>
                </div>
                <span class="badge text-secondary text-sm"><i class="fa-sharp fa-solid fa-eye text-{{$article->articlelibrary->maincategory->first()->color}}"></i>  {{$article->views}} <span class="d-none d-md-inline-block"></span></span>
                <span class="badge text-secondary text-sm"><i class="fa-solid fa-heart text-{{$article->articlelibrary->maincategory->first()->color}}"></i>  {{$article->likes}} <span class="d-none d-md-inline-block"></span></span>
            </a>
            @endforeach
        </div>
    </div>
    @endif 

@endsection

@section('script')
    <!-- syntax code -->
    @isset($_COOKIE['DarkMode']) 
    <script id="prism_js" src="{{asset('public/assets/prism/dark-prism.js')}}"></script>
    @else
    <script id="prism_js" src="{{asset('public/assets/prism/light-prism.js')}}"></script>
    @endisset
    <script src="{{asset('public/assets/js/lesson.js')}}"></script>
    <script src="{{asset('public/assets/js/ABCLQ.js')}}"></script>
    
    <script>
        @verify
            create_save_btn(page_color,"{{route('save-article',$article->id)}}");
        @else
            create_save_btn_not_verify(page_color,"{{route('save-article',$article->id)}}");
        @endverify
        //ajax_function();
        let page_color = "{{$article->articlelibrary->maincategory->first()->color}}";
        //style_function(page_color);
    </script>

    {!!$article->script!!}

@endsection