<script src="{{asset('public/assets/js/core/jquery.js')}}"></script>
<script src="{{asset('public/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('public/assets/js/core/bootstrap.min.js')}}"></script>

<!-- syntax code -->
<script src="{{asset('public/assets/prism/prism.js')}}"></script>
<!-- syntax code -->

    
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
    
    function toogle_navbar(){

      $('.navbar').toggleClass('off-navbar');
    }
  //############# start nav_categories  ##################  
  const nav_categories = document.querySelectorAll(".nav-category li");
  const nav_category_name = document.querySelectorAll(".nav-category li a .category-title");
  const nav_icons = document.querySelectorAll(".nav-category li a i");


  const MainCategories_color = [];

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
  /*
    const sidebar_categories = document.querySelectorAll(".sidebar-category li");
    //const sidebar_category_name = document.querySelectorAll(".sidebar-category li a #category-title");
    const sidebar_icons = document.querySelectorAll(".sidebar-category li a i");


    if(sidebar_icons !== null){


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
    }
  */
</script>

@isset($group_lessons)
  <script>
  radios_save_lesson_disabled_function();
    function radios_save_lesson_disabled_function(){
      let radios_save_lesson_disabled = Array.from($(".radio-save-lesson-disabled"));
        $(radios_save_lesson_disabled).click(function(e) {
          e.preventDefault();
        });
    }
    function style_function(page_color){
 
      const L_L_a = document.querySelectorAll(".list-path li a");
      if(L_L_a){
        for (let i = 0; L_L_a[i] ; i++) {
          L_L_a[i].classList.add(`border-${page_color}`);
        }
      }
      const Tr_Rm_B = document.querySelectorAll(".TI-RM-B");
      if(Tr_Rm_B){
        for (let i = 0; Tr_Rm_B[i] ; i++) {
          Tr_Rm_B[i].classList.add('btn',`bg-gradient-${page_color}`);
        }
      }
      
      const H2 = document.querySelectorAll(".header-2");
      if(H2){
        for (let i = 0; H2[i] ; i++) {
          H2[i].classList.add(`border-${page_color}`,`text-${page_color}`);
        }
      }
      const H3 = document.querySelectorAll("h3");
      if(H3){
        for (let i = 0; H3[i] ; i++) {
          H3[i].classList.add(`text-${page_color}`);
        }
      }
      const H2N = document.querySelectorAll(".header-2-number");
      if(H2N){
        for (let i = 0; H2N[i] ; i++) {
          H2N[i].classList.add(`text-${page_color}`);
        }
      }
      
      const C_B_L = document.querySelectorAll(".code-box-line");
      if(C_B_L){
        for (let i = 0; C_B_L[i] ; i++) {
          C_B_L[i].classList.add(`text-${page_color}`,`border-${page_color}`);
        }
      }
          
    }
  </script> 
@endisset

