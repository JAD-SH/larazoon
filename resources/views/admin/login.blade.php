<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

<!DOCTYPE html>
<html lang="en">

<head>
  
 #section('title','تسجيل دخول الادمن')
 #include('layouts.admin.head')


</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      
        
       
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 p-2">Are you admin ?</h4>
                </div>
              </div>

                
              <div class="card-body">
                <form role="form" class="text-start"  action="{route('admin.login')}" method="post">
                #csrf
                  <div class="input-group input-group-outline my-3 ">
                    <label class=" col-12">Email</label>
                    <input type="email" name="email" class="form-control"
                    #if(Cookie::has('email')) value="{Cookie::get('email')}" #endif>
                  </div>
                  <div class="input-group input-group-outline mb-3 ">
                    <label class="col-12">Password</label>
                    <input type="password" name="password" class="form-control"
                    #if(Cookie::has('password')) value="{Cookie::get('password')}" #endif>
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" name="remember_me" type="checkbox" id="rememberMe" 
                    #if(Cookie::has('email')) checked #endif>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    <a href="#" class="text-primary text-gradient font-weight-bold bg-dark">Forget Passowrd</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  #include('layouts.admin.js')

  
</body>

</html>
-->



<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
 <!-- head -->
 @section('title','تسجيل دخول الادمن')
 @include('layouts.admin.head')
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
          <div class="col-lg-4 col-md-6 col-10 mx-auto card border-0 justify-content-center rounded-5 shadow-sm pb-4">
              <div class=" mt-n4 mx-3">
                <div class="bg-gradient-primary shadow-primary rounded-5 py-4 pe-1 text-center">
                  <span class="text-white fw-bolder text-center mt-2 mb-0 p-2 fs-5"> ? Are you admin</span>
                </div>
              </div>

                
              <div class="card-body p-4">
                <form role="form" action="{{route('admin.login')}}" method="post">
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
                  <p class="text-sm text-center">
                    <a href="#" class="text-primary text-gradient fw-bold ">نسيت كلمة المرور</a>
                  </p>
                </form>
              </div>
          </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->

  @include('layouts.admin.js')

  <!--   Core JS Files   -->
  
</body>

</html>