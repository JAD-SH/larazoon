
<!-- 
  

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl mt-7 mb-3 fixed-end me-3 rotate-caret shadow-blur my-md-3" id="sidenav-main" style="background-color: #1a2035 !important;">
  <div class="mx-3">
    <a class="btn bg-gradient-primary mt-4 w-100 fs-6 font-weight-bold " href="{{route('dashboard')}}" type="button" style="color: #fff !important; ">HelloLaravel</a>
  </div>
  <hr class="horizontal light m-0">
  <div class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
    
  
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('dashboard')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class="nav-link-text me-1">لوحة التحكم</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('MainCategory-dashboard.index')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-book"></i>
          </div>
          <span class="nav-link-text me-1">الاقسام الرئيسية</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('SubCategory-dashboard.index')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-book"></i>
          </div>
          <span class="nav-link-text me-1">الاقسام الفرعية</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('Course-dashboard.index')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-book"></i>
          </div>
          <span class="nav-link-text me-1">قسم الكورسات</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('Plan-dashboard.index')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-book"></i>
          </div>
          <span class="nav-link-text me-1">خطط التعلم</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('ArticleLibrary-dashboard.index')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-book"></i>
          </div>
          <span class="nav-link-text me-1">قسم المقالات</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('BookLibrary-dashboard.index')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-book"></i>
          </div>
          <span class="nav-link-text me-1">مكتبة الكتب</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('QuestionLibrary-dashboard.index')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class="nav-link-text me-1">قسم الاسئلة</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('User-dashboard.index')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class="nav-link-text me-1">قسم المستخدمين</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('Notification-dashboard')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class="nav-link-text me-1">قسم الإشعارات</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  font-weight-bolder " href="{{route('Notification-dashboard')}}">
          <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
          <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class="nav-link-text me-1">حساب تعريفي</span>
        </a>
      </li>
      
    </ul>
  
  </div>
  <hr class="horizontal light m-0">

</aside>

  
@section('script')

@endsection



-->




<div style="width:300px; background-color:#0e0e0e  !important;" class=" offcanvas offcanvas-start rounded-5 m-3 p-3" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
  
  <div class="offcanvas-header p-0">
    <div class="offcanvas-title w-100 text-center">
      <span class="navbar-logo w-100 fs-5 fw-bold  py-3 text-primary" href="{{route('dashboard')}}">{{Site()->site_name}}
           <img src="{{Site()->site_logo}}" alt="">
      </span>
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <hr class="horizontal light ">

  <div class="offcanvas-body p-0">
    <ul class="navbar-nav sidebar-category flex-grow-1">

      <li id="sidebar-dashboard-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('dashboard')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">لوحة التحكم</span>
        </a>
      </li>

      <li id="sidebar-maincategories-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('MainCategory-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">الاقسام الرئيسية</span>
        </a>
      </li>
      <li id="sidebar-Subcategories-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('SubCategory-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">الاقسام الفرعية</span>
        </a>
      </li>
      <li id="sidebar-courses-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('Course-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">قسم الكورسات</span>
        </a>
      </li>
      <li id="sidebar-plans-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('Plan-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">خطط التعلم</span>
        </a>
      </li>
      <li id="sidebar-articlelibraries-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('ArticleLibrary-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">قسم المقالات</span>
        </a>
      </li>
      <li id="sidebar-booklibraries-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('BookLibrary-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">مكتبة الكتب</span>
        </a>
      </li>
      <li id="sidebar-questionlibraries-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('QuestionLibrary-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">قسم الاسئلة</span>
        </a>
      </li>
      <li id="sidebar-users-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('User-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">قسم المستخدمين</span>
        </a>
      </li>
      <li id="sidebar-notifications-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('Notification-dashboard')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">قسم الإشعارات</span>
          @if(Asks()->count() > 0 || Messages()->count() > 0) 
          <span class=" translate-middle rounded-pill bg-gradient-danger text-white   px-2 mx-1 text-sm">
            جديد
          </span>
          @endif
        </a>
      </li>
      <li id="sidebar-supporters-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('Supporter-dashboard.index')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">الداعمين</span>
          @if(Supporters()->where('verification',null)->count() > 0 ) 
          <span class=" translate-middle rounded-pill bg-gradient-danger text-white   px-2 mx-1 text-sm">
            جديد
          </span> 
          @endif
        </a>
      </li>
      <li id="sidebar-profile-section" class="nav-item my-1">
        <a class=" fs-6 fw-bold  py-2 d-inline-block w-100" href="{{route('Notification-dashboard')}}">
          <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
            <i class="fas fa-shield-alt text-light"></i>
          </div>
          <span class=" me-1 text-light">حساب تعريفي</span>
        </a>
      </li>

    </ul>
  </div>

</div>

@section('script')

@endsection
