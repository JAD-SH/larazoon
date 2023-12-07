 


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
 <!-- head -->
 @section('title','اعادة تعيين كلمة المرور ')
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

            <div class=" col-12 col-md-8 col-lg-7 col-xl-6 card d-flex align-items-center  m-1 m-md-4 p-2 p-md-3 py-0  border-0 rounded-5  shadow-sm mb-3">
                <div class="fs-3 fw-bolder w-100 pt-3 text-center">اعادة تعيين Password</div>

                

                <form class="w-100 p-3" role="form" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <label for="email" class="fw-bolder fs-5  my-3" >Email</label>
                    <div class="input-group input-group-outline w-auto">
                        <input type="email" id="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <div class="alert bg-gradient-danger  fs-6 w-100 d-block my-2" role="alert">
                            {{ $message }} 
                        </div>
                    @enderror                  
                    @if (session('status'))
                        <div class="alert bg-gradient-success  fs-6 w-100 d-block my-2" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-center mt-3">
                        <button type="submit" class="w-auto btn rounded-3 bg-gradient-primary m-3 w-85  fs-6 position-relative overflow-hidden">
                        <div class=" glossy"></div>
                        ارسل
                        </button>
                        <a class="btn rounded-3 bg-gradient-info m-1"  href="{{route('Course.index')}}"><i class=" fs-6 fa-solid fa-house-chimney"></i></a>
                    </div>
                
                </form>
                        
            </div>
        </div>
    </div>
      
  <!--   Core JS Files   -->

  @include('layouts.front.js')

  <!--   Core JS Files   -->
  
</body>

</html>
