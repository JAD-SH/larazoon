@extends('layouts.front.site')

@section('title', $user->username .' - الملف الشخصي')

@section('meta_tags')
<meta name="robots" content="noindex">
@endsection

@section('css')
  <link href="{{asset('public/assets/css/profile.css')}}" rel="stylesheet" />
@endsection

@section('path')
  <li class="breadcrumb-item fw-bolder active " aria-current="page"><i class="fa-solid fa-address-card "></i> {{$user->username}} </li>
@endsection

@section('content')

<div class="m-0">
  <div class="">
      <div data-sos-once="true" data-sos="sos-blur" class="page-header rounded-5 py-3" style="background-image: url({{Site()->user_profile_background}}); height:200px;">
        <span class="mask bg-gradient-primary"></span>
      </div>
      <div class="card m-1 m-md-4 p-2 p-md-4 pt-0 border-0 rounded-5 shadow-sm mb-5 mt-n6">
        <div class="row m-2">
            <div class="col-auto px-0">
              <a href="{{ $user->getPhoto() }}" class="avatar avatar-xl position-relative py-1 nav-link pe-1">
                <img src="{{ $user->getPhoto() }}" alt="{{ $user->name }}" class="w-100 h-100 rounded-4">
              </a>    
            </div>
            <div class="col-auto my-auto">
              <div class="h-100">
                <div class="mb-1 fs-5 text-dark fw-bolder">
                {{ $user->name }}
                </div>
                <p class="mb-0 fw-bolder text-sm text-info" style="font-size: 12px;">
                {{ $user->interest }} Developer 
                </p>
              </div>
            </div>
        </div>
        <div class="row">
          <div data-sos-once="true" data-sos="sos-top" class="col-12 col-md-6">
              <div class="h-100">
                  <div class=" pb-0 p-3">
                      <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                          <h6 class="mb-0 text-dark fw-bolder"><ins class="text-dark">-معلومات الدراسة</ins></h6>
                        </div>
                      
                      </div>
                  </div>
                  <div class=" p-3">
                    <ul class=" p-0 fw-bolder">
                      <li class="py-2 text-dark">يتابع خطة التعلم : <span class=" text-uppercase">&nbsp; @if($user->plan !== null) _{{ $user->plan->title }}_ @else لم يتابع خطة تعلم @endif</span> </li>
                      <li class="py-2 text-dark">الاهتمام : <span>&nbsp; _{{ $user->interest }}_</span> </li>
                      <li class="py-2 text-dark">المستوى : <span>&nbsp;{{$user->courses()->where('isexamine',1)->count()}}</span></li>
                      <li class="py-2 text-dark">محترف بنسبة : <span>&nbsp;@if($user->lessons->count() > 0){{ (int)(($user->lessons->sum('result'))/($user->lessons->count())) }} @else 0 @endif%   </span> </li>
                      <li class="py-2 text-dark">اجمالي التبرع للموقع : <span>&nbsp;{{ $user->total_donations }}$</span> </li>
                      <li class="py-2 text-dark">حالة الحساب : <span id="getUserActive">&nbsp; {{ $user->getUserActive() }}</span></li>
                      <li class="py-2 text-dark">المقالات التي قام بنشرها : <span>&nbsp; غير متاح</span></li>
                      <li class="py-2 text-dark">الاسئلة التي قام بطرحها : <span>&nbsp; {{ $user->questions()->count() }}</span></li>
                      <li class="py-2 text-dark">الأجوبة التي قام بأقتراحها : <span>&nbsp;  {{ $user->comments()->count() }}</span></li>
                      <li class="py-2 text-dark">الدروس التي قام بتقييمها : <span>&nbsp; {{ $user->lesson_assessment }}</span></li>
                      <li class="py-2 text-dark">عدد اعجابات ملفك الشخصي : <span>&nbsp; {{ $user->likes }}</span></li>
                      <li class="py-2 text-dark">مشاهدات ملفك الشخصي : <span>&nbsp; {{ $user->views }}</span></li>
                      <li class="py-2 text-dark">المقالات التي قام بقرائتها : <span>&nbsp; {{ $user->read_article }}</span></li>
                      <li class="py-2 text-dark">تاريخ الإنضمام : <span>&nbsp; {{ $user->created_at->diffForHumans() }}</span></li>   
                    </ul>
                  </div>
              </div>
          </div>
          <div data-sos-once="true" data-sos="sos-top" class="col-12 col-xl-3 col-md-6">
            <div class="h-100">
                <div class=" pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="mb-0 text-dark fw-bolder"><ins class="text-dark">-وصف حول {{ $user->name }}</ins></div>
                    </div>
                  
                    <p class="my-3 mx-2 fw-bolder">
                    {{ $user->description }}
                    </p>
                  </div>
                </div>
                <div class=" p-3">
                  <ul class=" p-0 fw-bolder">
                    <li class="py-2 text-dark">الأسم الكامل :<span> &nbsp; {{ $user->name }}</span></li>
                    <li class="py-2 text-dark">اسم المستخدم :<span> &nbsp; {{ $user->username }}</span></li>
                    @if($user->user_appear == 1)
                    <li class="py-2 text-dark">العمر : <span>&nbsp; {{ $user->getAge() }}</span></li>
                    <li class="py-2 text-dark ">الجنس : <span>&nbsp;  {{ $user->getGender() }}</span></li>
                    <li class="py-2 text-dark">البريد الالكتروني :<span> &nbsp; {{ $user->email }}</span></li>
                    <li class="py-2 text-dark"> مواقع التواصل : 
                      @if($user->facebook !== null)
                      <a class="m-2" target="_blank" href="{{$user->facebook}}">
                        <i class="fab fa-facebook fa-lg text-info fs-5"></i>
                      </a>
                      @endif 
                      @if($user->twitter !== null)
                      <a class="m-2" target="_blank" href="{{$user->twitter}}">
                        <i class="fab fa-twitter fa-lg text-info fs-5"></i>
                      </a>
                      @endif 
                      @if($user->instagram !== null)
                      <a class="m-2" target="_blank" href="{{$user->instagram}}">
                        <i class="fab fa-instagram fa-lg text-warning fs-5"></i>
                      </a>
                      @endif 
                      @if($user->github !== null)
                      <a class="m-2" target="_blank" href="{{$user->github}}">
                        <i class="fab fa-github fa-lg text-dark fs-5"></i>
                      </a>
                      @endif 
                      
                    </li> 
                    @endif
                  </ul>
                </div>
            </div>
          </div>
    
        </div>
        <div class=" ">
          
          @if(! session()->has('user'.$user->id.'IsLiked'))
            <form class="d-inline-block" action="{{route('User.AddLike',$user->id)}}" method="POST">
                @csrf
                <button class="btn rounded-4 bg-gradient-info my-0 py-2 px-4 fs-6 border-2 font-weight-bolder mx-1 ajax-submit">
                    اعط المستخدم  <i class="fs-5 fa-solid fa-heart"></i>
                </button>
            </form>
          @else 
            <button class="btn rounded-4 bg-gradient-info my-0 py-2 px-4 fs-6 border-2 font-weight-bolder mx-1">
                قمت بالاعجاب  <i class="fs-5 fa-solid fa-heart"></i>
            </button>
          @endif

          @if($user->supports()->count() > 0)
            <a class="btn rounded-4 bg-gradient-success my-0 py-2 px-4 fs-6 border-2 font-weight-bolder mx-1" href="{{route('User.supporter-archive',$user->username)}}">سجل الدعم</a>
          @else 
            <button class="btn rounded-4 bg-gradient-danger my-0 py-2 px-4 fs-6 border-2 font-weight-bolder mx-1">لم يدعمنا بعد</button>
          @endif
                 
        </div>
    </div>

  </div>
    
