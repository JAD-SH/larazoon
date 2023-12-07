
<!DOCTYPE html>
<html lang="ar" dir="rtl">

  <head>


    <!-- head -->
    @include('layouts.admin.head')
    @yield('css')
    <!-- head -->
    <style>
      .offcanvas .offcanvas-body ul.sidebar-category li a{
        transition: all .4s;
        border-radius: 10px;
      }
      .offcanvas .offcanvas-body ul.sidebar-category li a:hover{
        background-color: #93939357;
        box-shadow: 0 3px 3px 1px #ffffff20, 0 3px 1px -2px #ffffff20, 0 1px 5px 1px #ffffff20;
      }
    </style>
  </head>

<body class="@isset($_COOKIE['DarkMode']) dark @endisset">
  <input class="custome-scrollbar-y position-fixed d-none d-md-block" type="range" min="0" max="100" value="0" id="">
    
  <div class="progress-scroll-bage-x-line  ">
    <div class="progress-scroll-bage-x bg-gradient-danger "></div>
  </div>

  <div class="scroll-buttons-continer position-fixed text-center">
    <button class="scroll-button scroll-button-top p-2 rounded-5 bg-gradient-primary mx-auto my-2 d-flex justify-content-center align-items-center"><i class="fa-solid fa-angles-up fs-5 text-white fw-bolder"></i></button>
    <button class="scroll-button scroll-button-up p-2 rounded-5 bg-gradient-info mx-auto my-2 d-flex justify-content-center align-items-center"><i class="fa-solid fa-arrow-up fs-5 text-white fw-bolder"></i></button>
    <button class="scroll-button scroll-button-down  p-2 rounded-5 bg-gradient-info mx-auto my-2 d-flex justify-content-center align-items-center"><i class="fa-solid fa-arrow-down fs-5 text-white fw-bolder"></i></button>
  </div>

  <main >
    <div class="container-fluid px-1 px-md-3 pb-2 mb-2">
      
      <!-- sidebar -->
      @include('admin.includes.sidebar')
      <!-- sidebar -->

      <!-- Navbar -->
      @include('admin.includes.navbar')
      <!-- Navbar -->
        
      <!-- content -->
      @yield('content')
      <!-- content -->

      <!-- footer -->
      @include('admin.includes.footer')
      <!-- footer -->

    </div>
  </main>

    
    <!-- notification -->
    @include('admin.includes.alerts.notification-modal')
    <!-- notification -->

    <!-- delete-modal -->
    @include('admin.includes.alerts.delete-modal')
    <!-- delete-modal -->


    
    
    <!--   Core JS Files   -->
    @include('layouts.admin.js')
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
      let all_sidebar_categories = Array.from(document.querySelectorAll('.offcanvas .offcanvas-body ul.sidebar-category li a'));
      @if(Session::has('sidebar-section-id'))
        all_sidebar_categories.forEach(category => {
          $(category).removeClass('bg-gradient-primary');
        });
        $("#{{Session::get('sidebar-section-id')}} a").addClass('bg-gradient-primary');
        $("#{{Session::get('sidebar-section-id')}} a").removeAttr('href');
         @else
         $("#sidebar-dashboard-section a").addClass('bg-gradient-primary');

      @endif
</script>
    <!--   Core JS Files   -->
    


</body>

</html>
