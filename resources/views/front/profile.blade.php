@extends('layouts.front.site')

@section('title','الملف الشخصي ')

@section('meta_tags')
  <meta name="robots" content="noindex">
@endsection

@section('css')
  <link href="{{asset('public/assets/css/profile.css')}}" rel="stylesheet" />
@endsection

@section('path')
  <li class="breadcrumb-item fw-bolder active " aria-current="page"> <i class="fa-solid fa-address-card "></i> {{Auth::user()->name}} </li>
@endsection

@section('content')

<div class=" m-0 ">
  <div class=" ">
      <div data-sos-once="true" data-sos="sos-blur" class="page-header rounded-5 py-3" style="background-image: url({{Site()->user_profile_background}}); height:200px;">
        <span class="mask  bg-gradient-primary"></span>
      </div>
      <div class="card m-1 m-md-4 p-2 p-md-4 pt-0  border-0 rounded-5  shadow-sm mb-5 mt-n6  ">
        <div class="row m-2">
            <div class="col-auto px-0">
              <a href="{{ asset('public/assets/'.Auth::user()->photo) }}" class="avatar avatar-xl position-relative py-1 nav-link pe-1">
                <img src="{{ asset('public/assets/'.Auth::user()->photo) }}" alt="{{ Auth::user()->name }}" class="w-100 h-100 rounded-4">
              </a>          
            </div>
            <div class="col-auto my-auto">
              <div class="">
                <div class="mb-1 fs-5 text-dark fw-bolder">
                {{ Auth::user()->name }}
                </div>
                <p class="mb-0 fw-bolder text-sm text-info" style="font-size: 12px;">
                {{ Auth::user()->interest }} Developer 
                </p>
              </div>
              <div class="text-end">
                <div class="text-start">
                  <!-- Button trigger modal -->
                  <a class="d-inline-block nav-link pe-1" data-bs-toggle="modal" data-bs-target="#EditProfileModal">
                    <i class="fas fa-user-edit text-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="تعديل الملف الشخصي"></i>
                  </a>
                  @include('front.includes.alerts.edit-profile-modal')
                  <a class="d-inline-block nav-link pe-1 " href="{{route('show-my-profile')}}" >
                    <i class="fas fa-user-edit text-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="عرض الملف كما يظهر لجميع المستخدمين الاخرين"></i>
                  </a>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            
          <div data-sos-once="true" data-sos="sos-top" class="col-12 col-xl-3 col-md-6">
              <div class="">
                  <div class=" pb-0 p-3">
                      <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                          <h6 class="mb-0 text-dark fw-bolder"><ins class="text-dark">-معلومات الدراسة</ins></h6>
                        </div>
                      
                      </div>
                  </div>
                  <div class=" p-3">
                    <ul class=" p-0 fw-bolder">
                      <li class="py-2 text-dark">تتابع خطة التعلم : <span class=" text-uppercase">&nbsp; @if(Auth::user()->plan !== null) _{{ Auth::user()->plan->title }}_ @else لم تتابع خطة تعلم @endif</span> </li>
                      <li class="py-2 text-dark">الاهتمام : <span>&nbsp; _{{ Auth::user()->interest }}_</span> </li>
                      <li class="py-2 text-dark">المستوى : <span>&nbsp;{{Auth::user()->courses()->where('isexamine',1)->count()}}</span></li>
                      <li class="py-2 text-dark">محترف بنسبة : <span>&nbsp;@if(Auth::user()->lessons->count() > 0){{ (int)((Auth::user()->lessons->sum('result'))/(Auth::user()->lessons->count())) }} @else 0 @endif%   </span> 
                        <div class="d-inline-block p-1 px-2 rounded-5  m-0" style="border-radius:100% !important;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="يتم حساب هذه القيمة من خلال درجة كل امتحان تخوضه">
                            <i class="fa fa-bell"></i>
                        </div></li>
                      <li class="py-2 text-dark">اجمالي التبرع للموقع : <span>&nbsp;{{ Auth::user()->total_donations }}$</span> </li>
                      <li class="py-2 text-dark">حالة الحساب : <span id="getUserActive">&nbsp; {{ Auth::user()->getUserActive() }}</span></li>
                      <li class="py-2 text-dark">المقالات التي قمت بنشرها : <span>&nbsp; غير متاح</span></li>
                      <li class="py-2 text-dark">الاسئلة التي قمت بطرحها : <span>&nbsp; {{ Auth::user()->questions()->count() }}</span></li>
                      <li class="py-2 text-dark">الأجوبة التي قمت بأقتراحها : <span>&nbsp;  {{ Auth::user()->comments()->count() }}</span></li>
                      <li class="py-2 text-dark">الدروس التي قمت بتقييمها : <span>&nbsp; {{ Auth::user()->lesson_assessment }}</span></li>
                      <li class="py-2 text-dark">عدد اعجابات ملفك الشخصي : <span>&nbsp; {{ Auth::user()->likes }}</span></li>
                      <li class="py-2 text-dark">مشاهدات ملفك الشخصي : <span>&nbsp; {{ Auth::user()->views }}</span></li>
                      <li class="py-2 text-dark">المقالات التي قمت بقرائتها : <span>&nbsp; {{ Auth::user()->read_article }}</span></li>
                      <li class="py-2 text-dark">تاريخ الإنضمام : <span>&nbsp; {{ Auth::user()->created_at->diffForHumans() }}</span></li>   
                    </ul>
                  </div>
              </div>
          </div>
          <div data-sos-once="true" data-sos="sos-top" class="col-12 col-xl-3 col-md-6">
            <div class="">
                <div class=" pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="mb-0 text-dark fw-bolder"><ins class="text-dark">-وصف حولك</ins></div>
                    </div>
                  
                    <p class="my-3 mx-2 fw-bolder">
                    {{ Auth::user()->description }}
                    </p>
                  </div>
                </div>
                <div class=" p-3">
                  <ul class=" p-0 fw-bolder">
                    <li class="py-2 text-dark">الأسم الكامل :<span> &nbsp; {{ Auth::user()->name }}</span></li>
                    <li class="py-2 text-dark">اسم المستخدم :<span> &nbsp; {{ Auth::user()->username }}</span></li>
                    <li class="py-2 text-dark">العمر : <span>&nbsp; {{ Auth::user()->getAge() }}</span></li>
                    <li class="py-2 text-dark ">الجنس : <span>&nbsp;  {{ Auth::user()->getGender() }}</span></li>
                    <li class="py-2 text-dark">البريد الالكتروني :<span> &nbsp; {{ Auth::user()->email }}</span></li>
                    <li class="py-2 text-dark"> مواقع التواصل : 
                      @if(Auth::user()->facebook !== null)
                      <a class="m-2" target="_blank" href="{{Auth::user()->facebook}}">
                        <i class="fab fa-facebook fa-lg text-info fs-5"></i>
                      </a>
                      @endif 
                      @if(Auth::user()->twitter !== null)
                      <a class="m-2" target="_blank" href="{{Auth::user()->twitter}}">
                        <i class="fab fa-twitter fa-lg text-info fs-5"></i>
                      </a>
                      @endif 
                      @if(Auth::user()->instagram !== null)
                      <a class="m-2" target="_blank" href="{{Auth::user()->instagram}}">
                        <i class="fab fa-instagram fa-lg text-warning fs-5"></i>
                      </a>
                      @endif 
                      @if(Auth::user()->github !== null)
                      <a class="m-2" target="_blank" href="{{Auth::user()->github}}">
                        <i class="fab fa-github fa-lg text-dark fs-5"></i>
                      </a>
                      @endif 
                      
                    </li> 
                    
                  </ul>
                </div>
            </div>
          </div>
    
          <div data-sos-once="true" data-sos="sos-top" class="col-12 col-md-6 col-xl-3">
              <div class="">
                  <div class="p-1  p-md-3 px-0">
                      <h6 class="mb-0 text-dark fw-bolder"><ins class="text-dark">-الإعدادات</ins></h6>
                  </div>
                  <div class="p-2">
                      
                    <h6 class="text-uppercase  text-dark  fw-bolder">الحساب </h6>
                    <ul class="list-group">
                
                      <li class="list-group-item border-0 px-0">



                        <form action="{{route('User.visible')}}" method="POST" class="d-inline user_appear">
                          @csrf                            
                          <input type="radio" value="0" class="btn-check" name="user_appear" id="hidden">
                          <label class="btn btn-outline-secondary text-sm py-1 my-1 border px-2 rounded-3 po0" for="hidden" onclick="clc_vivible('po0')">مخفي عن الجميع</label>
                          
                          <input type="radio" value="1" class="btn-check" name="user_appear" id="visible">
                          <label class="btn btn-outline-secondary text-sm py-1 my-1 border px-2 rounded-3 po1" for="visible" onclick="clc_vivible('po1')">ظاهر للجميع</label>
                              
                          <input type="radio" value="2" class="btn-check" name="user_appear" id="partly_visible">
                          <label class="btn btn-outline-secondary text-sm py-1 my-1 border px-2 rounded-3 po2" for="partly_visible" onclick="clc_vivible('po2')" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="اخفاء (الصورة , البريد الالكتروني , العمر , الجنس , مواقع التواصل الاجتماعي)">أخفي المعلومات الشخصية فقط</label>
                        </form>
                      </li>
                        
                    </ul>
                    <h6 class="text-uppercase  text-dark fw-bolder mt-4">اشعارات الموقع</h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">

                          <form class="d-inline user_appear" action="{{route('User.site-notification')}}" method="POST">
                            @csrf    
                            <button class="btn fw-bolder py-1 px-2 ajax-submit  text-sm rounded-3 
                            @if(Auth::user() -> site_notification == 0)
                            btn-outline-info text-info border-1
                            @else
                            btn-info text-white
                            @endif "
                            data-bs-toggle="tooltip" data-bs-title="ينصح باستقبال الاشعارات">                       
                            @if(Auth::user() -> site_notification == 0)
                            حظر الاشعارات
                            @else
                            استقبال الاشعارات
                            @endif
                            </button>
                          </form>
                        </div>
                      </li>
                    </ul>
                  </div>
              </div>
          </div>
          <div data-sos-once="true" data-sos="sos-top" class="col-12 col-md-6 col-xl-3">
              <div class="">
                  <div class="p-1  p-md-3 px-0">
                      <h6 class="mb-0 text-dark fw-bolder decoration-underline"><ins class="text-dark">-محفوظات التواصل مع الادمن</ins></h6>
                  </div>
                  <div class="p-2 d-inline-block d-xl-block">
                    <h6 class="text-uppercase  text-dark fw-bolder">الابلاغات التي قمت بتقديمها</h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 ps-0 pt-0 fw-bolder">
                        <a class=" btn rounded-3 bg-gradient-primary mx-1 fs-6 my-2" href="{{route('User.site-inform-page')}}">عرض الابلاغات</a>
                      </li>
                    </ul>
                  </div>
                  <div class="p-2 d-inline-block d-xl-block">
                    <h6 class="text-uppercase  text-dark fw-bolder mt-xl-4">الرسائل والاسئلة</h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 ps-0 pt-0 fw-bolder">
                        <a class=" btn rounded-3 bg-gradient-primary mx-1 fs-6 my-2" href="{{route('User.site-media-page')}}">عرض الرسائل والاسئلة</a>
                      </li>
                    </ul>
                  </div>
              </div>
          </div>
          <div data-sos-once="true" data-sos="sos-top" class="col-12">
              <div class="">
                  <div class="p-1  p-md-3 px-0">
                      <h6 class="mb-0 text-dark fw-bolder decoration-underline"><ins class="text-dark">-العناصر المحفوظة</ins></h6>
                  </div>
                  <div class="p-2">
                      
                      <a class=" btn rounded-3 bg-gradient-primary mx-1 my-2" href="{{route('User.archive-lessons')}}">الدروس</a>
                    
                      <a class=" btn rounded-3 bg-gradient-primary mx-1 my-2" href="{{route('User.archive-articles')}}">المقالات</a>

                      <a class=" btn rounded-3 bg-gradient-primary mx-1 my-2" href="{{route('User.archive-books')}}">الكتب</a>
                    
                      <a class=" btn rounded-3 bg-gradient-primary mx-1 my-2" href="{{route('User.archive-questions')}}">الاسئلة</a>
                    
                      <a class=" btn rounded-3 bg-gradient-primary mx-1 my-2" href="{{route('User.archive-categories')}}">الفقرات</a>
                      
                  </div>
                  
              </div>
          </div>
          <div data-sos-once="true" data-sos="sos-top" class="col-12">
            <div class="">
              <div class="p-1  p-md-3 px-0">
                  <h6 class="mb-0 text-dark fw-bolder decoration-underline"><ins class="text-dark">-سجل الدعم</ins></h6>
              </div>
              <div class="p-2">
                  
                @if(Auth::user()->supports()->count() > 0)
                  <a class="btn rounded-4 bg-gradient-success my-0 py-2 px-4 fs-6 border-2 font-weight-bolder mx-1" href="{{route('User.supporter-archive',Auth::user()->username)}}">سجل الدعم</a>
                @else 
                  <button class="btn rounded-4 bg-gradient-danger my-0 py-2 px-4 fs-6 border-2 font-weight-bolder mx-1">لم يدعمنا بعد</button>
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

