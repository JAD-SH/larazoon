<nav class="navbar card  border-0 rounded-5 fixed-top mt-4  position-sticky shadow-sm align-middle " style="top: 1vh; opacity: .95 !important;">
    <div class="container-fluid d-block d-md-flex justify-content-center justify-content-md-between text-nowrap">

      <ul class="navbar-nav p-0  flex-row justify-content-around">
        <li class="d-flex nav-item px-md-2  ">
          <a class="navbar-logo p-0 nav-link fw-bolder text-black d-flex align-items-center" href="{{route('Course.index')}}" aria-label="home">
          <img src="{{Site()->site_logo}}" alt="{{Site()->site_name}}-logo">
          </a>
        </li>
        <li class="d-flex nav-item px-md-3 align-items-center ">
          <button class="fs-4 border-0 bg-transparent " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="bars list">
            <i class="fas fa-bars fs-4"></i>
          </button>
        </li>
       
        <li class="d-flex d-md-none  align-items-center">
          <div class="">
            <input type="checkbox"  class="btn-check dark-mode" id="dark-mode-mobile" @isset($_COOKIE['DarkMode']) checked @endisset>
            <label class="btn bg-gradient-primary rounded-3 p-1 label-mode" id="label-mode" for="dark-mode-mobile" aria-label="dark|light mode">
              @isset($_COOKIE['DarkMode']) 
              <i class="fa-solid fa-sun"></i>
              @else
              <i class="fa-solid fa-moon"></i>
              @endisset
            </label>
        </div>
      </li>
      
      @isset($group_lessons)
      <li class="d-flex  nav-item px-md-2 align-items-center ">
        <button onclick="toogle_navbar()" class="toogler-nav-btn btn bg-gradient-primary rounded-3 p-1" aria-label="show|hide navbar"><i class="fa-solid fa-arrows-up-down text-white fw-bolder"></i></button>
      </li>
      @endisset

      @verify
      <li class="d-flex d-md-none dropdown nav-item align-items-center">
        <div data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
          <i class="fa fa-bell  fs-6 cursor-pointer"></i>
            @if(Auth::user()->notification()->whereHas('notificationreply')->get()->pluck('notificationreply')->flatten()->where('watch','0')->count()  > 0 
              || Auth::user()->questions()->whereHas('comments')->get()->pluck('comments')->flatten()->where('watch','0')->count()  > 0
              || Auth::user()->supports()->where('watch','0')->count() > 0)
                <span class="position-absolute top-0  start-100 translate-middle badge rounded-pill bg-danger text-light p-1" style="line-height: 3px;"> </span>
            @endif
        </div>
      </li>
        <li class="nav-item d-flex d-md-none align-items-center">
          <a href="{{route('user.logout')}}" class="nav-link fw-bold p-0" aria-label="logout">
          <i class="fa-solid fs-6 fa-right-from-bracket"></i>
           </a>
        </li>
        @else
        <li class="nav-item d-flex d-md-none align-items-center">
          <a href="{{route('login')}}" class="nav-link fw-bold p-0" aria-label="login">
          <i class="fa-solid fs-6 fa-right-to-bracket"></i>
           </a>
        </li>
        @endverify
      </ul>


      <ul class="navbar-nav text-center p-0 nav-category ms-0 flex-row d-none @if(MainCategories() !== null) d-md-flex  @endif">
        @if(MainCategories() !== null)
          @foreach(MainCategories() as $category)
            <li class="d-flex nav-item px-3 align-items-center">
              <a href="{{route($category->route.'.index')}}" class="p-0 nav-link fw-bolder text-black">
                <div class="m-0 category-title
                @if(Session::has('categorySLUG'))
                    @if(Session::get('categorySLUG') == $category->slug)
                      text-{{$category->color}}
                    @endif
                @endif" >{{$category->title}}</div>
                <div class="m-0"><i class="m-auto {{$category->icon}}
                @if(Session::has('categorySLUG'))
                    @if(Session::get('categorySLUG') == $category->slug)
                      text-{{$category->color}}
                    @endif
                @endif"></i></div>
              </a>
            </li>
          @endforeach
        @endif
      </ul>

            
      <ul class="navbar-nav p-0 flex-row d-none d-md-flex">
        
        @verify
        <li class="nav-item px-2 px-lg-3 d-flex align-items-center container-fluid ">
          <div class="dropdown position-relative">
            <div class=" position-relative" type="button" data-bs-toggle="dropdown">
              <i class="fa fa-bell fs-6 cursor-pointer"></i>
              @if(Auth::user()->notification()->whereHas('notificationreply')->get()->pluck('notificationreply')->flatten()->where('watch','0')->count()  > 0 
              || Auth::user()->questions()->whereHas('comments')->get()->pluck('comments')->flatten()->where('watch','0')->count()  > 0
              || Auth::user()->supports()->where('watch','0')->count() > 0)
                <span class="position-absolute top-0  start-100 translate-middle badge rounded-pill bg-danger  text-light" style="font-size:10px !important;">
                  {{Auth::user()->notification()->whereHas('notificationreply')->get()->pluck('notificationreply')->flatten()->where('watch','0')->count()
                  + Auth::user()->questions()->whereHas('comments')->get()->pluck('comments')->flatten()->where('watch','0')->count()
                  + Auth::user()->OwnerComments()->where('watch','0')->count()
                  + Auth::user()->supports()->where('watch','0')->count() }} 
                </span>
              @endif
            </div>
            <ul class="dropdown-menu dropdown-menu-dark rounded-5 p-2 position-absolute shadow-sm">
              <li>
                <a href="{{route('profile')}}" class=" btn dropdown-item rounded-5 text-light">
                إجابات اسئلتك
                <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
                {{Auth::user()->questions()->whereHas('comments')->get()->pluck('comments')->flatten()->where('watch','0')->count()}}
                
                </span>
               
                </a>
              </li>
              <li>
                <a  href="{{route('User.supporter-archive',Auth::user()->username)}}" class=" btn dropdown-item rounded-5  text-light">
                  اشعارات سجل الدعم
                  <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
                    {{Auth::user()->supports()->where('watch','0')->count()}}
                  </span>
                </a>
              </li>
              <li>
                <a href="{{route('User.site-media-page')}}" class=" btn dropdown-item rounded-5  text-light">
                ردود الادارة
                <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
                {{Auth::user()->notification()->whereHas('notificationreply')->get()->pluck('notificationreply')->flatten()->where('watch','0')->count()}}
                </span>
               
                </a>
              </li>
              @if(Auth::user()->OwnerComments()->where('watch','0')->count() > 0)
                @foreach(Auth::user()->OwnerComments()->where('watch','0')->get() as $replyForYou)

                  <li>
                    <a href="{{route('Question.show',Auth::user()->questions()->where('id',$replyForYou->question_id)->slug)}}" class=" btn dropdown-item rounded-5 ">
                      رد على تعليقك
                      <span class="d-inline-block bg-gradient-danger rounded" style="width:10px; height:10px; "></span>
                      
                    </a>
                  </li>
                @endforeach
              @else
                <li>
                  <div  class=" btn dropdown-item rounded-5  text-light">
                  رد على تعليقك
                  <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">0</span>
                  </div>
                </li>
              @endif
              
              
            </ul>
          </div>
        </li>
        @endverify

        <li class="nav-item px-3 px-lg-3 d-flex align-items-center">
          <div class="">
            <input type="checkbox"  class="btn-check dark-mode" id="dark-mode" @isset($_COOKIE['DarkMode']) checked @endisset>
            <label class="bg-gradient-primary rounded-3 p-1 label-mode" id="label-mode" for="dark-mode" aria-label="dark|light mode">
            @isset($_COOKIE['DarkMode']) 
            <i class="fa-solid fa-sun"></i>
            @else
            <i class="fa-solid fa-moon"></i>
            @endisset
            </label>
          </div>
        </li>
        @verify
        <li class="nav-item px-2 px-lg-3 d-flex align-items-center">
          <a href="{{route('user.logout')}}" class="nav-link fw-bold px-0">
          <i class="fa-solid fs-6 fa-right-from-bracket"></i>
          <span class="">الخروج </span>
          </a>
        </li>
        @else
        <li class="nav-item px-2 px-lg-3 d-flex align-items-center">
          <a href="{{route('login')}}" class="nav-link fw-bold px-0">
          <i class="fa-solid fs-6 fa-right-to-bracket"></i>
          <span class="">الدخول </span>
          </a>
        </li>
        @endverify
      </ul>
    </div>
