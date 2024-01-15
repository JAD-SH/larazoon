<script src="{{asset('public/assets/js/core/jquery.js')}}"></script>
<script src="{{asset('public/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('public/assets/js/core/bootstrap.min.js')}}"></script>
 
<script>
  $(".card").hover(
    function(){
      $(this).removeClass("shadow-sm");
      $(this).addClass("shadow");
    },
    function(){
      $(this).removeClass("shadow");
      $(this).addClass("shadow-sm");
    }
  );
</script>

@if(Session::has('notifyType'))
  <script>
    $( document ).ready(function() {
      let toastType="{{Session::get('notifyType')}}";
      let toastTrigger = document.getElementById(`${toastType}`);
      if (toastTrigger) {
        let toast = new bootstrap.Toast(toastTrigger);
        toast.show();
      }
    });
  </script>
@endif

@if(MainCategories() !== null)
  <script>
      
    function toogle_navbar(){
      $('.navbar').toggleClass('off-navbar');
      $('.scroll-buttons-continer').toggleClass('off-scroll-buttons');
    }

    //############# start nav_categories  ##################  
      const nav_categories = document.querySelectorAll(".nav-category li"),
        nav_category_name = document.querySelectorAll(".nav-category li a .category-title"),
        nav_icons = document.querySelectorAll(".nav-category li a i"),
        MainCategories_color = [];

      @foreach(MainCategories() as $category)
        MainCategories_color.push("{{$category->color}}");
      @endforeach

      for (let i = 0; nav_categories[i] ; i++) {
        $(nav_categories[i]).hover(
          function(){
            nav_category_name[i].classList.add("text-"+MainCategories_color[i]);
            nav_icons[i].classList.add("text-"+MainCategories_color[i]);
          },
          function(){
            nav_category_name[i].classList.remove("text-"+MainCategories_color[i]);
            nav_icons[i].classList.remove("text-"+MainCategories_color[i]);
          }
        )
      }
    //############# end nav_categories  ##################  
  </script>
@endif

<script>
  
  /*#### start ajax_search ####*/
    //في المستقبل اذا اردت ان تعمل بحث عبر ajax بدون اعاجة تحميل الصفحة فهذا الكود سينفعك
    function ajax_search(){
      $(document).on( "click", ".ajax-search", function(e) {
          
          e.preventDefault();
          let this_button=$(this);
          let url=$(this_button).attr('href');
          $.ajax({
              url: url,
              type: 'GET',
              data: {},
              processData: false,
              contentType: false,
              cache: false,
              success:function(data) {
                  $('.content').html(data);
                  $("nav[role='navigation']").css('display','none');
              },
              error:function(reject) {
                
              },
              beforeSend:function() {
              }
          });
      });
    }
  /*#### end ajax_search ####*/

  /*############# start ajax action ################*/
    ajax_function();
    function ajax_function(){
      $(document).on( "click", ".ajax-submit", function(e) {
        if($(this).is("[type='checkbox']"))
        {}
        else
          e.preventDefault();
        let this_button=$(this);
        let form =  this_button.closest('form');
        let formActionUrl = form.attr('action');
        let type = form.attr('method');
        
        let formData=new FormData($(form)[0]);
        $.ajax({
            
            url: formActionUrl,
            type: type,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success:function(data) {
                ajax_success_view(data,this_button);
            },
            error:function(reject) {
              var response=$.parseJSON(reject.responseText);
                  $.each(response.errors, function(key, val){
                      $('#' + key + '_error').fadeIn(500).text(val[0]);
                      
                  });
            },
            beforeSend:function() {
            }
        });
      });
    }
    function ajax_success_view(data,submut_btn){

      $("button[aria-label='Close']").click();
      let toastType=data.notifyType;
      let notify_title = document.querySelector(`#${toastType} div strong`);
      let notify_msg = document.querySelector(`#${toastType} div.toast-body`);
      
      notify_title.textContent=data.notifyTitle;
      notify_msg.textContent=data.notifyMsg;
      
      let toastTrigger = document.getElementById(`${toastType}`);
      if (toastTrigger) {
        let toast = new bootstrap.Toast(toastTrigger);
        toast.show();
      }

      if(data.item_id != 0){
          $("#item-"+data.item_id).remove();
      }
      
      if(data.correctAnswers){
          show_correct_answers(data.correctAnswers);
      }
      
      let error_alert = Array.from($('div[id$="_error"]'));
      if(error_alert.length > 0){
        
        error_alert.forEach(element => {
          $(element).fadeOut(200);
        });
      }

      if(data.site_notification == 1){
        $(submut_btn).removeClass("btn-outline-info text-info");
        $(submut_btn).addClass("bg-gradient-info text-white");
        $(submut_btn).text("استقبال الاشعارات");
      }else if(data.site_notification == 0){  
        $(submut_btn).removeClass("bg-gradient-info text-white");
        $(submut_btn).addClass("btn-outline-info text-info");
        $(submut_btn).text("حظر الاشعارات");
      }
    }
  /*############# end ajax action ################*/

  function add_glossy(){
    $("button,a.btn,input[type='button']").hover(function(){
      $(this).addClass("glossyBtn");
    }, function(){
      $(this).removeClass("glossyBtn");
    });
  }

  let create_message_btns = document.querySelectorAll(".create-message");
  let create_message_form = document.querySelector(".create-message-form input[name='type']");
  create_message_btns.forEach(btn => {
    btn.onclick=function(){
      $(create_message_form).attr('value',$(this).attr('data-type'))
    }
  }); 
  
