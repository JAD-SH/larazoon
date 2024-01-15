<script src="{{asset('public/assets/js/core/jquery.js')}}"></script>
<script src="{{asset('public/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('public/assets/js/core/bootstrap.min.js')}}"></script>

<!-- 
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
-->


 
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


<!-- syntax code -->
<script src="{{asset('public/assets/prism/prism.js')}}"></script>
<!-- syntax code -->

@if(Session::has('notifyType'))
  <script>

    $( document ).ready(function() {
      
      let toastType="{{Session::get('notifyType')}}";
      let toastTrigger = document.getElementById(`${toastType}`);
      if (toastTrigger) {
        let toast = new bootstrap.Toast(toastTrigger);
        toast.show();
      }


      // let btn="{{Session::get('notifyType')}}";
      // $(`#${btn}`).click();

      function checkFunction(itemclass) {
        let items = document.querySelectorAll(`.${itemclass} li div`);
        let arrayItems=[...items];

        arrayItems.forEach(item => {
          item.querySelector("input[type='checkbox']").checked = false;
          if(item.classList.contains("active")){
            item.querySelector("input[type='checkbox']").checked = true;
          }

        });
      }
    });
  </script>
@endif

@if(MainCategories() !== null)
<script>
    
  //############# start nav_categories  ##################  
  const nav_categories = document.querySelectorAll(".nav-category li");
  const nav_category_name = document.querySelectorAll(".nav-category li a #category-title");
  const nav_icons = document.querySelectorAll(".nav-category li a i");


  const color = [];

  @foreach(MainCategories() as $category)
    color.push("{{$category->color}}");
  @endforeach

  for (let i = 0; nav_categories[i] ; i++) {
    
    $(nav_categories[i]).hover(
      function(){
        nav_category_name[i].classList.add("text-"+color[i]);
        nav_icons[i].classList.add("text-"+color[i],"nav-category-icon");
      },
      function(){
        nav_category_name[i].classList.remove("text-"+color[i]);
        nav_icons[i].classList.remove("text-"+color[i],"nav-category-icon");
      }
    )
      
  }

  //############# end nav_categories  ##################  

</script>
@endif

<script>

  const sidebar_categories = document.querySelectorAll(".sidebar-category li");
  //const sidebar_category_name = document.querySelectorAll(".sidebar-category li a #category-title");
  const sidebar_icons = document.querySelectorAll(".sidebar-category li a i");

  //console.log(category);


  for (let i = 0; sidebar_categories[i] ; i++) {
    
    $(sidebar_categories[i]).hover(
      function(){
        sidebar_icons[i].classList.add("sidebar-category-icon");
      },
      function(){
        sidebar_icons[i].classList.remove("sidebar-category-icon");
      }
    )
      
  }

</script>

@isset($course_lessons)
  <script>
    ///          this is style for constant bage
    function style_function(page_color){

      const sube_title = document.querySelector(".sube-title");
      sube_title.classList.add('card-header','m-3','mt-0','p-3','font-weight-bolder','text-center','fs-4')

      const image = document.querySelectorAll("img.site-src");
      for (let i = 0; image[i] ; i++) {
          
          let oldSrc=$(image[i]).attr('src');
          
          $(image[i]).attr('src',`{{asset('${oldSrc}')}}`);
          
      }

      const link = document.querySelectorAll("a.site-href");
      for (let i = 0; link[i] ; i++) {

      let oldHref=$(link[i]).attr('href');

      $(link[i]).attr('href',`{{asset('${oldHref}')}}`);

      }

      const img_style_1 = document.querySelectorAll(".img-style-1");
      for (let i = 0; img_style_1[i] ; i++) {
          
          img_style_1[i].classList.add('img-fluid','shadow','border-radius-xl','w-lg-50','w-md-75','w-sm-100','clk-img');
          
      }

      const ul_path = document.querySelectorAll(".ul-path");
      for (let i = 0; ul_path[i] ; i++) {
          
          ul_path[i].classList.add('fs-5','navbar-nav','px-2','list-path');
          
      }

      const ul_path_li = document.querySelectorAll(".ul-path li");
      for (let i = 0; ul_path_li[i] ; i++) {
          
          ul_path_li[i].classList.add('py-1','paragraf-path');
          
      }

      const ul_path_li_a = document.querySelectorAll(".ul-path li a");
      for (let i = 0; ul_path_li_a[i] ; i++) {
          
          ul_path_li_a[i].classList.add('px-2','border-2',`border-${page_color}`,'border-end');
          
      }

      const paragraf_title = document.querySelectorAll(".paragraf-title");
      for (let i = 0; paragraf_title[i] ; i++) {
          
          paragraf_title[i].classList.add('m-4','border-bottom','border-2',`border-${page_color}`);
          
      }

      const code = document.querySelectorAll("code");
      for (let i = 0; code[i] ; i++) {
          
          code[i].classList.add('px-2',`text-${page_color}`,'border-bottom',`border-${page_color}`,'font-weight-bolder','border-2');
          
      }

      const btn_try_code = document.querySelectorAll(".btn-try-code");
      for (let i = 0; btn_try_code[i] ; i++) {
          
          btn_try_code[i].classList.add('btn',`bg-gradient-${page_color}`,'m-2','py-2','px-3');
          
      }
            
    }
  </script> 
@endisset

<script>

