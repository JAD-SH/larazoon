<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
 <!-- head -->
 @section('title','تسجيل الدخول ')
 @include('layouts.front.head')
<style>
  .glossy{
    width:200%;
    height: 30px;
    position: absolute;
    filter: blur(7px);
    background-color: #ffffffa1;
    z-index: 2;
    transform: rotateZ(45deg);
    top:100%;
    left:-110%;
    animation-name: AGlossy;
    animation-duration: 2s;
    animation-delay: 0s;
    animation-iteration-count: infinite;
  }
  @keyframes AGlossy {
    from {top:100%;left:-110%;}
    to {top:-110%;left:100%;}
  }
  .page-header {
    padding: 0;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    background-size: cover;
    background-position: 50%;
  }
</style>
<!-- head -->
</head>

<body  class="@isset($_COOKIE['DarkMode']) dark @endisset">
  
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
          <div class="col-xl-4 col-lg-5 col-md-6 col-12 mx-auto card border-0 justify-content-center rounded-5 shadow-sm pb-4">
              <div class=" mt-n4 mx-3">
                <div class="bg-gradient-primary shadow-primary rounded-5 py-3 pe-1 text-center">
                  <span class="text-white fw-bolder text-center mt-2 mb-0 p-2 fs-4">تسجيل الدخول</span>
                </div>
              </div>
              <div class="card-body p-4">
                @if(count($errors) > 0)
                  @foreach( $errors->all() as $message )
                    <div class="alert alert-danger display-hide" style="border-right: 5px solid #ff8585;">
                      <span>عنوان البريد الألكتروني أو كلمة المرور غير صحيحية !!!</span>
                    </div>
                  @endforeach
                @endif
                <form role="form" action="{{route('login')}}" method="post">
                  @csrf
                  <label for="email" class="fw-bolder fs-6 " >البريد الالكتروني</label>
                  <div class="input-group input-group-outline my-3 ">
                    <input type="email" id="email" name="email" class="form-control rounded-3" 
                    @if(Cookie::has('email')) value="{{Cookie::get('email')}}" @endif>
                  </div>
                  
                  <label for="password" class="fw-bolder fs-6 " >كلمة المرور</label>
                  <div class="input-group input-group-outline my-3 ">
                    <input type="password" id="password" name="password" class="form-control rounded-3"
                    @if(Cookie::has('password')) value="{{Cookie::get('password')}}" @endif>
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input me-3" name="remember_me" type="checkbox" id="rememberMe" 
                    @if(Cookie::has('email')) checked @endif>
                    <label class="fw-bolder fs-6 " for="rememberMe">تذكرني</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn rounded-3 bg-gradient-primary m-3 w-85  fs-6 position-relative overflow-hidden">
                      <div class=" glossy"></div>
                      الدخول
                    </button>
                  </div>
                </form>
                  <p class="text-sm text-center">
                    @if (Route::has('password.request'))
                      <a href="{{ route('password.request') }}" class="btn btn-light  fw-bolder  fs-6 ">نسيت كلمة المرور</a>
                    @endif
                    <a href="{{route('register')}}" class="btn btn-light  fw-bolder  fs-6 d-inline-flex justify-content-center align-items-center"><i class="fs-5 fa-sharp fa-solid fa-plus text-dark mx-1" style="color:#fa5790 !important;"></i> حساب جديد </a>
                  </p>
              </div>
          </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  @include('layouts.front.js')
  <!--   Core JS Files   -->
  
</body>

</html>