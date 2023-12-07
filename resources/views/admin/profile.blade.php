@extends('layouts.admin.dashboard')

@section('title','الملف الشخصي ')

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">الملف الشخصي للادمن</li>
@endsection

@section('content')
<div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
<span class="mask  bg-gradient-primary  opacity-5"></span>
</div>
<div class="card card-body mx-3 mx-md-4 mt-n6">
    <div class="row gx-4 mb-2">
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative rounded-3" style="height:180px; overflow: hidden;">
                <img src="{{ $user->photo }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">
                {{ $user->name }}
                </h5>
                <p class="mb-0 font-weight-normal text-sm">
                {{ $user->interest }} Developer 
                </p>
            </div>
            <div class="col-md-4 text-end">
                <a href="javascript:;">
                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-12 col-xl-4 col-md-6">
            <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">معلومات الدراسة</h6>
                    </div>
                    
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group p-0">
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">التسجيل:</strong> &nbsp; مدفوع احترافي</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">الاهتمام:</strong> &nbsp; {{ $user->interest }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">المستوى:</strong> &nbsp;50% ماستر</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">المقالات التي قمت بنشرها:</strong> &nbsp; {{ $user->publish_article }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">الاختبارات التي اجتزتها:</strong> &nbsp; {{ $user->exams }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">الاسئلة التي قمت بطرحها:</strong> &nbsp; {{ $user->issues }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">الاسئلة التي قمت بالاجابة عنها:</strong> &nbsp; {{ $user->answers }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">الدروس التي قمت بتقييمها:</strong> &nbsp; {{ $user->lesson_assessment }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">عدد اعجابات ملفك الشخصي:</strong> &nbsp; {{ $user->likes }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">مشاهدات ملفك الشخصي:</strong> &nbsp; {{ $user->views }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">المقالات التي قمت بقرائتها:</strong> &nbsp; {{ $user->read_article }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">محترف بنسبة:</strong> &nbsp;{{ $user->professionalism }}%</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 col-md-6">
            <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">وصف حولك</h6>
                    </div>
                    
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="text-sm">
                    {{ $user->description }}
                    </p>
                    <hr class="horizontal gray-light my-4">
                    <ul class="list-group p-0">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">الأسم الكامل:</strong> &nbsp; {{ $user->name }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">العمر:</strong> &nbsp; {{ $user->getAge() }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">حالة الحساب:</strong> &nbsp; {{ $user->getActive() }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">الجنس:</strong> &nbsp; {{ $user->getGender() }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">اجمالي التبرع للموقع :</strong> &nbsp;{{ $user->total_donations }}$</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">البريد الالكتروني:</strong> &nbsp; {{ $user->email }}</li>
                        <li class="list-group-item border-0 ps-0 pb-0">
                            <strong class="text-dark text-sm">مواقع التواصل:</strong> &nbsp;
                            <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $user->facebook }}">
                            <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $user->twitter }}">
                            <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $user->instagram }}">
                            <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        </li>    
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">الإعدادات</h6>
                </div>
                <div class="card-body p-5">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">حسابك</h6>
                    <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input d-none" name="active" value="0" type="checkbox" checked="">
                            <input class="form-check-input ms-auto" name="active" value="1" data-color="success" type="checkbox" id="flexSwitchCheckDefault" @if(Auth::user()-> active == 1)checked @endif>                   
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">{{ $user->getActive() }} </label>
                          </div>
                        </li>
                        
                      </ul>
                      <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">اشعارات الموقع</h6>
                      <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                          <div class="form-check form-switch ps-0">
                              <input class="form-check-input d-none" name="site_notification" value="0" type="checkbox" checked="">
                            <input class="form-check-input ms-auto" name="site_notification"  value="1" type="checkbox" id="flexSwitchCheckDefault3" @if(Auth::user()-> site_notification == 1)checked @endif>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">{{ $user-> getSiteNotification() }}</label>
                            </div>
                        </li>
                        
                    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mx-3 mx-md-4 mt-5">
    <div class="row ">
        <div class="col-lg-8 col-md-12 mb-md-5 mb-4">
          <div class="card px-3">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>الكورسات</h6>
                  <p class="text-sm mb-0">
                    <span class="font-weight-bold text-info ms-1">جميع الكورسات التي تتابعها</span> 
                  </p>
                </div>
                
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><h6>عنوان الكورس</h6></th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><h6>النوع</h6></th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><h6>الجذء المدروس</h6></th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><h6>إزالة</h6></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{asset('public/assets/img/home-decor-1.jpg')}}" class="avatar avatar-sm mx-1" alt="xd">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"> Material XD Version</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> $14,000 </span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">100%</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <a href="#">
                        <i class="fas fa-shield-alt text-danger text-gradient"></i>
                      </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-9 mb-md-5 mb-4">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>مستواك البرمجي</h6>
              <p class="text-sm">
              <i class="fas fa-shield-alt text-primary text-gradient"></i>
              <span class="font-weight-bold">24%</span>(متوسط)
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="h6 fas fa-shield-alt text-success text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">مبتدأ</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">0-10% (غير مستعد للعمل بالبرمجة)</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="h5 fas fa-shield-alt text-danger text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">متوسط</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">10-25% (قادر على فهم الاكواد البرمجة وتقليد الاكواد)</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="h4 fas fa-shield-alt text-info text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">محترف</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">25-50% (قادر على كتابة الاكواد وانشاءبعض المواقع وبيعها)</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="h3 fas fa-shield-alt text-warning text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">متقدم جدا</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">50-65% (قادر على انشاء اي موقع الكتروني على الانترنت)</p>
                  </div>
                </div>
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="h2 fas fa-shield-alt text-primary text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">خبير</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">65-80% (مطلوب جدا في سوق العمل وقادر على الاشراف على مطورين الويب )</p>
                  </div>
                </div>
                <div class="timeline-block">
                  <span class="timeline-step ">
                    <i class="h1 fas fa-shield-alt text-dark text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">فائق الخبرة</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">80-100% (ماستر قادر على شغر اي وظيفة برمجية في اختصاصك .. وانشاء مشاريع بجودة وكفائة واتقالن عالي جدا )</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<div class="card card-body mx-3 mx-md-4">
    <div class="row gx-4 mb-2">
        <div class="col-12 mt-4">
            <div class="mb-5 ps-3">
            <h6>الاسئلة</h6>
            <p class="text-sm mb-0">
              <span class="font-weight-bold text-info ms-1">جميع الاسئلة التي قمت بطرحها</span> 
            </p>
            <div class="row  mt-5">
            <div class="col-xl-3 col-md-6 mb-xl-0 my-4">
                <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                    <a class="d-block shadow-xl border-radius-xl">
                    <img src="{{asset('public/assets/img/home-decor-1.jpg')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                    </a>
                </div>
                <div class="card-body p-3">
                    <p class="mb-0 text-sm">Project #2</p>
                    <a href="javascript:;">
                    <h5>
                        Modern
                    </h5>
                    </a>
                    <p class="mb-4 text-sm">
                    As Uber works through a huge amount of internal management turmoil.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                    <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-1.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-2.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-3.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-4.jpg')}}">
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-xl-0 my-4">
                <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                    <a class="d-block shadow-xl border-radius-xl">
                    <img src="{{asset('public/assets/img/home-decor-1.jpg')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                    </a>
                </div>
                <div class="card-body p-3">
                    <p class="mb-0 text-sm">Project #2</p>
                    <a href="javascript:;">
                    <h5>
                        Modern
                    </h5>
                    </a>
                    <p class="mb-4 text-sm">
                    As Uber works through a huge amount of internal management turmoil.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                    <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-1.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-2.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-3.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-4.jpg')}}">
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-xl-0 my-4">
                <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                    <a class="d-block shadow-xl border-radius-xl">
                    <img src="{{asset('public/assets/img/home-decor-1.jpg')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                    </a>
                </div>
                <div class="card-body p-3">
                    <p class="mb-0 text-sm">Project #2</p>
                    <a href="javascript:;">
                    <h5>
                        Modern
                    </h5>
                    </a>
                    <p class="mb-4 text-sm">
                    As Uber works through a huge amount of internal management turmoil.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                    <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-1.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-2.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-3.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-4.jpg')}}">
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-xl-0 my-4">
                <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                    <a class="d-block shadow-xl border-radius-xl">
                    <img src="{{asset('public/assets/img/home-decor-1.jpg')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                    </a>
                </div>
                <div class="card-body p-3">
                    <p class="mb-0 text-sm">Project #2</p>
                    <a href="javascript:;">
                    <h5>
                        Modern
                    </h5>
                    </a>
                    <p class="mb-4 text-sm">
                    As Uber works through a huge amount of internal management turmoil.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                    <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-1.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-2.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-3.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-4.jpg')}}">
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-xl-0 my-4">
                <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                    <a class="d-block shadow-xl border-radius-xl">
                    <img src="{{asset('public/assets/img/home-decor-2.jpg')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                    </a>
                </div>
                <div class="card-body p-3">
                    <p class="mb-0 text-sm">Project #1</p>
                    <a href="javascript:;">
                    <h5>
                        Scandinavian
                    </h5>
                    </a>
                    <p class="mb-4 text-sm">
                    Music is something that every person has his or her own specific opinion about.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                    <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-3.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-4.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-1.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-2.jpg')}}">
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-xl-0 my-4">
                <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                    <a class="d-block shadow-xl border-radius-xl">
                    <img src="{{asset('public/assets/img/home-decor-3.jpg')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                    </a>
                </div>
                <div class="card-body p-3">
                    <p class="mb-0 text-sm">Project #3</p>
                    <a href="javascript:;">
                    <h5>
                        Minimalist
                    </h5>
                    </a>
                    <p class="mb-4 text-sm">
                    Different people have different taste, and various types of music.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                    <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-4.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-3.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-2.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-1.jpg')}}">
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-xl-0 my-4">
                <div class="card card-blog card-plain">
                <div class="card-header p-0 mt-n4 mx-3">
                    <a class="d-block shadow-xl border-radius-xl">
                    <img src="{{asset('public/assets/img/home-decor-3.jpg')}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                    </a>
                </div>
                <div class="card-body p-3">
                    <p class="mb-0 text-sm">Project #4</p>
                    <a href="javascript:;">
                    <h5>
                        Gothic
                    </h5>
                    </a>
                    <p class="mb-4 text-sm">
                    Why would anyone pick blue over pink? Pink is obviously a better color.
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                    <div class="avatar-group mt-2">
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-4.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-3.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-2.jpg')}}">
                        </a>
                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                        <img alt="Image placeholder" src="{{asset('public/assets/img/team-1.jpg')}}">
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

