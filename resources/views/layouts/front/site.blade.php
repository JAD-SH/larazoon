
<!DOCTYPE html>
<html lang="ar" dir="rtl">

  <head>


    <!-- head -->
    @include('layouts.front.head')
    @yield('css')
    <!-- head -->
    
    
    
    <style>
      
      </style>
  </head>
  
  <body class="@isset($_COOKIE['DarkMode']) dark @endisset placeholder-glow">
   

    <div data-sos-once="true" data-sos="sos-top" class="progress-scroll-bage-x-line">
      <div class="progress-scroll-bage-x bg-gradient-danger overflow-hidden">
        <div class=" glossy"></div>
      </div>
    </div>
    
    <div class="scroll-buttons-continer position-fixed text-center">
      <button data-sos-once="true" data-sos="sos-left" style="animation-duration: 1.6s;" class="scroll-button scroll-button-top p-2 rounded-5 bg-gradient-dark mx-auto my-2 d-flex justify-content-center align-items-center" aria-label="go to top"><i class="fa-solid fa-angles-up fs-5 text-white fw-bolder"></i></button>
      <button data-sos-once="true" data-sos="sos-left" style="animation-duration: 1.3s;" class="d-none d-lg-block scroll-button scroll-button-up p-2 rounded-5 bg-gradient-dark mx-auto my-2 d-flex justify-content-center align-items-center" aria-label="step tp up"><i class="fa fa-angle-up fs-5 text-white fw-bolder"></i></button>
      <button data-sos-once="true" data-sos="sos-left" style="animation-duration: 1s;" class="d-none d-lg-block scroll-button scroll-button-down  p-2 rounded-5 bg-gradient-dark mx-auto my-2 d-flex justify-content-center align-items-center" aria-label="step tp down"><i class="fa fa-angle-down fs-5 text-white fw-bolder"></i></button>
    </div>

    <main >
      <div class="container-fluid  px-1 px-md-3 ">
        
        <!-- sidebar -->
        @include('front.includes.sidebar')
        <!-- sidebar -->

        <!-- Navbar -->
        @include('front.includes.navbar')
        <!-- Navbar -->
        <div class="all-content overflow-hidden">
          <!-- content -->
          @yield('content')
          <!-- content -->
        </div>

        <!-- footer -->
        @include('front.includes.footer')
        <!-- footer -->

      </div>
    </main>

    <!-- notification -->
    @include('front.includes.alerts.notification-modal')
    <!-- notification -->

    @verify
      <!-- plan-modal -->
      @include('front.includes.alerts.follow-plan-modal')
      <!-- plan-modal -->
    @else
      <!-- plan-modal -->
      @include('front.includes.alerts.follow-plan-modal')
      <!-- plan-modal -->
      <!-- login-modal -->
      @include('front.includes.alerts.login-modal')
      <!-- login-modal -->
    @endverify
    
    
    <!--   Core JS Files   -->
    @include('layouts.front.js')
    @yield('script')

    <script>
      $("input[type=range]").on('click',function(e){
        $(document).scrollTop(($(document).height()-$(window).height())*(Math.ceil(((e.pageX*100)/$(window).width()))/100));
      });
      $("input[type=range]").bind({
        mousedown:function(){
          $('html').css('scroll-behavior','unset');
          $("input[type=range]").on('mousemove',function(e){
            $(document).scrollTop(($(document).height()-$(window).height())*(Math.ceil(((e.pageX*100)/$(window).width()))/100));
          }) 
        },
        mouseup:function(){
          $('html').css('scroll-behavior','smooth');
          $(this).unbind('mousemove')
        }
        
      });
      
      
/*
      var i = 0, timeOut = 0;
  
      $('.scroll-button-up').on('mousedown mousemove', function(e) {
        //$(this).addClass('active');
        timeOut = setInterval(function(){
          let scrasasaow=$(document).scrollTop();
          $(document).scrollTop(scrasasaow-500);
          //console.log(i++);
        }, 100);
      }).bind('mouseup mouseleave touchend', function() {
        $(".scroll-button-up").unbind("click");
        //$(this).removeClass('active');
        clearInterval(timeOut);
      });*/
    </script>
    <!--   Core JS Files   -->
    
  </body>

</html>
