
@extends('layouts.front.site')


@section('title',$category->title)
@section('description',$category->description)
@section('og:url',route('show-category',[$category->subcategory->slug,$category->slug]))

@section('css')
    <!-- syntax code -->
    <link href="{{asset('public/assets/prism/prism.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/css/lesson.css')}}" rel="stylesheet" />
    <style>
        ::-webkit-scrollbar-thumb {
            background: var(--bs-{{$category->subcategory->color}});
        }
        p {
            opacity: unset !important;
        }
        .paragraf-path:hover{
            margin-right:15px;
        }
        .card p{
            color: #344767;
        }
        .dark-version .card p{
            color:#bfb8b8 !important;
        }
        img{
            transition: all 0.5s !important;
        }
        .click-image{
            position: relative;
            width:150% !important;
        }
    </style>
    {!!$category->style!!}
    {!!$schemajspnscript!!}
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('show-Subcategory',$category->subcategory->slug)}}">{{$category->subcategory->title}}</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$category->title}}</li>
@endsection

@section('content')



@include('front.includes.alerts.title-page-save', 
    ['color' => $category->subcategory->color ,
    'title' => $category->title,'librarytitle' => $category->subcategory->title,
    'createdat' => $category->created_at->diffForHumans(),
    'saveroute' => route('save-category',$category->id)])

    {!!$category->content!!}
 
    @include('front.includes.alerts.likes-views', 
    ['isliked' => 'category'.$category->id.'IsLiked' ,
    'likedroute' => route('Category.AddLike',$category->id) ,
    'color' => $category->subcategory->color ,
    'name' => 'الفقرة',
    'likes' => $category->likes,'views' => $category->views])
    
@endsection


  
@section('script')
    <!-- syntax code -->
    <script src="{{asset('public/assets/prism/prism.js')}}"></script>
    <script src="{{asset('public/assets/js/lesson.js')}}"></script>
    <script src="{{asset('public/assets/js/ABCLQ.js')}}"></script>
    <script>
        //ajax_function();

        let page_color = "{{$category->subcategory->color}}";
        //style_function(page_color);
        @verify
            create_save_btn(page_color,"{{route('save-category',$category->id)}}");
        @else
            create_save_btn_not_verify(page_color,"{{route('save-category',$category->id)}}");
        @endverify
    </script>

{!!$category->script!!}

@endsection