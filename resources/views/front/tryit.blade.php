@include('layouts.front.head')
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    @section('title','TryIt - جرب الكود ')
    <link href="{{asset('public/assets/tryit-codemirror/lib/codemirror.css')}}" rel="stylesheet" />
    <link href="{{asset('public/assets/tryit-codemirror/theme/panda-syntax.css')}}" rel="stylesheet" />
        
    <style>
      /*### For Spinner Loading ###*/
      .con-sig {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			width: 100%;
			background-color: #8f8fedfd;
			position: fixed;
 			z-index: 9999999999999;
		}
		
		.con-sig #l-sig, .con-sig #r-sig {
			font-size: 6rem !important;
			font-family: fantasy;
			margin: 0 25px;
			animation-iteration-count: infinite;
			animation-duration: 2s;
			opacity: 0.7;
		} 
		.con-sig #l-sig {
			animation-name: lSig;
			color: #3a3a3a;			
		}
		.con-sig #r-sig {
			animation-name: rSig;
			color: #676767;
		}
		@keyframes lSig {
			60%{
				color: #3d3253;
				scale: 1.5;
				transform: rotate(180deg);
				margin-right: -75px;
			}
			100%{
				scale: none;
				color: #3a3a3a;
				transform: rotate(360deg);
			}
		}
		@keyframes rSig {
			60%{
				color: #3d3253;
				scale: 1.5;
				transform: rotate(180deg);
				margin-left: -75px;
			}
			100%{
				scale: none;
				color: #676767;
				transform: rotate(360deg);
			}
		}

      .add{
        height: 15vh;
        background-color:#222;
      }
      .tryit-container {
        height: 85%;
        bottom:8px;
        overflow:hidden;
      }
      .repeatHCJ p{
        position: sticky;
        top: 0;
        z-index: 111;
      }
      .repeatHCJ{
        max-height:50vh;
       /* overflow: auto;*/
        position: relative;
      }
      .iframerepeatHCJ{
        height: 60vh;
        margin-top:40px;
      }
      .CodeMirror, .tryit-output {
        height: 100%;
      }
      .main-content{
        background-color:#131c26;
      }
      .btn{padding: 0.8rem!important;}
      .CodeMirror-sizer{
        font-size: 20px !important;
      }
    </style>
  </head>
  <body>
  <div class="con-sig">
		<span id="l-sig">{</span>
		<span id="r-sig">}</span>
	</div>
  <div class="add"></div>
    <main class="main-content  mt-0">
      <div class="col-12 text-center">
        <div class="p-0 d-inline-block">
          <a class="btn rounded-3 bg-gradient-info m-1"  href="{{route('Course.index')}}"><i class=" fs-6 fa-solid fa-house-chimney"></i></a>
          @if($tryit->type == 'htmlmixed'  && $tryit->type1 !== null)
          <button class="repeatHCJ-btn btn rounded-3 bg-gradient-info m-1"><i class=" fs-6 fa fa-repeat"></i></button>
          @else
          <button class="repeat-btn btn rounded-3 bg-gradient-info m-1"><i class=" fs-6 fa fa-repeat"></i></button>
          @endif
          <button class="btn rounded-3 bg-gradient-info m-1 run-code"><i class=" fs-6 fa fa-play"></i></button>
        </div>
      </div>
      <div class="row tryit-container m-0 p-0 w-100">
        @if($tryit->type == 'htmlmixed' && $tryit->type1 !== null)
          <div class="repeatHCJ p-1">
            <p class="text-center fs-5 fw-bold my-1">index.html</p>
            <div class="htmleditor  w-100 " ></div>
          </div>
        
        @if($tryit->type1 == 'css' || $tryit->type2 == 'css')
        <div class="repeatHCJ p-1">
          <p class="text-center fs-5 fw-bold my-1">style.css</p>
          <div class="csseditor  w-100 " ></div>
        </div>
        @endif
        
        @if($tryit->type1 == 'javascript' || $tryit->type2 == 'javascript')
        <div class="repeatHCJ p-1">
          <p class="text-center fs-5 fw-bold my-1">script.js</p>
          <div class="javascripteditor  w-100 " ></div>
        </div>
        @endif
 

        <div class="iframerepeatHCJ col-12 p-1">
          <iframe class="tryit-output bg-white border w-100" sandbox="allow-modals allow-forms allow-popups allow-scripts allow-same-origin" allowfullscreen="true"></iframe>
        </div>


        @else
        <div class="repeat col-12 h-50 p-1">
          <div class="codeeditor  w-100 " ></div>
        </div>
        <div class="repeat col-12 h-50 p-1">
          <iframe class="tryit-output bg-white border w-100" sandbox="allow-modals allow-forms allow-popups allow-scripts allow-same-origin" allowfullscreen="true"></iframe>
        </div>
        @endif
      </div>
    </main>

    <!--   Core JS Files   -->
    @include('layouts.front.js')
    <!--   Core JS Files   -->
  
    <script src="{{asset('public/assets/tryit-codemirror/lib/codemirror.js')}}"></script>
    <script src="{{asset('public/assets/tryit-codemirror/mode/javascript/javascript.js')}}"></script>
    <script src="{{asset('public/assets/tryit-codemirror/mode/'.$tryit->type.'/'.$tryit->type.'.js')}}"></script>
    <script src="{{asset('public/assets/tryit-codemirror/mode/css/css.js')}}"></script>
    <script src="{{asset('public/assets/tryit-codemirror/mode/xml/xml.js')}}"></script>

    @if($tryit->type == 'htmlmixed'  && $tryit->type1 !== null)

    <script>

      window.addEventListener('load',() => {
        $(".con-sig").fadeOut(500);  
      });

      let button = document.querySelector('.run-code');
      let iframe = document.querySelector('iframe');
      let htmlTextArea = document.querySelector('.htmleditor');
      let cssTextArea = document.querySelector('.csseditor');
      let javascriptTextArea = document.querySelector('.javascripteditor');


      let TextAreas = Array.from($('.repeatHCJ'));
      let col = 12/$('.repeatHCJ').length;

      TextAreas.forEach(element => {
        $(element).addClass(`col-${col}`);
      });
      let htmlcode =`{!!$tryit->code!!}`;


      @if($tryit->type1 == 'css')
        let csscode =`{!!$tryit->code1!!}`; 
      @elseif($tryit->type2 == 'css')
        let csscode =`{!!$tryit->code2!!}`;
      @endif

      @if($tryit->type1 == 'javascript')
        let javascriptcode =`{!!$tryit->code1!!}`; 
      @elseif($tryit->type2 == 'javascript')
        let javascriptcode =`{!!$tryit->code2!!}`;
      @endif


      $(document).ready(function(){
          $(button).click(); 
      });
      $('.repeatHCJ-btn').click(function(){
        console.log('aaaaaaaaaaaaa');
          Array.from($('.repeatHCJ')).forEach(element => {
            $(element).toggleClass("col-12 my-3");
          });
      });


      var htmlCodeMirror = CodeMirror(htmlTextArea, {
        value: htmlcode,
        lineNumbers: true,
        mode:  "{{$tryit->type}}",
        theme: "panda-syntax",
        //readOnly: true لعدم السماح بالكتابة عل المحرر
        });
        
       if(cssTextArea){
        var cssCodeMirror = CodeMirror(cssTextArea, {
        value: csscode,
        lineNumbers: true,
        mode:  "css",
        theme: "panda-syntax",
        //readOnly: true لعدم السماح بالكتابة عل المحرر
        });
       }
       if(javascriptTextArea){
        var javascriptCodeMirror = CodeMirror(javascriptTextArea, {
        value: javascriptcode,
        lineNumbers: true,
        mode:  "javascript",
        theme: "panda-syntax",
        //readOnly: true لعدم السماح بالكتابة عل المحرر
        });
       }
 

        button.addEventListener('click', () => {
          const fullHTML = `
            <!doctype html><html>
              <head><style>${cssCodeMirror.getValue()}</style></head>
              <body>${htmlCodeMirror.getValue()}
              <script>
              ${javascriptCodeMirror.getValue()}
              <\/script>
              </body>
            </html>`;
          iframe.src = 'data:text/html,' + encodeURIComponent(fullHTML);
        });
    </script>

    @else
    
    <script>
      let button = document.querySelector('.run-code');
      let iframe = document.querySelector('iframe');
      let myTextArea = document.querySelector('.codeeditor');
      let code =`{!!$tryit->code!!}`;
      $(document).ready(function(){
          $(button).click(); 
      });
      $('.repeat-btn').click(function(){
          Array.from($('.repeat')).forEach(element => {
              $(element).toggleClass("col-12 h-50 col-6 h-100");
            });
      });
      var myCodeMirror = CodeMirror(myTextArea, {
        value: code,
        lineNumbers: true,
        mode:  "{{$tryit->type}}",
        theme: "panda-syntax",
        //readOnly: true لعدم السماح بالكتابة عل المحرر
        });
        button.addEventListener('click', () => {
            let fullHTML =myCodeMirror.getValue();
            iframe.src = 'data:text/html,' + encodeURIComponent(fullHTML);
        });
       
    </script>
    @endif
  </body>

</html>
