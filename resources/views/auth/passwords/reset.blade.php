 

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
                  <span class="text-white fw-bolder text-center mt-2 mb-0 p-2 fs-4">كلمة مرور جديدة</span>
                </div>
              </div>

                
              <div class="card-body p-4">
                <form role="form" action="{{ route('password.update') }}" method="post">
                  @csrf
                  <input type="hidden" name="token" value="{{ $token }}">

                  <label for="email" class="fw-bolder fs-6 " >Email</label>
                  <div class="input-group input-group-outline my-3 ">
                    <input type="email" id="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                  </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  <label for="password" class="fw-bolder fs-6 " >كلمة المرور</label>
                  <div class="input-group input-group-outline my-3 ">
                    <input type="password" id="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror"  required autocomplete="new-password">
                  </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  <label for="password_confirmation" class="fw-bolder fs-6 " >تأكيد كلمة المرور</label>
                  <div class="input-group input-group-outline my-3 ">
                    <input type="password" id="password_confirmation"  name="password_confirmation" class="form-control rounded-3 "  required autocomplete="new-password">
                  </div>
                     

                  <div class="text-center">
                    <button type="submit" class="btn rounded-3 bg-gradient-primary m-3  fs-6 position-relative overflow-hidden">
                      <div class=" glossy"></div>
                      الدخول
                    </button>
                    <a class="btn rounded-3 bg-gradient-info m-1"  href="{{route('Course.index')}}"><i class=" fs-6 fa-solid fa-house-chimney"></i></a>
                  </div>
                </form>
                   
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
