<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
 <!-- head -->
 @section('title','التحقق من البريد الألكتروني ')
 @include('layouts.front.head')
<style>
    .cus-container{
    height: 100vh;
    }
   
</style>
<!-- head -->
    
</head>

<body  class="@isset($_COOKIE['DarkMode']) dark @endisset">
<div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="cus-container mx-2 d-flex align-items-center justify-content-center w-100">
        
                <div class="  card d-flex align-items-center  m-1 m-md-4 p-2 p-md-3 py-0  border-0 rounded-5  shadow-sm mb-3">
                    <div class="fs-3 fw-bolder w-100 pt-3 text-center">التحقق من البريد الألكتروني</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert bg-gradient-success  fs-6" role="alert">
                                قمنا بإرسال رسالة التحقق مرة اخرى ... راجع بريدك الالكتروني {{Auth::user()->email}}
                            </div>
                        @endif
                        <div class="fw-bolder">
                            <p class="mb-0 fs-6"> تبقى خطوة بسيطة قبل اكمال عملية تسجيل الدخول . . . رجاءا قم بتفقد بريدك الألكتروني <span class="text-info">{{Auth::user()->email}}</span> والتاكد من رسالة التحقق .</p>
                            <p class="fs-6"> اذا لم تصل لك رسالة التحقق اعد ارسال الرسالة مرة اخرى.</p>
                        </div>
                        <div class=" text-center">
                            <form class="d-inline-block" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="w-auto btn rounded-3 bg-gradient-primary m-1 w-85  fs-6 position-relative overflow-hidden">أرسل مرة اخرى</button>
                            </form>
                            <a class="btn rounded-3 bg-gradient-info m-1"  href="{{route('Course.index')}}"><i class=" fs-6 fa-solid fa-house-chimney"></i></a>
                            <a class="btn rounded-3 bg-gradient-info m-1 d-block d-md-inline-block"  href="{{route('user.wrong-email')}}">أخطأت بالبريد الألكتروني</a>
                        </div>
                    </div>
                </div>
    </div>
      
  <!--   Core JS Files   -->

  @include('layouts.front.js')

  <!--   Core JS Files   -->
  
</body>

</html>