@if(Auth::user()->plan !== null)

@if ($planProgres = PlanProgres()) @endif
  <div class=" my-3 ">
    <div class="row m-0">
      <div class="col-lg-8 col-md-12 mb-2 mb-lg-0 p-0">
        <div class="card m-1 m-md-4 p-2 p-md-4 pt-0  border-0 rounded-5  shadow-sm  overflow-hidden">
          <div class=" py-2">
            <div class="row m-0  px-3">
              <div class=" my-2 ">
                <div class="fw-bold text-nowrap d-inline p-2">
                  <span class="fs-6">خطة التعلم</span>
                  <span class=" text-info ms-1 text-uppercase">_{{ Auth::user()->plan->title }}_</span> 
                </div>
                <div class="fw-bold text-nowrap d-inline p-2">
                  <span class="fs-6">عدد الكورسات </span>
                  <span class="text-info ms-1 text-uppercase">_{{Auth::user()->plan->first()->courses()->count()}}_</span> 
                </div>
                <div class="fw-bold text-nowrap d-inline p-2">
                  <span class="fs-6">عدد الدروس </span>
                  <span class="text-info ms-1 text-uppercase">_{{Auth::user()->plan->first()->courses()->with('lessons')->get()->pluck('lessons')->flatten()->count()}}_</span> 
                </div>
              </div>
              <hr class="horizontal  my-2 dark">
            </div>
          </div>
          <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-15 justify-content-center align-items-center" style=" top: 0; right: 0;    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 fa-sharp fa-solid fa-eye text-white"></i>
          </div>
          <div class="table-responsive px-3">
            <table class="table align-items-center mb-0">
              <thead>
                <tr class="">
                  <th class="text-uppercase text-nowrap fw-bolder py-3">الترتيب</th>
                  <th class="text-uppercase text-nowrap text-center fw-bolder py-3">عنوان الكورس</th>
                  <th class="text-uppercase text-nowrap fw-bolder py-3">الدروس</th>
                  <th class="text-uppercase text-nowrap fw-bolder py-3">الجذء المدروس</th>
                  <th class="text-uppercase text-nowrap fw-bolder py-3">النتيجة</th>
                  <th class="text-uppercase text-nowrap text-center fw-bolder py-3">إختبار الأتمام</th>
                </tr>
              </thead>
              <tbody>
                @foreach(Auth::user()->plan->courses as $index=>$course)
                  <tr id="item-{{$course->id}}" class="text-nowrap">
                    <td class="align-middle px-3 text-center text-sm" style="width:25px;">
                      <span class="text-sm fw-bold">{{$index+1}}#</span>
                    </td>
                    <td class="align-middle px-3 ">
                      <a class="d-flex py-1 nav-link " href="{{route('show-course',$course->slug)}}">
                        <div class="">
                          <img src="{{$course->photo}}" class="avatar avatar-sm mx-1" alt="{{$course->title}}">
                        </div>
                        <div class="d-flex flex-column justify-content-center p-0">
                          <span class="mb-0 text-uppercase  fw-bolder text-dark"> {{$course->title}}</span>
                        </div>
                      </a>
                    </td>
                    <td class="align-middle px-3 text-center text-sm">
                      <span class="text-sm fw-bold">{{$course->lessons->count()}}</span>
                    </td>
                    @if($course->lessons()->whereHas('exams')->count() > 0)
                    
                    @if ($courseProgres = CourseProgres($course)) @endif
                    
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-sm fw-bold">{{$courseProgres}} %</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar 
                            @if($courseProgres == 100)  bg-gradient-success
                            @elseif($courseProgres < 50) bg-gradient-warning 
                            @else bg-gradient-info @endif  
                            @if($courseProgres <= 10 || $courseProgres % 5 == 0) w-{{$courseProgres}} 
                            @else w-{{substr_replace($courseProgres, '', -1).'5'}} @endif"
                            role="progressbar" aria-valuenow="{{$courseProgres}}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-sm fw-bold">@if(Auth::user()->lessons->where('course_id',$course->id)->count() > 0) {{(int)((Auth::user()->lessons->where('course_id',$course->id)->sum('result'))/(Auth::user()->lessons->where('course_id',$course->id)->count()))}} @else 0 @endif %</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        
                      @if($course->user_course()->where('user_id',Auth::user()->id)->where('course_id',$course->id)->first()->isexamine == 1)
                        <button class="btn  rounded-3 bg-gradient-light fs-6 py-1 px-3 mb-0">
                          تم الأختبار <i class="fa-solid fa-file-pen"></i>
                        </button>

                      @else
                        @if($courseProgres >= 50)
                          <button id="{{$course->id}}" data_href="{{route('course.exams',$course->slug)}}" type="button" class="btn  rounded-3 bg-gradient-{{$course->color}} fs-6 py-1 px-3 mb-0 exam "
                            data-bs-toggle="modal" data-bs-target="#ExamModal"
                            course-title="{{ Auth::user()->courses->where('id',$course->id)->first()->title }}"
                            lesson-count="{{ Auth::user()->courses->where('id',$course->id)->first()->lessons->count() }}"
                            questions-count="{{ Auth::user()->courses->where('id',$course->id)->first()->exams->count() }}">
                            الأختبار  <i class="fa-solid fa-file-pen"></i>
                          </button>
                        @else
                          <button id="{{$course->id}}"  class="btn  rounded-3 bg-gradient-{{$course->color}} fs-6 py-1 px-3 mb-0 exam "
                            data-bs-toggle="tooltip" data-bs-placement="top" title="يجب اتمام 50% من الكورس قبل التقديم على اختبار اتمام الكورس">
                            الأختبار <i class="fa-solid fa-file-pen"></i>
                          </button>
                        @endif
                      @endif
                      </td>
                    @else
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-sm fw-bold">0 %</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar  "
                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-sm fw-bold">0  %</span>
                      </td>
                      
                      <td class="align-middle text-center text-sm">                
                        <button id="{{$course->id}}"  class="btn  rounded-3 bg-gradient-{{$course->color}} fs-6 py-1 px-3 mb-0 exam "
                          data-bs-toggle="tooltip" data-bs-placement="top" title="هذا الكورس غير مكتمل بعد سنوفره قريبا">
                          قريبا <i class="fa-solid fa-file-pen"></i>
                        </button>
                      </td>
                     
                    @endif

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="text-center">
            <button  data-sos-once="true" data-sos="sos-left"  type="button" class="btn rounded-3 bg-gradient-danger m-3 w-85  fs-6" data-bs-toggle="modal" data-bs-target="#UnfollowPlanModal">
                الغاء متابعة الخطة <i class="fa-solid fa-trash-can text-gradient"></i>
            </button>
            @include('front.includes.alerts.unfollow-plan-modal')
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-9  p-0">
        <div class="card  m-1 m-md-4 p-2 p-md-4 pt-0  border-0 rounded-5  shadow-sm ">
          <div class=" py-2">
            <div class="row m-0 px-3">
              <div class="d-flex   my-2  justify-content-around">
                <div class="fw-bold    d-inline">
                  <span class="fs-6 ">مسيرتك البرمجية في هذه الخطة</span>
                  <span class=" text-info ms-1 text-uppercase"><i class=" fa-solid 
                  @if($planProgres >= 1 && $planProgres < 20) fa-child text-success
                  @elseif($planProgres >= 20 && $planProgres < 40) fa-dumbbell text-danger
                  @elseif($planProgres >= 40 && $planProgres < 60) fa-hat-wizard text-info
                  @elseif($planProgres >= 60 && $planProgres < 80) fa-chess-king text-warning
                  @else fa-dragon text-primary
                  @endif
                  "></i>
                    <span class="fw-bold">{{$planProgres}} %</span></span> 
                </div>
              </div>
              <hr class="horizontal  my-2 dark">
            </div>
          </div>
          <div class="card-body px-3 d-flex align-items-center">
            <div class="timeline timeline-one-side">
              <div class="timeline-block mb-3 @if($planProgres < 1 && $planProgres !== 1) opacity-50 @endif">
                <span class="timeline-step bg-transparent">
                  <i class="fs-5 fa-solid fa-child @if($planProgres >= 1) text-success @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content @if(!$planProgres >= 1) opacity-50 @endif">
                  <span class="text-dark fw-bold mb-0">مبتدأ</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">0-19% (غير مستعد للعمل بالبرمجة)</p>
                </div>
              </div>
              <div class="timeline-block mb-3 @if($planProgres < 20 && $planProgres !== 20) opacity-50 @endif">
                <span class="timeline-step  bg-transparent">
                  <i class="fs-4 fa-solid fa-dumbbell @if($planProgres >= 20) text-danger @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content">
                  <span class="text-dark fw-bold mb-0">متوسط</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">20-39% (قادر على فهم الاكواد البرمجة وتقليد الاكواد)</p>
                </div>
              </div>
              <div class="timeline-block mb-3 @if($planProgres < 40 && $planProgres !== 40) opacity-50 @endif">
                <span class="timeline-step  bg-transparent">
                  <i class="fs-3 fa-solid fa-hat-wizard @if($planProgres >= 40) text-info @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content">
                  <span class="text-dark fw-bold mb-0">محترف</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">40-59% (قادر على كتابة الاكواد وانشاءبعض المواقع وبيعها)</p>
                </div>
              </div>
              <div class="timeline-block mb-3 @if($planProgres < 60 && $planProgres !== 60) opacity-50 @endif">
                <span class="timeline-step  bg-transparent">
                  <i class="fs-2 fa-solid fa-chess-king @if($planProgres >= 60) text-warning @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content">
                  <span class="text-dark fw-bold mb-0">متقدم جدا</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">60-79% (قادر على انشاء اي موقع الكتروني على الانترنت)</p>
                </div>
              </div>
              <div class="timeline-block mb-3 @if($planProgres < 80 && $planProgres !== 80) opacity-50 @endif">
                <span class="timeline-step  bg-transparent">
                  <i class="fs-1 fa-solid fa-dragon @if($planProgres >= 80) text-primary @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content">
                  <span class="text-dark fw-bold mb-0">خبير</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">80-100% (مطلوب جدا في سوق العمل وقادر على الاشراف على مطورين الويب )</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@else
  <div data-sos-once="true" data-sos="sos-bottom" class=" mb-md-3 mb-5 text-center">
      <button type="button" class="btn rounded-3 bg-gradient-primary  py-3 fs-6 fw-bold mb-1 text-light m-1 m-md-4 p-2 p-md-4 pt-0  " 
      data-bs-toggle="modal" data-bs-target="#FollowPlanNotification">
      اضغط لمتابعة احدى خطط التعلم . لتتعلم بشكل سليم ومنظم ولتحصل على مميزات التعلم المنظم <i class="fa-solid fa-feather-pointed"></i>
    </button>
  </div>
