
@extends('layouts.admin.dashboard')

@section('css')

    <style>
        p {
            opacity: unset !important;
        }
       
        .cource-title:hover{
            color:#fff !important;
            background-color:#f58d;
        }
        
        .paragraf-path,.cource-title{
            transition: all 0.5s;

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

    {!!$content->style!!}

@endsection

@section('title',$content->name)

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$content->title}}</li>
@endsection

@section('content')

<div class="mx-md-4  mx-sm-2 px-1">
    {!!$content->content!!}

    <div class="my-3">
       
        <div class=" mb-3">
           
            <div class=" mx-4 p-3 text-center">
            
                <div class="btn bg-gradient-info m-0 py-2 px-4">
                    <div class="icon d-flex align-items-center justify-content-center text-white icon-lg  text-center border-radius-lg mx-auto">
                    <i class="fs-3 fas fa-shield-alt"></i>
                    </div>
                    <span class="fs-4 font-weight-bolder d-block ">{{$content->likes}}</span>
                    <span class="fs-6 font-weight-bolder d-block ">الاعجابات</span>
                </div>
                <div class="btn bg-gradient-info m-0 py-2 px-4">
                    <div class="icon d-flex align-items-center justify-content-center text-white icon-lg  text-center border-radius-lg mx-auto">
                    <i class="fs-3 fas fa-shield-alt"></i>
                    </div>
                    <span class="fs-4 font-weight-bolder d-block ">{{$content->views}}</span>
                    <span class="fs-6 font-weight-bolder d-block ">المشاهدات</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection


  
@section('script')

    <script>

        const item_color = "info";

        const lesson_title = document.querySelector(".lesson-title");
        lesson_title.classList.add('card-header','m-3','mt-0','p-3','font-weight-bolder','text-center','fs-4')

        const image = document.querySelectorAll("img.site-src");
        for (let i = 0; image[i] ; i++) {
            
            let oldSrc=$(image[i]).attr('src');
            
            $(image[i]).attr('src',`{{asset('${oldSrc}')}}`);
            
        }

        const link = document.querySelectorAll("a.site-href");
        for (let i = 0; link[i] ; i++) {

            let oldHref=$(link[i]).attr('href');

            $(link[i]).attr('href',`{{asset('${oldHref}')}}`);
        
        }

        const img_style_1 = document.querySelectorAll(".img-style-1");
        for (let i = 0; img_style_1[i] ; i++) {
            
            img_style_1[i].classList.add('img-fluid','shadow','border-radius-xl','w-lg-50','w-md-75','w-sm-100','clk-img');
            
        }

        const ul_path = document.querySelectorAll(".ul-path");
        for (let i = 0; ul_path[i] ; i++) {
            
            ul_path[i].classList.add('fs-5','navbar-nav','px-2','list-path');
            
        }

        const ul_path_li = document.querySelectorAll(".ul-path li");
        for (let i = 0; ul_path_li[i] ; i++) {
            
            ul_path_li[i].classList.add('py-1','paragraf-path');
            
        }

        const ul_path_li_a = document.querySelectorAll(".ul-path li a");
        for (let i = 0; ul_path_li_a[i] ; i++) {
            
            ul_path_li_a[i].classList.add('px-2','border-2',`border-${item_color}`,'border-end');
            
        }

        const paragraf_title = document.querySelectorAll(".paragraf-title");
        for (let i = 0; paragraf_title[i] ; i++) {
            
            paragraf_title[i].classList.add('m-4','border-bottom','border-2');
            
        }

        const code = document.querySelectorAll("code");
        for (let i = 0; code[i] ; i++) {
            
            code[i].classList.add('px-2',`text-${item_color}`,'border-bottom',`border-${item_color}`,'font-weight-bolder','border-2');
            
        }

        const btn_try_code = document.querySelectorAll(".btn-try-code");
        for (let i = 0; btn_try_code[i] ; i++) {
            
            btn_try_code[i].classList.add('btn',`bg-gradient-${item_color}`,'m-2','py-2','px-3');
            
        }
            
    </script> 

    {!!$content->script!!}

@endsection