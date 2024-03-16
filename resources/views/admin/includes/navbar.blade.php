



<nav class="navbar card  border-0 rounded-5 fixed-top mt-4 flex-row position-sticky shadow-sm align-middle justify-content-center justify-content-sm-between p-2" style="top: 1vh; flex-flow: nowrap;">

<ul class="navbar-nav p-0 flex-row">
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
  
</ul>
  <ul class="navbar-nav p-0 flex-row">
<li class=" nav-item px-3 d-flex align-items-center position-relative">
@if(Asks()->count() > 0 || Messages()->count() > 0) 
<span class=" bg-gradient-danger rounded position-absolute" style="width:10px; height:10px; top:0; right:0;"></span> 
@endif
<div class="dropdown ">
<a class="p-0 nav-link fw-bolder text-black" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fa fa-bell cursor-pointer"></i>
</a>
<ul class="dropdown-menu dropdown-menu-dark rounded-5 p-2 position-absolute shadow-sm">
  <li>
    <button class="dropdown-item rounded-5 text-light " type="button">
      طلبات الخدمات
      <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
        null
      </span>
    </button>
  </li>
  <li>
    @if(Asks() !== null) 
      <a class="dropdown-item rounded-5 text-light " href="{{route('Notification-dashboard')}}">
        الاسئلة
        <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
          {{Asks()->count()}}
        </span>
      </a>
    @else
      <button class="dropdown-item rounded-5 text-light " type="button">
        الاسئلة
        <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
          0
        </span>
      </button>
    @endif
  </li>
  <li>
    @if(Messages() !== null)
      <a class="dropdown-item rounded-5 text-light " href="{{route('Notification-dashboard')}}">
        الابلاغات والرسائل  
        <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
        {{Messages()->count()}}
        </span>
      </a>
    @else
      <button class="dropdown-item rounded-5 text-light " type="button">
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

<li class=" nav-item px-3 d-flex align-items-center">
@if(Supporters()->where('verification',null)->count() > 0 ) 
<span class=" bg-gradient-danger rounded position-absolute" style="width:10px; height:10px; top:0; right:0;"></span> 
@endif
<a class="p-0 nav-link fw-bolder text-black   " href="{{route('Supporter-dashboard.index')}}">
<i class="fa-solid fa-dollar fs-5"></i>
</a>
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
<span class="d-none d-md-inline-block">الخروج </span>
</a>
</li>
</ul>


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