@endif

    <div class=" mb-md-3 mb-5">
      <div class="card m-1 m-md-4 p-2 p-md-4 pt-0  border-0 rounded-5  shadow-sm overflow-hidden">
        <div  data-sos-once="true" data-sos="sos-top"  class=" py-2">
          <div class="row m-0  px-3">
            <div  class="d-flex   my-2  justify-content-around">
              <div class="fw-bold    d-inline">
                <span class="fs-6 ">جميع الكورسات التي تتابعها</span>
              </div>
            </div>
            <hr class="horizontal  my-2 dark">
          </div>
        </div>
          <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-15 justify-content-center align-items-center" style=" top: 0; right: 0;    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 fa-sharp fa-solid fa-eye text-white"></i>
          </div>
          <div class="table-responsive px-3">
            <table class="table align-items-center mb-0 ">
              <thead>
                <tr class="">
                  <th class="text-uppercase text-nowrap py-3 fw-bolder">عنوان الكورس</th>
                  <th class="text-uppercase text-nowrap py-3 fw-bolder ps-2">النوع</th>
                  <th class="text-uppercase text-nowrap py-3 text-center  fw-bolder">الدروس</th>
                  <th class="text-uppercase text-nowrap py-3 fw-bolder">الجذء المدروس</th>
                  <th class="text-uppercase text-nowrap py-3 text-center fw-bolder">النتيجة</th>
                  <th class="text-uppercase text-nowrap py-3 text-center fw-bolder">اختبار الاتمام</th>
                  <th class="text-uppercase text-nowrap py-3 text-center fw-bolder">إزالة</th>
                </tr>
              </thead>
              <tbody>
                @foreach(Auth::user()->courses as $course)         
                <tr id="item-{{$course->id}}" class="text-nowrap">
                  <td class="align-middle px-3 ">
                    <a class="d-flex py-1 nav-link " href="{{route('show-course',$course->slug)}}">
                      <div class="">
                        <img src="{{$course->photo}}" class="avatar avatar-sm mx-1" alt="{{$course->title}}">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <span class="mb-0 text-uppercase  fw-bolder text-dark"> {{$course->title}}</span>
                      </div>
                    </a>
                  </td>
                  <td class=" px-3 align-middle ">
                    <span class=" fw-bold"> 
                    @if(Auth::user()->plan !== null)
                      @if($course->plans->where('title',Auth::user()->plan->title)->count() > 0)
                      تابع لخطة التعلم                     
                      @else
                      تعلم فردي
                      @endif
                    @else
                      تعلم فردي
                    @endif                     
                    </span>
                  </td>
                    <td class=" px-3 align-middle text-center text-sm">
                      <span class="text-sm fw-bold">{{$course->lessons->count()}}</span>
                    </td>
                    @if($course->lessons()->whereHas('exams')->count() > 0)
                    @if ($courseProgres = CourseProgres($course)) @endif
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-sm fw-bold">{{$courseProgres}} %</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar 
                            @if($courseProgres == 100)  bg-gradient-success
                            @elseif($courseProgres < 50) bg-gradient-warning 
                            @else bg-gradient-info @endif  
                            @if($courseProgres <= 10 || $courseProgres % 5 == 0) w-{{$courseProgres}} 
                            @else w-{{substr_replace($courseProgres, '', -1).'5'}} @endif"
                            role="progressbar" aria-valuenow="{{$courseProgres}}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-sm fw-bold">@if(Auth::user()->lessons->where('course_id',$course->id)->count() > 0) {{(int)((Auth::user()->lessons->where('course_id',$course->id)->sum('result'))/(Auth::user()->lessons->where('course_id',$course->id)->count()))}} @else 0 @endif %</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <!-- 

                          if(Auth::user()->courses()->where('course_id',$course->id)->count() >= $course->lessons()->count())
                        -->
                      @if($course->user_course()->where('user_id',Auth::user()->id)->where('course_id',$course->id)->first()->isexamine == 1)
                        <button class="btn  rounded-3 bg-gradient-light fs-6 py-1 px-3 mb-0">
                          تم الأختبار <i class="fa-solid fa-file-pen"></i>
                        </button>

                      @else
                        @if($courseProgres >= 50)
                          <button id="{{$course->id}}" data_href="{{route('course.exams',$course->slug)}}" type="button" class="btn  rounded-3 bg-gradient-{{$course->color}} fs-6 py-1 px-3 mb-0 exam "
                            data-bs-toggle="modal" data-bs-target="#ExamModal"
                            course-title="{{ Auth::user()->courses->where('id',$course->id)->first()->title }}"
                            lesson-count="{{ Auth::user()->courses->where('id',$course->id)->first()->lessons->count() }}"
                            questions-count="{{ Auth::user()->courses->where('id',$course->id)->first()->exams->count() }}">
                            الأختبار  <i class="fa-solid fa-file-pen"></i>
                          </button>
                        @else
                          <button id="{{$course->id}}"  class="btn  rounded-3 bg-gradient-{{$course->color}} fs-6 py-1 px-3 mb-0 exam "
                            data-bs-toggle="tooltip" data-bs-placement="top" title="يجب اتمام 50% من الكورس قبل التقديم على اختبار اتمام الكورس">
                            الأختبار <i class="fa-solid fa-file-pen"></i>
                          </button>
                        @endif
                      @endif
                      </td>
                    @else
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-sm fw-bold">0 %</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar  "
                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-sm fw-bold">0 %</span>
                      </td>
                      
                      <td class="align-middle text-center text-sm">                
                        <button id="{{$course->id}}"  class="btn  rounded-3 bg-gradient-{{$course->color}} fs-6 py-1 px-3 mb-0 exam "
                          data-bs-toggle="tooltip" data-bs-placement="top" title="هذا الكورس غير مكتمل بعد سنوفره قريبا">
                          قريبا <i class="fa-solid fa-file-pen"></i>
                        </button>
                      </td> 
                    @endif
  
                  <td class="align-middle text-center text-sm">
                    @if(Auth::user()->plan !== null)
                      @if($course->plans->where('title',Auth::user()->plan->title)->count() > 0)
                      <div>
                        <i class="fa-solid fa-trash-can text-secondary fs-5 opacity-50" data-bs-toggle="tooltip" data-bs-title="لا يمكن الغاء متابعة الكورس لانه تابع لخطة التعلم"></i>
                      </div>                      
                      @else
                      <a type="button" action="{{route('User.un-follow-course', $course->id)}}"
                        class="delete"
                        data-bs-toggle="modal" data-bs-target="#DeleteModal">
                        <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                      </a>
                      @endif
                    @else
                    <a type="button" action="{{route('User.un-follow-course', $course->id)}}"
                      class="delete"
                      data-bs-toggle="modal" data-bs-target="#DeleteModal">
                      <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                    </a>
                    @endif

                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
      </div>
      @include('front.includes.alerts.exam-modal')
      @include('front.includes.alerts.delete-modal', ['title_warning' => 'هل تريد الغاء المتابعة هذا الكورس','description_warning' => 'اذا قمت بالغاء المتابعة هذا الكورس ستخسر تقدمك وجميع الاختبارات الخااصة لهذا الكورس ولن تتمكن من استعادته مجددا'])

    </div>

      <div class="mx-1 my-2 m-md-4  position-relative z-index-2 ">
        <div data-sos-once="true" data-sos="sos-zoom-out" class="bg-gradient-info text-center shadow-primary py-3 rounded-5 shadow-sm text-white fs-6 fw-bolder text-capitalize mb-3">
          جميع الاسئلة التي قمت بطرحها
        </div>
      </div>
    @if(Auth::user()->questions()->limit(40)->get()->count() > 0 )
      @foreach(Auth::user()->questions()->limit(40)->get() as $index=>$question)
       
        <a  data-sos-once="false" data-sos="sos-left" href="{{route('Question.show',$question->slug)}}" class="nav-link  card d-flex flex-md-row align-items-center  m-1 m-md-4 p-2 p-md-3 py-0  border-0 rounded-5  shadow-sm mb-3">
            @if($question->created_at->diffInDays() <= 3)
                <div class="position-absolute overflow-hidden continer-new-box">
                    <div class="  w-100 bg-gradient-danger  position-absolute text-white font-weight-bolder text-center text-sm new-box" >جديد</div>
                </div>
            @endif
            <div class="block-idea-side-content py-2  me-md-3">
                <i class="fa-solid fa-question  "></i> 
                <div class="block-idea-side info-block-idea-side"></div>
                <div class="block-idea-side info-block-idea-side"></div>
                <div class="block-idea-side info-block-idea-side"></div>
                <div class="block-idea-side info-block-idea-side"></div>
                <div class="block-idea-side info-block-idea-side"></div>
            </div>
            <div class="py-2 py-md-0 question-all-content">
                <span class="text-md-start  mx-3 mx-md-0">
                    <div class="text-dark fw-bolder fs-5 d-inline-block">
                        {{$question->title}}  
                    </div>
                    @if($question->comments !== null )
                      @if($question->comments->where('watch','0')->count() > 0)
                      <span class=" rounded-pill  bg-gradient-danger fw-bolder px-2 mx-1"> 
                        {{$question->comments->where('watch','0')->count()}} رد جديد
                      </span>
                      @elseif($question->comments->where('updated_at','<','1')->count() > 0)
                      <span class=" rounded-pill  bg-gradient-danger fw-bolder px-2 mx-1"> 
                        {{$question->comments->where('updated_at','<','1')->count()}} رد جديد
                      </span>
                      @endif
                    @endif
                </span>
                <div class="my-3  m-md-2  mx-3 mx-md-0">
                  <span class="badge bg-gradient-info  text-light rounded-pill text-sm"># {{$index+1}} </span>  
                  @foreach($question->questionlibraries as $questionlibrary) 
                  <span class="badge bg-gradient-info  text-light rounded-pill text-sm">{{$questionlibrary->title}} </span>                    
                  @endforeach                 
                </div>
                <div class="m-2 fw-bolder">
                  <span class=" badge text-sm text-secondary"><i class="fa-sharp fa-solid fa-eye text-info"></i>  {{$question->views}}</span>   
                  <span class="badge text-sm text-secondary"><i class="fa-solid fa-heart text-info"></i>  {{$question->likes}}</span>
                  <span class="badge text-sm text-secondary"><i class="fa-solid fa-comments text-info"></i>  {{($question->comments->count())+($question->comments()->whereHas('comment_replies')->with('comment_replies')->get()->pluck('comment_replies')->flatten()->count())}}</span>
                  <span class="badge text-sm text-secondary"> <i class="fa-solid fa-calendar-days text-info"></i>{{$question->created_at->diffForHumans()}} </span>
                </div>
                
            </div>
        </a>
      @endforeach
    @else
      <div class="fs-4 text-center p-2 p-md-5 pb-5 fw-bolder">لم تقوم بإضافة اسئلة بعد </div>
    @endif  