</nav>
@verify
  <div class="offcanvas offcanvas-end d-md-none" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasRightLabel">الأشعارات</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body py-0">
      <ul class="mx-2 p-2">
        <li>
          <a href="{{route('profile')}}" class="btn">
          إجابات اسئلتك
          <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
          {{Auth::user()->questions()->whereHas('comments')->get()->pluck('comments')->flatten()->where('watch','0')->count()}}
          </span>
          </a>
        </li>
        <li>
          <a  href="{{route('User.supporter-archive',Auth::user()->username)}}" class=" btn ">
            اشعارات سجل الدعم
            <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
              {{Auth::user()->supports()->where('watch','0')->count()}}
            </span>
          </a>
        </li>
        <li>
          <a href="{{route('User.site-media-page')}}" class=" btn ">
            ردود الادارة
            <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">
              {{Auth::user()->notification()->whereHas('notificationreply')->get()->pluck('notificationreply')->flatten()->where('watch','0')->count()}}
            </span>
          </a>
        </li>
        @if(Auth::user()->OwnerComments()->where('watch','0')->count() > 0)
          @foreach(Auth::user()->OwnerComments()->where('watch','0')->get() as $replyForYou)

            <li>
              <a href="{{route('Question.show',Auth::user()->questions()->where('id',$replyForYou->question_id)->slug)}}" class=" btn">
                رد على تعليقك
                <span class="d-inline-block bg-gradient-danger rounded" style="width:10px; height:10px; "></span>
              </a>
            </li>
          @endforeach
        @else
          <li>
            <div class="btn">
              رد على تعليقك
              <span class=" translate-middle rounded-pill bg-danger bg-gradient-danger text-white p-1 px-2 mx-1" style="font-size:10px !important;">0</span>
            </div>
          </li>
        @endif
      </ul>
    </div>
  </div>
@endverify
<div data-sos-once="true" data-sos="sos-top" class="bd-example-snippet bd-code-snippet m-3 mt-4">
  <div class="bd-example">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item fw-bolder">
          <a class="nav-link d-inline" href="{{route('Course.index')}}" aria-label="home">
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