<script>
  /*
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
  }*/
  function create_save_btn(page_color,route){
    @verify
      let formSave = document.createElement("form");
      $(formSave).attr("action",route).attr("method","POST").attr('class','d-lg-none');

      let csrfInput = document.createElement("input");
      $(csrfInput).attr("name","_token").attr("value","{{csrf_token()}}").attr("type","hidden");
      formSave.appendChild(csrfInput);

      let btnSave = document.createElement("button");
      btnSave.classList.add('scroll-button','p-2','rounded-5',`bg-gradient-${page_color}`,'mx-auto','my-2','d-flex','justify-content-center','align-items-center','ajax-submit');

      let plusIcon = document.createElement("i");
      plusIcon.classList.add('fs-4','fa-solid','fa-plus');
      btnSave.appendChild(plusIcon);

      formSave.appendChild(btnSave);
      document.querySelector('.scroll-buttons-continer').appendChild(formSave)
    @else
      let btnSave = document.createElement("button");
      btnSave.classList.add('scroll-button','p-2','rounded-5',`bg-gradient-${page_color}`,'mx-auto','my-2','d-flex','justify-content-center','align-items-center','d-lg-none');
      $(btnSave).attr('data-bs-toggle','modal').attr('data-bs-target','#LoginModal');
      let plusIcon = document.createElement("i");
      plusIcon.classList.add('fs-4','fa-solid','fa-plus');
      btnSave.appendChild(plusIcon);

      document.querySelector('.scroll-buttons-continer').appendChild(btnSave)
    @endverify
  }

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
          }, 300);
        })
    });
  }
     
  function active_copy_btns(){
    let copy_btns = document.querySelectorAll(".copy-btn");
    if(copy_btns){
      copy_btns.forEach(btn => {
        btn.onclick=function(){
          if(copy_btns){
            copy_btns.forEach(element => {
              $(element).removeClass("bg-gradient-info");
              $(element).addClass("bg-gradient-primary");
            });
          }
          $(this).removeClass("bg-gradient-primary");
          $(this).addClass("bg-gradient-info");
          // Select the text field
          let text=$(this).siblings('pre').children('code').text();
          // Copy the text inside the text field
          navigator.clipboard.writeText(text);
          $(btn).css('color','initial');
        }
      });
    }
  } 

  let create_message_btns = document.querySelectorAll(".create-message");
  let create_message_form=document.querySelector(".create-message-form input[name='type']");
  create_message_btns.forEach(btn => {
    btn.onclick=function(){

      $(create_message_form).attr('value',$(this).attr('data-type'))
    }
  }); 
  
  function runError(code){
      let bubbles=document.querySelector('.all-page .bubbles');
      for (let index = 0; index < 45; index++) { 
          let x=Math.random();
          let randnum=Math.ceil((x * 25)+1); 
          let span=document.createElement('span');
          span.setAttribute('style',`--i:${randnum}`);
          span.setAttribute('class','span');
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
    let page_header_photo = document.querySelector(".page-header-photo");
    if(page_header_photo){
      if(status === "light"){
      $(page_header_photo).css({
        "background-image": `url(${page_header_photo.getAttribute('light-photo-data')})`
      })
      }else{
        if(page_header_photo.getAttribute('dark-photo-data') != ""){
          $(page_header_photo).css({
            "background-image": `url(${page_header_photo.getAttribute('dark-photo-data')})`
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

  $( window ).scroll(function() {
    let scroll_max=document.body.offsetHeight - window.innerHeight +30;
    let scroll_value=$(document).scrollTop();
    let persent_value=Math.ceil((scroll_value*100)/scroll_max);
    
    $('.progress-scroll-bage-x').css('width', `${persent_value}%` );
    $('input.custome-scrollbar-y').attr('value', `${persent_value}` );
  });


  function add_glossy(){

    $("button,a.btn,input[type='button']").hover(function(){
      $(this).addClass("glossyBtn");
    }, function(){
      $(this).removeClass("glossyBtn");
    });
  }


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
/*
قمت بتوقيف هذا الكود لاني لم اجد له فائدة اذا واجهت مشكلة في المستقبل فعله
//تابع من هنا بحيث تجعل ال ليبل ياخذ الكلاس اكتيف 
let radio_editor = Array.from($(".create-comment-editor input[type='radio']"));
let textarea_editor = $(".textarea-editor");
let texteditor = document.querySelector(".textarea-editor");

radio_editor.forEach(element => {
  $(element).on('change', function() {
    let u_element = document.createElement('span');
    u_element.append("New Heading");
    u_element.setAttribute('class','text-success');
    texteditor.append(u_element);
  });
  
});
*/

  function create_copy_btns(){

    let pre_code=$(".code-toolbar .toolbar");
    let pre_code_arr =[...pre_code];
    pre_code_arr.forEach(element => {
      $(element).before('<button class="copy-btn position-absolute btn bg-gradient-primary py-1 px-3 m-0 fs-6 fw-bolder" style="z-index:1;"><i class="fs-4 fa-regular fa-paste"></i></button>');
    });
  }

  var editors = [];  
  function createEditor(element_id, editor_placeholder){
      return CKEDITOR.ClassicEditor.create(document.getElementById(element_id), {
          // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
          language: 'ar',
          toolbar: {
              items: [
                  'selectAll', '|',
                  'bold', 'italic', 'strikethrough', 'underline', 'code', 'removeFormat', '|',
                  'undo', 'redo','|',
                  'fontColor', '|',
                  'alignment', '|',
                  'link','insertTable',, 'codeBlock','|',
                  'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                  'sourceEditing',
                  'todoList',
                  'highlight',
                  'numberedList',
                  'outdent', 'indent',
              ],
              shouldNotGroupWhenFull: true
          },
          placeholder: editor_placeholder,
          
          
          // Be careful with enabling previews
          // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
          
          // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
          link: {
              decorators: {
                  addTargetToExternalLinks: true,
                  defaultProtocol: 'https://',
                  toggleDownloadable: {
                      mode: 'automatic',
                      
                  }
              }
          },
          // The "super-build" contains more premium features that require additional configuration, disable them below.
          // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
          
          removePlugins: [
              // These two are commercial, but you can try them out without registering to a trial.
                  'ExportPdf',
                  'ExportWord',
              'CKBox',
              'CKFinder',
              'EasyImage',
              // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
              // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
              // Storing images as Base64 is usually a very bad idea.
              // Replace it on production website with other solutions:
              // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
              // 'Base64UploadAdapter',
              'RealTimeCollaborativeComments',
              'RealTimeCollaborativeTrackChanges',
              'RealTimeCollaborativeRevisionHistory',
              'PresenceList',
              'Comments',
              'TrackChanges',
              'TrackChangesData',
              'RevisionHistory',
              'Pagination',
              'WProofreader',
              // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
              // from a local file system (file://) - load this site via HTTP server if you enable MathType.
              'MathType',
              // The following features are part of the Productivity Pack and require additional license.
              'SlashCommand',
              'Template',
              'DocumentOutline',
              'FormatPainter',
              'TableOfContents'
          ]
      })
      .then(editor => {
          editors[element_id]  = editor;
      })
      .catch( error => {
          //console.error( error );
          console.error('فعلت خطأ يا غالي');
      } );
  }

  function ckeditor_ajax_function(){
    $(document).on( "click", ".ckeditor-ajax-submit", function(e) {
      e.preventDefault();
      let this_button=$(this);
      let data_editor_id=$(this).attr('data-editor-id');
      let data_editor_name=$(this).attr('data-editor-name');
      let form =  this_button.closest('form');
      let formActionUrl = form.attr('action');
      
      let textAreaEle= document.createElement("textarea");
      textAreaEle.setAttribute('name',data_editor_name);
      textAreaEle.setAttribute('class','d-none');
      
      form.append(textAreaEle);

      let text_ele = editors[data_editor_id].getData();//for test
      
      $(`textarea[name="${data_editor_name}"]`).text(text_ele);
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
              if($(`textarea[name="${data_editor_name}"]`) !== null){
              $(`textarea[name="${data_editor_name}"]`).remove();
              }
              ajax_success_view(data,this_button);
          },
          error:function(reject) {
            let error_alert = Array.from($('div[id$="_error"]'));
            if(error_alert.length > 0){
              
              error_alert.forEach(element => {
                $(element).fadeOut(200);
              });
            }
            if($(`textarea[name="${data_editor_name}"]`) !== null){
                $(`textarea[name="${data_editor_name}"]`).remove();
            }
            var response=$.parseJSON(reject.responseText);
            $.each(response.errors, function(key, val){
                $('[id=' + key + '_error]').fadeIn(500).text(val[0]);
                
            });
          },
          beforeSend:function() {
          }
      });
    });
  }

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
    create_copy_btns();
    active_copy_btns();
    add_glossy();
    $('*').removeClass("placeholder");
  });

/*######################## OnOnline --- OnOffline###########################*/
  document.getElementsByTagName("BODY")[0].onoffline = function(){
    $('.online').hide();
    $('.offline').show();
  };
  document.getElementsByTagName("BODY")[0].ononline = function(){
    $('.offline').hide();
    $('.online').show();
    setInterval(function(){$('.online').hide();}, 10000);
  };



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