@endsection

@section('script')

<script>
  scroll_to_right();
  function scroll_to_right(){
    let scroll_right = document.querySelectorAll('.scroll-right');
    scroll_right.forEach(element => {
        $(element).siblings('div.table-responsive').scroll(function(){
            $(element).removeClass('d-none');
            if($(this).scrollLeft() == 1 || $(this).scrollLeft() == 0){
                $(element).addClass('d-none');
            }
        });
        $(element).click(function(){
            $(element).siblings('div.table-responsive').animate({
                scrollLeft: 0
            }, 300);
        })
    });
  }
  delete_buttons();
 
  set_course_info();
  function set_course_info(){
    let exams = document.querySelectorAll(".exam");

    for (let i = 0; exams[i] ; i++) {
        exams[i].onclick=function(){
            $(".course-exams-link").attr("href",$(exams[i]).attr('data_href'));
            $("ul.course-info li span.course-title").text($(exams[i]).attr('course-title'));
            $("ul.course-info li span.lesson-count").text($(exams[i]).attr('lesson-count'));
            $("ul.course-info li span.questions-count").text($(exams[i]).attr('questions-count'));
        }
    }
  }
 
  let visible_btn = document.querySelectorAll(".user_appear label");
 
  let getUserActive = document.querySelector('#getUserActive');

  let user_appear='{{ Auth::user()-> user_appear }}';

  for (let i = 0; visible_btn[i] ; i++) {
    if (i == user_appear) {
      visible_btn[i].classList.add('active_btn');
    }
  }
  function clc_vivible(class_btn){
    for (let i = 0; visible_btn[i] ; i++) {
      visible_btn[i].classList.remove('active_btn','ajax-submit');
      visible_btn[i].checked = false;
    }
    document.querySelector(`.${class_btn}`).classList.add('active_btn','ajax-submit');
    let radio_id=$(`.${class_btn}`).attr('for');
    document.querySelector(`#${radio_id}`).checked = true;
    getUserActive.textContent=document.querySelector(`.${class_btn}`).textContent;
  }
   
  function checkFunction(itemclass) {
    let items = document.querySelectorAll(`.${itemclass} li div`);
    let arrayItems=[...items];
    arrayItems.forEach(item => {
      item.querySelector("input[type='checkbox']").checked = false;
      if(item.classList.contains("active")){
        item.querySelector("input[type='checkbox']").checked = true;
      }
    });
  }
  
</script>

@endsection