</div>


@if($user->plan !== null)

@if ($planProgres = UserPlanProgres($user)) @endif
  <div class=" my-3 ">
    <div class="row m-0">


      <div class="col-lg-8 col-md-12 mb-2 mb-lg-0 p-0">
        <div class="card m-1 m-md-4 p-2 p-md-4 pt-0  border-0 rounded-5  shadow-sm  overflow-hidden">
          <div class=" py-2">
            <div class="row m-0  px-3">
              <div class=" my-2 ">
                <div class="fw-bold text-nowrap d-inline p-2">
                  <span class="fs-6">خطة التعلم</span>
                  <span class=" text-info ms-1 text-uppercase">_{{ $user->plan->title }}_</span> 
                </div>
                <div class="fw-bold text-nowrap d-inline p-2">
                  <span class="fs-6">عدد الكورسات </span>
                  <span class="text-info ms-1 text-uppercase">_{{$user->plan->first()->courses()->count()}}_</span> 
                </div>
                <div class="fw-bold text-nowrap d-inline p-2">
                  <span class="fs-6">عدد الدروس </span>
                  <span class="text-info ms-1 text-uppercase">_{{$user->plan->first()->courses()->with('lessons')->get()->pluck('lessons')->count()}}_</span> 
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
                  <th class="text-uppercase fw-bolder py-3">الترتيب</th>
                  <th class="text-uppercase text-center fw-bolder py-3">عنوان الكورس</th>
                  <th class="text-uppercase fw-bolder py-3">الدروس</th>
                  <th class="text-uppercase fw-bolder py-3">الجذء المدروس</th>
                  <th class="text-uppercase fw-bolder py-3">النتيجة</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->plan->courses as $index=>$course)
                  <tr id="item-{{$course->id}}" class="text-nowrap">
                    <td class="align-middle px-3 text-center text-sm" style="width:25px;">
                      <span class="text-sm fw-bold">{{$index+1}}#</span>
                    </td>
                    <td class="align-middle px-3 ">
                      <a class="d-flex py-1 nav-link " href="{{route('show-course',$course->slug)}}">
                        <div class="">
                          <img src="{{$course->photo}}" class="avatar avatar-sm mx-1" alt="{{$course->title}}" style="height: 25px !important;">
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
                   
                    @if ($courseProgres = UserCourseProgres($user, $course)) @endif
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
                        <span class="text-sm fw-bold">@if($user->lessons->where('course_id',$course->id)->count() > 0) {{(int)(($user->lessons->where('course_id',$course->id)->sum('result'))/($user->lessons->where('course_id',$course->id)->count()))}} @else 0 @endif <!-- {$course->user_course()->where('user_id',$user->id)->where('course_id',$course->id)->first()->result}-->  %</span>
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
                      
                    @endif

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
      <div class="col-lg-4 col-md-9  p-0">
        <div class="card  m-1 m-md-4 p-2 p-md-4 pt-0  border-0 rounded-5  shadow-sm ">
          <div class=" py-2">
            <div class="row m-0 px-3">
              <div class="d-flex   my-2  justify-content-around">
                <div class="fw-bold    d-inline">
                  <span class="fs-6 ">مسيرته البرمجية في هذه الخطة</span>
                  <span class=" text-info ms-1 text-uppercase"><i class=" fas
                  @if($planProgres >= 1 && $planProgres < 20) fa-shield-alt text-success
                  @elseif($planProgres >= 20 && $planProgres < 40) fa-shield-alt text-danger
                  @elseif($planProgres >= 40 && $planProgres < 60) fa-shield-alt text-info
                  @elseif($planProgres >= 60 && $planProgres < 80) fa-shield-alt text-warning
                  @else fa-shield-alt text-primary
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
                  <i class="fs-5 fas fa-shield-alt @if($planProgres >= 1) text-success @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content @if(!$planProgres >= 1) opacity-50 @endif">
                  <span class="text-dark fw-bold mb-0">مبتدأ</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">0-19% (غير مستعد للعمل بالبرمجة)</p>
                </div>
              </div>
              <div class="timeline-block mb-3 @if($planProgres < 20 && $planProgres !== 20) opacity-50 @endif">
                <span class="timeline-step  bg-transparent">
                  <i class="fs-4 fas fa-shield-alt @if($planProgres >= 20) text-danger @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content">
                  <span class="text-dark fw-bold mb-0">متوسط</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">20-39% (قادر على فهم الاكواد البرمجة وتقليد الاكواد)</p>
                </div>
              </div>
              <div class="timeline-block mb-3 @if($planProgres < 40 && $planProgres !== 40) opacity-50 @endif">
                <span class="timeline-step  bg-transparent">
                  <i class="fs-3 fas fa-shield-alt @if($planProgres >= 40) text-info @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content">
                  <span class="text-dark fw-bold mb-0">محترف</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">40-59% (قادر على كتابة الاكواد وانشاءبعض المواقع وبيعها)</p>
                </div>
              </div>
              <div class="timeline-block mb-3 @if($planProgres < 60 && $planProgres !== 60) opacity-50 @endif">
                <span class="timeline-step  bg-transparent">
                  <i class="fs-2 fas fa-shield-alt @if($planProgres >= 60) text-warning @else text-secondary @endif "></i>
                </span>
                <div class="timeline-content">
                  <span class="text-dark fw-bold mb-0">متقدم جدا</span>
                  <p class="text-secondary fw-bold text-sm mt-1 mb-0">60-79% (قادر على انشاء اي موقع الكتروني على الانترنت)</p>
                </div>
              </div>
              <div class="timeline-block mb-3 @if($planProgres < 80 && $planProgres !== 80) opacity-50 @endif">
                <span class="timeline-step  bg-transparent">
                  <i class="fs-1 fas fa-shield-alt @if($planProgres >= 80) text-primary @else text-secondary @endif "></i>
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

