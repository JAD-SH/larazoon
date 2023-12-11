@extends('layouts.front.site')

@section('title','أفضل موقع عربي لتعلم تطوير الويب')
@section('description','{{Site()->site_description}}')
@section('og:url','xx')
@section('og:image','{{Site()->site_photo}}')
@section('og:image:url','{{Site()->site_photo}}')
<!-- بعد ان تقوم بانشاء جدول خاص بمعلومات الموقع استدعي الخصائص هنا-->


@section('css')
    <style>
       
        .myhover{
            transition: all 0.5s;
            
        }
         
        .myhover:hover, .sand-box:hover + .myhover {
            margin-top:-15px;
            margin-bottom:15px;
        }
        .myhover:hover  .show-course-btn, .sand-box:hover + .myhover .show-course-btn {
            scale:1.1;
        }
        .sand-box:hover .new-box{
            top:-20% !important;
            right:-50% !important;
            transition:all 0.5s; 
        }
        .sand-box:hover .near-box{
            top:-20% !important;
            left:-50% !important;
            transition:all 0.5s; 
        }
        .sand-box:has(+ .myhover:hover) {
           top: -1rem !important;
           transition: all 0.5s !important; 
        }
        .sand-box:hover{
            top:-1rem !important;
        }
        .hoverimg{
            background-color:#ffffff00 !important;
        }
        .new-box, .near-box{
            top: 20.2% !important;
            
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.35)!important;
            z-index:2;
        }
        .new-box{
            right: -9.5% !important;
            transform: rotate(45deg);
        }
        .near-box{
            left: -9.5% !important;
            transform: rotate(-45deg);
        }
        @media screen and (min-width: 768px){
            .new-box{
                top: 16% !important;
                right: -9.5% !important;
            }
            .near-box{
                top: 16% !important;
                left: -9.5% !important;
            }
        } 
        @media screen and (min-width: 1200px){
            .new-box{
                top: 26% !important;
                right: -9% !important;
            }
            .near-box{
                top: 26% !important;
                left: -9% !important;
            }
        } 
       
        .course-img{
            max-width:100%;
            filter: drop-shadow(1px 1px 1px #d3d3d330) drop-shadow(-1px -1px 1px #d3d3d330);
        }
        
        .icon-shape:hover{
            scale:1.3;
            transform: rotate(20deg);
        }
        .sand-box {
            width:100%;
            overflow:hidden;
            height: 200px;
            position: absolute;
            left:0.0rem;
            top:0.0rem;
            transition:all .5s; 
            z-index: 2;
        }
    </style>
    {!!$schemajspnscript!!}
@endsection


@section('content')

@include('front.includes.alerts.title-description-photo', ['category' => $category])

 

 

    <div class="welcome-cat row justify-content-around  py-1 mx-3 mx-md-4">
        
        <div style="animation-duration: 1.1s;" data-sos-once="true" data-sos="sos-top" class="placeholder col-md-3 col-6 p-2">
            <div class=" card border-0 align-items-center rounded-5 pt-3 pb-2 shadow-sm overflow-hidden">
                <div class="placeholder glossy"></div>
                <div class=" card-header bg-transparent mx-4 text-center">
                    <div class="placeholder d-flex justify-content-center align-items-center icon icon-shape icon-lg  text-center mx-auto p-3  bg-gradient-primary  rounded-4">
                        <i class="fa-solid fa-graduation-cap fs-2 p-1 pb-0 text-light placeholder"></i>
                    </div>
                </div>
                <div class="card-body pt-1 pb-2 text-center">
                    <span class="fw-bolder fs-6 ">تعلم بالترتيب</span>
                
                </div>
            </div>
        </div>
        <div style="animation-duration: 1.2s;" data-sos-once="true" data-sos="sos-top" class="placeholder col-md-3 col-6 p-2">
            <div class=" card border-0 align-items-center rounded-5 pt-3 pb-2 shadow-sm overflow-hidden">
                <div class="placeholder glossy"></div>
                <div class=" card-header bg-transparent mx-4 text-center">
                    <div class="placeholder d-flex justify-content-center align-items-center icon icon-shape icon-lg  text-center mx-auto p-3  bg-gradient-primary  rounded-4">
                        <i class="fa-solid fa-award fs-2 p-1 pb-0 text-light placeholder"></i>
                    </div>
                </div>
                <div class="card-body pt-1 pb-2 text-center">
                    <span class="fw-bolder fs-6 ">اكتسب خبرات</span>
                </div>
            </div>
        </div>
        <div style="animation-duration: 1.3s;" data-sos-once="true" data-sos="sos-top" class="d-none d-md-inline-block placeholder col-md-3 col-6 p-2">
            <div class=" card border-0  align-items-center rounded-5 pt-3 pb-2 shadow-sm overflow-hidden">
                <div class="placeholder glossy"></div>
                <div class=" card-header bg-transparent mx-4 text-center">
                    <div class="placeholder d-flex justify-content-center align-items-center icon icon-shape icon-lg  text-center mx-auto p-3  bg-gradient-primary  rounded-4">
                        <i class="fa-solid fa-unlock-keyhole fs-2 p-1 pb-0 text-light placeholder"></i>
                    </div>
                </div>
                <div class=" card-body pt-1  pb-2 text-center">
                    <span class="fw-bolder fs-6 ">اكتشف الاسرار</span>
                
                </div>
            </div>
        </div>
        <div style="animation-duration: 1.4s;" data-sos-once="true" data-sos="sos-top" class="d-none d-md-inline-block placeholder col-md-3 col-6 p-2">
            <div class=" card border-0  align-items-center rounded-5 pt-3 pb-2 shadow-sm overflow-hidden">
                <div class="placeholder  glossy"></div>
                <div class=" card-header bg-transparent mx-4 text-center">
                    <div class="placeholder d-flex justify-content-center align-items-center icon icon-shape icon-lg  text-center mx-auto p-3  bg-gradient-primary  rounded-4">
                        <i class="fa-solid fa-code fs-2 p-1 pb-0 text-light placeholder"></i>
                    </div>
                </div>
                <div class=" card-body pt-1  pb-2 text-center">
                    <span class="fw-bolder fs-6 ">اطرح الاسئلة</span>
                
                </div>
            </div>
        </div>
    </div>
    <div class="card-body mx-3 mx-md-4  bg-none">
        <div class="row m-2">
            <div class="col-12 ">
                <div class="row  mt-5 justify-content-center">
                @if($category->courses->count() > 0)
                @foreach($category->courses as $index=>$course)
                    
                    <div style="animation-duration: 1.{{$index}}s;" data-sos-once="true" data-sos="sos-top" class="col-lg-4 col-md-6 col-sm-8 col-xsm-12 mb-5 mb-ms-7 p-2  d-inline-block ">
                    <div class="sand-box rounded-5">
                        @if($course->lessons->count() <= 0)
                        <div class="  w-50 bg-gradient-{{$course->color}} p-1 h-10 position-absolute text-white font-weight-bolder  near-box placeholder text-center" >قريبا</div>
                        @elseif( $course->lessons->last()->created_at->diffInDays() <= 30) 
                        <div class="  w-50 bg-gradient-danger p-1 h-10 position-absolute text-white font-weight-bolder  new-box placeholder text-center" >جديد</div>
                        @endif

                    </div>
                        <div class="myhover card card-blog border-0 rounded-5 shadow-sm">
                            <a class="nav-link" @if($course->lessons->count() > 0) href="{{route('show-course',$course->slug)}}" @endif>
                                <div class="card-header border-radius-xl pb-2 pt-4  mx-2 px-1 hoverimg text-center  position-relative overflow-hidden border-0">
                                    <img src="{{$course->photo}}" alt="img-blur-shadow" class="course-img" >
                                </div>
                            </a>
                            <div class="card-body p-3 pb-4">
                                <a class="nav-link " @if($course->lessons->count() > 0) href="{{route('show-course',$course->slug)}}" @endif>
                                    <div class="fw-bolder text-dark fs-3 placeholder my-2">
                                    {{$course->title}}
                                    </div>
                                    <p class="mb-4 fw-semibold placeholder">
                                        {{$course->description}}
                                    </p>
                                </a>    
                                
                                <div class="mb-2">
                                    <span class="fw-bolder badge text-dark placeholder" data-bs-toggle="tooltip" data-bs-placement="top" title="عدد دروس الكورس"><i class="fa-solid fa-scroll text-{{$course -> color}}"></i> <span></span> {{$course -> lessons->count()}} </span>
                                    <span class="fw-bolder badge text-dark placeholder"><i class="fa-sharp fa-solid fa-eye text-{{$course -> color}}"></i> <span></span>{{$course -> lessons->sum('views')}} </span>
                                    <span class="fw-bolder badge text-dark placeholder"><i class="fa-solid fa-heart text-{{$course -> color}}"></i> <span></span> {{$course -> lessons->sum('likes')}} </span>
                                </div>
                                @if($course->lessons->count() > 0)
                                    <div class=" ">
                                        <a  data-sos-once="true" data-sos="sos-zoom-out"  href="{{route('show-course',$course->slug)}}" type="button" class="show-course-btn text-nowrap btn  rounded-3 btn-{{$course -> color}} mx-1 fw-bolder placeholder" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="الق نظرة على محتوى الكورس">مشاهدة الكورس</a>
                                    </div>
                                @else
                                    <div data-sos-once="true" data-sos="sos-zoom-out" class="show-course-btn d-flex align-items-center justify-content-between">
                                        <span  class="text-nowrap btn  rounded-3 btn-{{$course -> color}} mx-1 fw-bolder placeholder" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="نعمل بجهد لنوفرها في اسرع وقت">سنوفرها قريبا إن شاء اللّه</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach
                @else  

                    <div data-sos-once="true" data-sos="sos-zoom-in"  class="fs-4 text-center p-5 fw-bolder placeholder">لم يتم إضافة كورسات بعد</div>

                @endif
                </div>
            </div>
        </div>
      </div>
    
  
@endsection


@section('script')

<script>
   
</script>

@endsection
