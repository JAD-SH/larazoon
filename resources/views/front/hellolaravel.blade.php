@extends('layouts.front.site')

@section('title','أفضل موقع عربي لتعلم تطوير الويب')
@section('description','{{Site()->site_description}}')
@section('og:url','xx')
@section('og:image','{{Site()->site_photo}}')
@section('og:image:url','{{Site()->site_photo}}')

@section('css')
    <link href="{{asset('public/assets/css/home.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/css/maincategory.css')}}" rel="stylesheet" />
    <style>
        ::-webkit-scrollbar-thumb {
            background: var(--bs-{{$maincategory->color}});
        }
    </style>
    {!!$schemajspnscript!!}
@endsection

@section('content')

@include('front.includes.alerts.title-description-photo', ['category' => $maincategory])
    <div class="welcome-cat row justify-content-around  py-1 mx-3 mx-md-4">
        <div style="animation-duration: 1.1s;" data-sos-once="true" data-sos="sos-top" class="placeholder col-md-3 col-6 p-2">
            <div class=" card border-0 align-items-center rounded-5 pt-3 pb-2 shadow-sm overflow-hidden">
                <div class="placeholder glossy"></div>
                <div class=" card-header bg-transparent mx-4 text-center">
                    <div class="placeholder d-flex justify-content-center align-items-center icon icon-shape icon-lg  text-center mx-auto p-3  bg-gradient-{{$maincategory->color}}  rounded-4">
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
                    <div class="placeholder d-flex justify-content-center align-items-center icon icon-shape icon-lg  text-center mx-auto p-3  bg-gradient-{{$maincategory->color}}  rounded-4">
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
                    <div class="placeholder d-flex justify-content-center align-items-center icon icon-shape icon-lg  text-center mx-auto p-3  bg-gradient-{{$maincategory->color}}  rounded-4">
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
                    <div class="placeholder d-flex justify-content-center align-items-center icon icon-shape icon-lg  text-center mx-auto p-3  bg-gradient-{{$maincategory->color}}  rounded-4">
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
                @if($maincategory->courses->count() > 0)
                @foreach($maincategory->courses as $index=>$course)
                    <div style="animation-duration: 1.{{$index}}s;" data-sos-once="true" data-sos="sos-top" class="col-lg-4 col-md-6 col-sm-8 col-xsm-12 mb-3 mb-ms-7 p-2  d-inline-block ">
                        @if($course->lessons->count() <= 0)
                            <div class="sand-box rounded-5">
                                <div class="  w-50 bg-gradient-{{$course->color}} p-1 h-10 position-absolute text-white font-weight-bolder  near-box placeholder text-center" >قريبا</div>
                            </div>
                        @elseif( $course->lessons->last()->created_at->diffInDays() <= 30) 
                            <div class="sand-box rounded-5">
                                <div class="  w-50 bg-gradient-danger p-1 h-10 position-absolute text-white font-weight-bolder  new-box placeholder text-center" >جديد</div>
                            </div>
                        @endif
                        <div class="myhover card card-blog border-0 rounded-5 shadow-sm">
                            @if($course->lessons->count() > 0)
                            <a class="nav-link" href="{{route('show-course',$course->slug)}}">
                                <div class="card-header border-radius-xl pb-2 pt-4  mx-2 px-1 hoverimg text-center  position-relative overflow-hidden border-0">
                                    <img src="{{$course->photo}}" alt="{{$course->title}} icon" class="course-img" >
                                </div>
                            </a>
                            @else 
                                 <div class="card-header border-radius-xl pb-2 pt-4  mx-2 px-1 hoverimg text-center  position-relative overflow-hidden border-0">
                                    <img src="{{$course->photo}}" alt="{{$course->title}} icon" class="course-img" >
                                </div>
                             @endif
                            <div class="card-body p-3 pb-4">
                                @if($course->lessons->count() > 0)
                                <a class="nav-link "  href="{{route('show-course',$course->slug)}}">
                                    <div class="fw-bolder text-dark fs-3 placeholder my-2">
                                    {{$course->title}}
                                    </div>
                                    <p class="mb-4 fw-semibold placeholder">
                                        {{$course->description}}
                                    </p>
                                </a>  
                                @else  
                                    <div class="fw-bolder text-dark fs-3 placeholder my-2">
                                    {{$course->title}}
                                    </div>
                                    <p class="mb-4 fw-semibold placeholder">
                                        {{$course->description}}
                                    </p>
                                @endif
                                @if($course->lessons->count() > 0)
                                    <div class="mb-2">
                                        <span class="fw-bolder badge text-dark placeholder" data-bs-toggle="tooltip" data-bs-placement="top" title="عدد دروس الكورس"><i class="fa-solid fa-scroll text-{{$course -> color}}"></i> <span></span> {{$course -> lessons->count()}} </span>
                                        <span class="fw-bolder badge text-dark placeholder"><i class="fa-sharp fa-solid fa-eye text-{{$course -> color}}"></i> <span></span>{{$course -> lessons->sum('views')}} </span>
                                        <span class="fw-bolder badge text-dark placeholder"><i class="fa-solid fa-heart text-{{$course -> color}}"></i> <span></span> {{$course -> lessons->sum('likes')}} </span>
                                    </div>
                                    <a  data-sos-once="true" data-sos="sos-zoom-out"  href="{{route('show-course',$course->slug)}}" type="button" class="show-course-btn text-nowrap btn  rounded-3 btn-{{$course -> color}} mx-1 fw-bolder placeholder" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="الق نظرة على محتوى الكورس" title="الق نظرة على محتوى الكورس" >مشاهدة الكورس</a>
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

    <script src="{{asset('public/assets/js/maincategory.js')}}"></script>  
    <script>
        create_ele_img();
    </script>

@endsection