</script>

<!-- 

هذا الكود من اجل زيادة الحماية يجب تفعيله عند رفع الموقع على السيرفر

<script>
  
  document.oncontextmenu = document.body.oncontextmenu = function() {return false;}

  document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 83 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            alert('غير مسموح');
            return false;
        }
        else if (e.keyCode === 123){
            alert('غير مسموح');
            return false;
        } else if (e.ctrlKey && e.shiftKey && (e.keyCode === 73)) {
            alert('غير مسموح');
            return false;
        } else {
            return true;
        }
  };
  
</script>

-->

<script>

  darkMode();
  function darkMode(){
    let toggle_mode = document.querySelectorAll(".dark-mode");
    let label_mode = document.querySelectorAll(".label-mode i");
    let bodyEl = document.querySelector("body");
    let darkMode = false;

    toggle_mode.forEach(toggle_mode_element => {
      toggle_mode_element.addEventListener('change', (event) => {
        darkMode = event.target.checked;
        label=$(toggle_mode_element).siblings('label');
        if(darkMode) {
          label_mode.forEach(element => {
            element.classList.remove('fa-moon');
            element.classList.add('fa-sun');
          });
          bodyEl.classList.add("dark");
          Dark_Light_Cookie('DarkMode',true,1);
          page_header_photo("dark");
        } else {
          label_mode.forEach(element => {
            element.classList.add('fa-moon');
            element.classList.remove('fa-sun');
          });
          bodyEl.classList.remove("dark");
          Dark_Light_Cookie('DarkMode',false,0);
          page_header_photo("light");
        }
      })
    }); 
  }

  function page_header_photo(status){
    let header_photo = document.querySelector(".page-header-photo");
    if(header_photo){
      if(status === "light"){
      $(header_photo).css({
        "background-image": `url(${header_photo.getAttribute('light-photo-data')})`
      })
      }else{
        if(header_photo.getAttribute('dark-photo-data') != ""){
          $(header_photo).css({
            "background-image": `url(${header_photo.getAttribute('dark-photo-data')})`
          })
        }
      }
    }
  }

  function Dark_Light_Cookie(cname, cvalue, exdays){
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

/*################# start scrolling-button ##########################*/
  $( window ).scroll(function() {
    let scroll_max=document.body.offsetHeight - window.innerHeight +30;
    let scroll_value=$(document).scrollTop();
    let persent_value=Math.ceil((scroll_value*100)/scroll_max);
    $('.progress-scroll-bage-x').css('width', `${persent_value}%` );
   });
  $('.scroll-button-top').click(function(){
    $(document).scrollTop(0);
  });
  $('.scroll-button-up').click(function(){
    let scroll_now=$(document).scrollTop()-($(window).height()/1.8);
    $(document).scrollTop(scroll_now);
  });
  $('.scroll-button-up').dblclick(function(){
    let scroll_now=$(document).scrollTop()-($(window).height()*1.5);
    $(document).scrollTop(scroll_now);
  });
  $('.scroll-button-down').click(function(){
    let scroll_now=$(document).scrollTop()+($(window).height()/1.8);
    $(document).scrollTop(scroll_now);
  });
  $('.scroll-button-down').dblclick(function(){
    let scroll_now=$(document).scrollTop()+($(window).height()*1.5);
    $(document).scrollTop(scroll_now);
  });
/*################# end scrolling-button ##########################*/

  function delete_buttons(){
    let delete_buttons = document.querySelectorAll(".delete");

    for (let i = 0; delete_buttons[i] ; i++) {
        delete_buttons[i].onclick=function(){
            let action=$(delete_buttons[i]).attr('action');
            $(".delete-form-notification").attr("action",action);
        }
    }
  }

  $(document).ready(function(){
    add_glossy();
    $('*').removeClass("placeholder");
  });

/*######################## start OnOnline --- OnOffline###########################*/
  document.getElementsByTagName("BODY")[0].onoffline = function(){
    $('.online').hide();
    $('.offline').show();
  };
  document.getElementsByTagName("BODY")[0].ononline = function(){
    $('.offline').hide();
    $('.online').show();
    setInterval(function(){$('.online').hide();}, 10000);
  };
/*######################## end OnOnline --- OnOffline###########################*/

/*################## start animation on scroll####################*/
  SOSFunction();
  function SOSFunction(){

    let sos_slide = document.querySelectorAll('*[data-sos]');
    if(sos_slide.length > 0){
      
      const slideOnScrollObserver_options = {
        //rootMargin:'-50px',
        //threshold:0.15,
      };
      const slideOnScrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          entry.target.classList.toggle(entry.target.getAttribute('data-sos') ,entry.isIntersecting);
          if(entry.target.getAttribute('data-sos-once') == 'true' ){
            if(entry.isIntersecting){
              slideOnScrollObserver.unobserve(entry.target);
            }
          }
            
        });
      },slideOnScrollObserver_options);
      
      sos_slide.forEach(ele => {
        slideOnScrollObserver.observe(ele);
      });
    }
  }

  COSFunction();
  function COSFunction() {
    let cos_slide = document.querySelectorAll('*[data-cos]');
    if(cos_slide.length > 0){
      const slideOnScrollObserver_options = {
        //rootMargin:'-50px',
        //threshold:0.15,
      };
      let Time = 1000 / 60,
      totFrms = Math.round( 2000 / Time );
      
      const slideOnScrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          countUp(entry.target ,Time ,totFrms);
          if(entry.isIntersecting){
            slideOnScrollObserver.unobserve(entry.target);
          }
            
        });
      },slideOnScrollObserver_options);
      
      cos_slide.forEach(ele => {
        slideOnScrollObserver.observe(ele);
      });
    }
  };
  function countUp(ele ,Time ,totFrms){
    let frame = 0,
      countTo = parseInt( $(ele).attr('data-cos'), 10 ),
      counter = setInterval( () => {
        frame++;
        let progress =  (frame / totFrms)*(2-(frame / totFrms)),
        currentCount = Math.round( countTo * progress );

        if ( parseInt( ele.innerHTML, 10 ) !== currentCount ) {
          ele.innerHTML = currentCount;
        }

        if ( frame === totFrms ) {
          clearInterval( counter );
        }
      }, Time );
  }
/*################## end animation on scroll######################*/

/**###### start Enable tooltips ####### */
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
/**###### end Enable tooltips ####### */

</script>