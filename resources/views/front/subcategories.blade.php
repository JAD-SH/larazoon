
@extends('layouts.front.site')


@section('title','الأقسام الفراعية')
@section('og:url',route('show-Subcategories'))

@section('css')

    <style>
        
        @media screen and (min-width: 992px){
            .content .content-category .card{
                border-radius: .25rem 1rem 1rem .25rem !important;
            }
        } 

    </style>


@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">الأقسام الفرعية</li>
@endsection

@section('content')

 
<div class="row m-0 content  p-0">
    
    <div class="col-lg-8 pe-lg-0 content-category">
        
        
        @if($subcategories->count() !== 0)
            @foreach($subcategories as $subcategory)

                <div data-sos-once="true" data-sos="sos-right" class=" position-relative  m-1 m-md-4 card d-flex flex-md-row align-items-center  p-2 p-md-3 py-0  border-0 rounded-5  shadow-sm mb-3 ">
                        @if($subcategory->categories->count() <= 0)
                            <div class="position-absolute overflow-hidden continer-new-box">
                                <div class="  w-100 bg-gradient-danger  position-absolute text-white font-weight-bolder text-center text-sm new-box" >قريبا</div>
                            </div>
                        @elseif($subcategory->created_at->diffInDays() <= 20)
                            <div class="position-absolute overflow-hidden continer-new-box">
                                <div class="  w-100 bg-gradient-danger  position-absolute text-white font-weight-bolder text-center text-sm new-box" >جديد</div>
                            </div>
                        @endif
                        <a class="nav-link text-md-start position-relative  m-1   mx-3 mx-md-0 link-block-idea-side-content" href="{{route('show-Subcategory',$subcategory->slug)}}">
                            <div class="block-idea-side-content py-2  me-md-3">
                                <i class="{{$subcategory->icon}}  "></i> 
                                <div class="block-idea-side {{$subcategory->color}}-block-idea-side"></div>
                                <div class="block-idea-side {{$subcategory->color}}-block-idea-side"></div>
                                <div class="block-idea-side {{$subcategory->color}}-block-idea-side"></div>
                                <div class="block-idea-side {{$subcategory->color}}-block-idea-side"></div>
                                <div class="block-idea-side {{$subcategory->color}}-block-idea-side"></div>
                            </div>
                        </a>
                        <div class="py-2 py-md-0 question-all-content">
                            <a class="nav-link text-md-start  mx-3 mx-md-0 link-block-idea-side-content" href="{{route('show-Subcategory',$subcategory->slug)}}">
                                <div class="text-dark fw-bolder fs-5 ">
                                    {{$subcategory->title}}
                                </div>
                                <div class="m-2 fw-bolder">
                                    <span class="badge text-sm text-secondary"><i class="fa-sharp fa-solid fa-eye text-{{$subcategory->color}} "></i>  {{$subcategory-> categories()->sum('views')}} المشاهدات</span>
                                    <span class="badge text-sm text-secondary"><i class="fa-solid fa-heart text-{{$subcategory->color}} "></i>  {{$subcategory-> categories()->sum('likes')}} الاعجابات</span>
                                    <span class="badge text-sm text-secondary"> <i class="fa-solid fa-calendar-days text-{{$subcategory->color}} px-1"></i>{{$subcategory->created_at->diffForHumans()}}</span>
                                </div>
                            </a> 
                        </div>
                </div>  
            @endforeach
        @else
            <div data-sos="sos-blur" class="fs-4 text-center p-5 fw-bolder pt-1">لم يتم إضافة اقسام فرعية بعد </div>
        @endif
    </div>
    <div  class="col-lg-4  bg-info ps-0 addvertismrnt" style="height:100%;">
        <div class="card border-0  rounded-5 shadow-sm py-4  p-3 me-4  my-4 text-dark" style="height:500px;">هنا الاعلان</div>
        <div class="card border-0  rounded-5 shadow-sm py-4  p-3 me-4  my-4 text-dark">هنا الاعلان</div>
    </div>
     
 
</div>
@endsection
 