function ajax_function(){
    $(document).on( "click", ".ajax-submit", function(e) {
        
      e.preventDefault();
      let this_button=$(this);
      let form =  this_button.closest('form');
      let formActionUrl = form.attr('action');
      let type = form.attr('method');
      //عدلت هذا الكود من 
      //let formData = form.serialize();
      //الى
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
    console.log(data);
    console.log(data.notifyTitle);
    let toastType=data.notifyType;
    //console.log(data);
    let notify_title = document.querySelector(`#${toastType} div strong`);
    let notify_msg = document.querySelector(`#${toastType} div.toast-body`);
    //console.log(data.notifyTitle);
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
    if(data.active == 1){
        $(submut_btn).removeClass("btn-outline-info text-info");
        $(submut_btn).addClass("bg-gradient-info text-white");
        $(submut_btn).text("الغاء تفعيل");
    }else if(data.active == 0){  
        $(submut_btn).removeClass("bg-gradient-info text-white");
        $(submut_btn).addClass("btn-outline-info text-info");
        $(submut_btn).text("تفعيل");
    }
  }
  function delete_buttons(){
    let delete_btns = document.querySelectorAll(".delete");

    for (let i = 0; delete_btns[i] ; i++) {
      delete_btns[i].onclick=function(){
        let delete_action_data=$(delete_btns[i]).attr('action');
        $(".delete-form-notification").attr("action",delete_action_data);
      }
    }
  }
  function move_buttons(){
    let move_btns = document.querySelectorAll(".move");

    for (let i = 0; move_btns[i] ; i++) {
      move_btns[i].onclick=function(){
        let move_action_data=$(move_btns[i]).attr('action');
        $(".move-form").attr("action",move_action_data);
      }
    }
  }
  
</script> 

<script>

  function scroll_to_right(){

    let scroll_right = document.querySelectorAll('.scroll-right');
    scroll_right.forEach(element => {
        $(element).siblings('div.table-responsive').scroll(function(){
            $(element).removeClass('d-none');
            if($(this).scrollLeft() == 1 || $(this).scrollLeft() == 0){
              $(element).addClass('d-none');
            }
          });
        $(element).click(function(){
          $(element).siblings('div.table-responsive').animate({
              scrollLeft: 0
          }, 500);
        })
    });
  }
 
  // Get the text field
  let copy_btns = document.querySelectorAll(".copy-btn");
  
  copy_btns.forEach(btn => {
    btn.onclick=function(){
      // Select the text field
      let text=$(this).siblings('pre').children('code').text();
      
      // Copy the text inside the text field
      navigator.clipboard.writeText(text);
      $(btn).css('color','initial');
    }
  });
  
  let create_message_btns = document.querySelectorAll(".create-message");
  let create_message_form=document.querySelector(".create-message-form input[name='type']");
  create_message_btns.forEach(btn => {
    btn.onclick=function(){

      $(create_message_form).attr('value',$(this).attr('data-type'))
    }
  });
  
</script>


<script>
  // for error pages

  
  function runError(code){
      //const code='404';

      let bubbles=document.querySelector('.all-page .bubbles');
      for (let index = 0; index < 45; index++) { 
          let x=Math.random();
          let randnum=Math.ceil((x * 25)+1); 
          let span=document.createElement('span');
          span.setAttribute('style',`--i:${randnum}`);
          span.setAttribute('class','span');
          //let span=`<span style="--i:${randnum}"></span>`;
          bubbles.append(span);
      }

      let spans=document.querySelectorAll('.all-page .bubbles span');
      let litterArray=code.split('')
      for(let i=0 ; spans.length > i ; i++){
          if(i < 15){
              spans[i].textContent=litterArray[0];
          }
          if(i < 30 && i >= 15){
              spans[i].innerHTML=litterArray[1];
          }
          if(i < 45 && i >= 30){
              spans[i].textContent=litterArray[2];
          }
      }
  }
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
  /* هذا من اجل dark mode */
  function darkMode(){
    
    let toggle_mode = document.querySelector("#dark-mode");
    let label_mode = document.querySelectorAll(".label-mode i");
    
    let bodyEl = document.querySelector("body");

    let darkMode = false;

    toggle_mode.addEventListener('change', (event) => {
      darkMode = event.target.checked;
      label=$(toggle_mode).siblings('label');
      if(darkMode) {
        label_mode.forEach(element => {
          element.classList.remove('fa-moon');
          element.classList.add('fa-sun');
        });
        bodyEl.classList.add("dark");
        Dark_Light_Cookie('DarkMode',true,1);
      } else {
        label_mode.forEach(element => {
          element.classList.add('fa-moon');
          element.classList.remove('fa-sun');
        });
        bodyEl.classList.remove("dark");
        Dark_Light_Cookie('DarkMode',false,0);
      }
    })
      
  }

function Dark_Light_Cookie(cname, cvalue, exdays){
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

$( window ).scroll(function() {
  let scroll_max=document.body.offsetHeight - window.innerHeight +30;
  let scroll_value=$(document).scrollTop();
  let persent_value=Math.ceil((scroll_value*100)/scroll_max);
  //console.log(window.scrollMaxY );
  //console.log(persent_value );
  //console.log($(document).scrollTop());
  
  
  $('.progress-scroll-bage-x').css('width', `${persent_value}%` );
   //$( "span" ).css( "display", "inline" ).fadeOut( "slow" );
});



$('.scroll-button-top').click(function(){
  //let scroll_now=$(document).scrollTop()-($(window).height()/1.8);
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


</script>

