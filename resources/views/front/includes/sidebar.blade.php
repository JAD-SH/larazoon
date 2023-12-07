
<div @if(!isset($group_lessons)) style="width:300px;" @endif class="@isset($group_lessons) col-11 col-md-6 col-lg-4 col-xl-3 @endisset card offcanvas offcanvas-start rounded-5 m-3 p-3 shadow-sm" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
  <div class="offcanvas-header p-0">
    <div class="offcanvas-title w-100 text-center">
      <a class="navbar-logo w-100 fs-5 fw-bold  py-3 " href="{{route('Course.index')}}">{{Site()->site_name}}
           <img src="{{Site()->site_logo}}" alt="">
      </a>
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <hr class="horizontal dark my-2">



  
@isset($group_lessons)
  <div class="offcanvas-body p-0">
    <ul class="navbar-nav sidebar-category flex-grow-1 ">

      @foreach($group_lessons as $group)
        <li class="  my-1 py-1 px-2 border-bottom border-1 fs-4 fw-bolder text-{{$group->course->color}}">{{$group->title}}</li>
        @foreach($group->lessons as $index=>$one_lesson)
          <li class="nav-item sidebar-lessons m-1 rounded-3 " @if( $one_lesson->id === $lesson->id || $one_lesson->id === $lesson->lesson_id) style="background-color: #93939357 !important;" @endif>
          
             <a class="d-block w-100 p-1 pe-0" href="{{route('show-lesson',[$group->course->slug,$one_lesson->slug])}}">
              <span class="  fs-5 fw-bold  ">{{$one_lesson->title}} </span> <span class=" float-start fs-5 fw-bold  text-{{$group->course->color}}">{{$group->course->slug}}-</span>
              <div class="float-end  d-flex" style=" border-radius:50%;">
                @verify
                  <form  action="{{route('studied-lesson',$one_lesson->id)}}" method="POST">
                    @csrf
                    <div class="form-check form-switch d-inline-block p-0 m-0">
                      <input id="radio-save-lesson-{{$one_lesson->id}}" class="form-check-input ajax-submit radio-save-lesson" type="checkbox" role="switch" 
                      @if( Auth::user()->lessons()->where('lesson_id',$one_lesson->id)->first() !== null)
                        @if(Auth::user()->lessons()->where('lesson_id',$one_lesson->id)->first()->watch == 1)
                          checked
                        @endif
                      @endif>
                    </div>
                  </form>
                @else
                  <div class="form-check form-switch d-inline-block p-0 m-0">
                    <input  class="form-check-input radio-save-lesson-disabled opacity-50" type="checkbox" role="switch"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="سجل الدخول لتتمكن من حفظ تقدمك في الدروس">
                  </div>
                @endverify
              </div>
            </a>
            
          </li>
        @endforeach
      @endforeach

    </ul>
  </div>
  <hr class="horizontal dark">
  <ul class="navbar-nav sidebar-category sidenav-footer">
    <li class="nav-item  pt-2">
      @verify
        @if(Auth::user()->courses->where('id',$group_lessons[0]->course->id)->first() !== null )
        <span class="btn rounded-3 bg-gradient-primary  py-3 w-100 fs-6 fw-bold mb-1 text-light">
          انت متابع للكورس <i class="fa-solid fa-feather-pointed"></i>
        </span>
        @else
          <form class="d-inline user_active" action="{{route('User.follow-course', $group_lessons[0]->course->id)}}" method="POST">
            @csrf
            <a  class="btn rounded-3 bg-gradient-primary  py-3 w-100 fs-6 fw-bold mb-1 text-light ajax-submit" type="button" >
              تابع الكورس<i class="fa-solid fa-feather-pointed"></i>
            </a>
          </form>
        @endif
        
      @else
      
        <button type="button" class="btn rounded-3 bg-gradient-primary  py-3 w-100 fs-6 fw-bold mb-1 text-light" data-bs-toggle="modal" data-bs-target="#exampleModalSignUp">
          تابع الكورس <i class="fa-solid fa-feather-pointed"></i>
        </button>
      
      @endverify
    </li>
  </ul>
@else
  <div class="offcanvas-body p-0">
    <ul class="navbar-nav sidebar-category flex-grow-1 ">
      

      @if(MainCategories() !== null)
        @foreach(MainCategories() as $category)
        <li class="nav-item rounded-4 sidebar-maincategories my-1" >
          <a class=" fs-6 fw-bold w-100 d-inline-block py-2 ps-1" 
          
          @if(Session::has('categorySLUG'))
              @if(Session::get('categorySLUG') == $category->slug)
                  style="background-color: #93939357 !important;"
              @else
                  href="{{route($category->route.'.index')}}"
              @endif
          @else
              href="{{route($category->route.'.index')}}"
          @endif >
            <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
              <i class="m-auto {{$category->icon}} text-{{$category->color}}"></i>
            </div>
            <span class=" me-1  ">{{$category->title}}</span>
          </a>
        </li>
        @endforeach
      @endif

      @if(SubCategories()->count() > 0)
       
        @foreach(SubCategories() as $category)
        <li class="nav-item rounded-4 sidebar-maincategories my-1"
        @if(Session::has('categorySLUG'))
            @if(Session::get('categorySLUG') == $category->slug)
                style="background-color: #93939357 !important;"
            @endif
        @endif >
          <a class=" fs-6 fw-bold  w-100 d-inline-block py-2 ps-1" href="{{route('show-Subcategory',$category->slug)}}">
            <div class=" text-center mx-2 d-inline-block align-items-center justify-content-center">
              <i class="m-auto {{$category->icon}} text-{{$category->color}}"></i>
            </div>
            <span class=" me-1   ">{{$category->title}}</span>
          </a>
        </li>
        @endforeach
      @endif
    </ul>
  </div>

  @if(MainCategories() !== null)
    <hr class="horizontal dark">
    <ul class="navbar-nav sidebar-category sidenav-footer">

      @verify
        <li class=" nav-item  pt-2">
          <a class="btn rounded-3 bg-gradient-warning  py-3 w-100 fs-6 fw-bold mb-1 text-light" href="{{route('profile')}}">
            <span class=" me-1  text-light">ملفي الشخصي</span>
            <i class="fa-solid fa-address-card "></i>
          </a>
        </li>
        <li class="nav-item  pt-2">
          @if(Auth::user()->plan !== null)
            <button type="button" class="btn rounded-3 bg-gradient-dark  py-3 w-100 fs-6 fw-bold mb-1 text-light" >
              تتابع الخطة <span class="text-light">_{{ Auth::user()->plan->title }}_</span>
            </button>

          @else
            <!-- Button trigger modal -->
            <button type="button" class="btn rounded-3 bg-gradient-primary  py-3 w-100 fs-6 fw-bold mb-1 text-light" 
            data-bs-toggle="modal" data-bs-target="#FollowPlanNotification">
              تابع خطة التعلم <i class="fa-solid fa-feather-pointed"></i>
            </button>


          @endif
        </li>
      @else
        <li class="nav-item  pt-2">

        <button type="button" class="btn rounded-3 bg-gradient-primary  py-3 w-100 fs-6 fw-bold mb-1 text-light" 
            data-bs-toggle="modal" data-bs-target="#FollowPlanNotification">
              تابع خطة التعلم <i class="fa-solid fa-feather-pointed"></i>
            </button>
        </li>
      @endverify
    </ul>
  @endif

@endisset


</div>

@section('script')

@endsection
