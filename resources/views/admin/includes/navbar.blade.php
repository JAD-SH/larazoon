

<nav class="navbar card  border-0 rounded-5 fixed-top mt-4  position-sticky shadow-sm align-middle" style="top: 1vh;">
          <div class="container-fluid justify-content-center justify-content-md-between text-nowrap">

            <ul class="navbar-nav p-0  flex-row">
            <li class="d-flex nav-item px-md-2  ">
              <a class="navbar-logo p-0 nav-link fw-bolder text-black d-flex align-items-center" href="{{route('dashboard')}}">
              <img src="{{Site()->site_logo}}" alt="">
              </a>
            </li>
              <li class="d-flex nav-item px-3 align-items-center ">
                <button class="fs-4 border-0 bg-transparent " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                  <i class="fas fa-bars fs-4"></i>
                </button>
              </li>
              <li class="d-flex d-md-none  nav-item px-3  ">
                <a class="p-0 nav-link fw-bolder text-black d-flex align-items-center" href="{{route('dashboard')}}">
                  <i class="fa-solid fa-house-chimney"></i>
                </a>
              </li>
              <li class="d-flex d-md-none  nav-item px-3  ">
                @if(Supporters()->where('verification',null)->count() > 0 ) 
                  <span class="d-inline-block bg-gradient-danger rounded" style="width:10px; height:10px; "></span> 
                @endif
                <a class="p-0 nav-link fw-bolder text-black d-flex align-items-center" href="{{route('Supporter-dashboard.index')}}">
                  <i class="fa-solid fa-house-chimney"></i>
                </a>
              </li>
              <li class="d-flex d-md-none  align-items-center">
                  <div class="">
                    <input type="checkbox"  class="btn-check dark-mode" id="dark-mode" @isset($_COOKIE['DarkMode']) checked @endisset>
                    <label class="bg-gradient-primary rounded-3 p-1 label-mode" id="label-mode" for="dark-mode">
                    @isset($_COOKIE['DarkMode']) 
                    <i class="fa-solid fa-sun"></i>
                    @else
                    <i class="fa-solid fa-moon"></i>
                    @endisset
                    </label>
                  </div>
              </li>
              <li class="nav-item px-3 d-flex d-md-none align-items-center">
                <a href="{{route('admin.logout')}}" class="nav-link fw-bold px-0">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="">الخروج </span>
                </a>
              </li>
            </ul>
            
      <ul class="navbar-nav p-0  flex-row  d-none d-md-flex">
        
        
        <li class=" nav-item px-3 d-flex align-items-center container-fluid position-relative">
          @if(Supporters()->where('verification',null)->count() > 0 ) 
            <span class=" bg-gradient-danger rounded position-absolute" style="width:10px; height:10px; top:0; right:0;"></span> 
          @endif
          <a class="p-0 nav-link fw-bolder text-black   " href="{{route('Supporter-dashboard.index')}}">
            <i class="fa-solid fa-dollar fs-5"></i>
          </a>
        </li>
        <li class=" nav-item px-3 d-flex align-items-center container-fluid position-relative">
          @if(Asks()->count() > 0 || Messages()->count() > 0) 
            <span class=" bg-gradient-danger rounded position-absolute" style="width:10px; height:10px; top:0; right:0;"></span> 
          @endif
          <div class="dropdown ">
            <a class="p-0 nav-link fw-bolder text-black" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark rounded-5 p-2 position-absolute shadow-sm">
              <li>
                <button class="dropdown-item rounded-5 " type="button">
                  طلبات الخدمات
                  <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
                    0
                  </span>
                </button>
              </li>
              <li>
                @if(Asks() !== null) 
                  <a class="dropdown-item rounded-5 " href="{{route('Notification-dashboard')}}">
                    الاسئلة
                    <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
                      {{Asks()->count()}}
                    </span>
                  </a>
                @else
                  <button class="dropdown-item rounded-5 " type="button">
                    الاسئلة
                    <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
                      0
                    </span>
                  </button>
                @endif
              </li>
              <li>
                @if(Messages() !== null)
                  <a class="dropdown-item rounded-5 " href="{{route('Notification-dashboard')}}">
                    الابلاغات والرسائل  
                    <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
                    {{Messages()->count()}}
                    </span>
                  </a>
                @else
                  <button class="dropdown-item rounded-5 " type="button">
                    الابلاغات والرسائل
                    <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
                      0 
                    </span>
                  </button>
                @endif
              </li>
            </ul>
          </div>
        </li>


        <li class="nav-item px-3 d-flex align-items-center">
          <div class="">
            <input type="checkbox"  class="btn-check dark-mode" id="dark-mode" @isset($_COOKIE['DarkMode']) checked @endisset>
            <label class="bg-gradient-primary rounded-3 p-1 label-mode" id="label-mode" for="dark-mode">
            @isset($_COOKIE['DarkMode']) 
            <i class="fa-solid fa-sun"></i>
            @else
            <i class="fa-solid fa-moon"></i>
            @endisset
            </label>
          </div>
        </li>

        <li class="nav-item px-3 d-flex align-items-center">
          <a href="{{route('admin.logout')}}" class="nav-link fw-bold px-0">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span class="">الخروج </span>
          </a>
        </li>
      </ul>


          </div>