@endif



    <div class=" mb-md-3 mb-5">
      <div class="card m-1 m-md-4 p-2 p-md-4 pt-0  border-0 rounded-5  shadow-sm overflow-hidden">
        <div  data-sos-once="true" data-sos="sos-top"  class=" py-2">
          <div class="row m-0  px-3">
            <div  class="d-flex   my-2  justify-content-around">
              <div class="fw-bold    d-inline">
                <span class="fs-6 ">جميع الكورسات التي يتابعها</span>
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
                  <th class="text-uppercase py-3 fw-bolder">عنوان الكورس</th>
                  <th class="text-uppercase py-3 fw-bolder ps-2">النوع</th>
                  <th class="text-uppercase py-3 text-center  fw-bolder">الدروس</th>
                  <th class="text-uppercase py-3 fw-bolder">الجذء المدروس</th>
                  <th class="text-uppercase py-3 text-center fw-bolder">النتيجة</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->courses as $course)         
                <tr id="item-{{$course->id}}" class="text-nowrap">
                  <td class="align-middle px-3 ">
                    <a class="d-flex py-1 nav-link " href="{{route('show-course',$course->slug)}}">
                      <div class="">
                        <img src="{{$course->photo}}" class="avatar avatar-sm mx-1" alt="xd" style="height: 25px !important;">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <span class="mb-0 text-uppercase  fw-bolder text-dark"> {{$course->title}}</span>
                      </div>
                    </a>
                  </td>
                  <td class=" px-3 align-middle ">
                    <span class=" fw-bold"> 
                    @if($user->plan !== null)
                      @if($course->plans->where('title',$user->plan->title)->count() > 0)
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
                   
                    @if ($courseProgres = UserCourseProgres($user, $course)) @endif
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-sm fw-bold">{{$courseProgres}}<!-- {$course->user_course()->where('user_id',$user->id)->where('course_id',$course->id)->first()->progress}--> %</span>
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
                        <span class="text-sm fw-bold">@if($user->lessons->where('course_id',$course->id)->count() > 0) {{(int)(($user->lessons->where('course_id',$course->id)->sum('result'))/($user->lessons->where('course_id',$course->id)->count()))}} @else 0 @endif <!-- {$course->user_course()->where('user_id',$user->id)->where('course_id',$course->id)->first()->result}-->  %</span>
                      </td>
                      
                    @else
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-sm fw-bold">0%</span>
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
                      
                    @endif

                </tr>
                @endforeach
                                
                
                  
              
              </tbody>
            </table>
            
          </div>
      </div>
      
    </div>




      <div class="mx-1 my-2 m-md-4  position-relative z-index-2 ">
        <div data-sos-once="true" data-sos="sos-zoom-out" class="bg-gradient-info text-center shadow-primary py-3 mb-2 rounded-5 shadow-sm text-white fs-6 fw-bolder text-capitalize">
          جميع الاسئلة التي قام بطرحها
        </div>
      </div>
    @if($user->questions()->limit(40)->get()->count() > 0 )
      @foreach($user->questions()->limit(40)->get() as $index=>$question)
        
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
                    <div class="text-dark fw-bolder fs-5 ">
                        {{$question->title}}  
                    </div>
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
      <div class="fs-4 text-center p-5 fw-bolder">لم يقوم بإضافة اسئلة بعد </div>
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
</script>

@endsection

