
<!DOCTYPE html>
<html lang="en">
<head>
 <!-- head -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('layouts.front.head')
    <link href="{{asset('public/assets/css/error-pages.css')}}" rel="stylesheet" />
<!-- head -->
</head>
<body>
<div class="all-page">

<div class="bubbles">
    <h1 class="fw-bolder fs-1" style="font-size: 10.375rem !important;">@yield('code')</h1>
    <h4 class="text-secondary position-absolute text-center">
        @yield('message')
    </h4>
    <a class="btn bg-gradient-primary btn-block my-0 fs-6" href="{{route('Course.index')}}">
        <i class="fa-solid fa-house-chimney"></i> العودة الى الصفحة الرئيسية
    </a>
    
</div>
</div>

  <!--   Core JS Files   -->
  
  @include('layouts.front.js')

  <!--   Core JS Files   -->
  <script>
let code="@yield('code')";
$( document ).ready(runError(code))

  </script>
</body>
</html>