</nav>


<div class="bd-example-snippet bd-code-snippet m-3 mt-4">
  <div class="bd-example">
    <nav   aria-label="breadcrumb">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item fw-bolder">
          <a class="nav-link d-inline" href="{{route('dashboard')}}">
            <i class="fa-solid fa-house-chimney"></i>  
          </a>
        </li>
        @yield('path')
        
      </ol>
    </nav>
  </div>
</div>


@section('script')
@endsection


<!--
   
<nav class="p-0 navbar card navbar-main  navbar-expand-lg px-0 shadow-none border-radius-xl m-2 position-sticky  shadow-blur mt-4 left-auto top-1 z-index-sticky"  data-scroll="true" navbar-scroll="true">
  <div class="container-fluid p-md-3 p-2">
    <div class="collapse navbar-collapse mt-sm-0 px-0" id="navbar">
      <ul class="navbar-nav me-auto ms-0 justify-content-end">
       
        <li class="d-xl-none nav-item px-3 d-flex align-items-center">
          <a href="#" class=" p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner nav-list-toggler">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
            <div class="form-check form-switch me-auto p-0">
              <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
            </div>
        </li>
        <li class="dropdown nav-item px-3 d-flex align-items-center">
          <a href="javascript:;" class="" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell cursor-pointer"></i>
          </a>
          <ul class="dropdown-menu  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-1">
                  <div class="my-auto">
                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  ms-3 ">
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <span class="font-weight-bold">New message</span> from Laur
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                      <i class="fa fa-clock me-1"></i>
                      13 minutes ago
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-1">
                  <div class="my-auto">
                    <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  ms-3 ">
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <span class="font-weight-bold">New album</span> by Travis Scott
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                      <i class="fa fa-clock me-1"></i>
                      1 day
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-1">
                  <div class="avatar avatar-sm bg-gradient-secondary  ms-3  my-auto">
                    <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>credit-card</title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(453.000000, 454.000000)">
                              <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                              <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      Payment successfully completed
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                      <i class="fa fa-clock me-1"></i>
                      2 days
                    </p>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
          <a href="{{route('admin.logout')}}" class=" font-weight-bold px-0">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span class="d-sm-inline d-none">الخروج </span>
          </a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<nav aria-label="breadcrumb" class=" ">
  <ul class="breadcrumb bg-transparent m-2 font-weight-bold ">
    <li class="breadcrumb-item fs-6 border-bottom">
      <a class="" href="{{route('dashboard')}}">
        <i class="fa-solid fa-house-chimney"></i>
        <span>لوحة التحكم</span>
      </a>
    </li>
    @yield('path')
  </ul>
</nav>
@section('script')
@endsection

 -->
 
