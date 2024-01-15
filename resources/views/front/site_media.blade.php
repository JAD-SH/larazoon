@extends('layouts.front.site')

@section('title','تواصلك مع الموقع')

@section('meta_tags')
<meta name="robots" content="noindex">
@endsection

@section('css')
  <style>
    .accordion-button::after {
      color:white !important;
    }
  </style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('profile')}}">ملفي الشخصي <i class="fa-solid fa-address-card "></i></a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">ردود ادارة الموقع عليك</li>
@endsection

@section('content')

  <div class="card  m-1 m-md-4 p-2 p-md-4  border-0 rounded-5  shadow-sm mb-3">
      
  @if($notifies !== null)
  <div class="accordion accordion-flush rounded-5 overflow-hidden" id="accordionFlushExample">
 
  @foreach($notifies as $index=>$notify)

      <div data-sos-once="true"  data-sos="sos-blur" class="accordion-item">
        <h2 class="accordion-header" id="flush-heading-{{$index+1}}">
          <button class="accordion-button collapsed bg-gradient-primary fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{$index+1}}" aria-expanded="false" aria-controls="flush-collapse-{{$index+1}}">
            {{$notify->title}} 
            @if($notify->notificationreply !== null)
              @if( $notify->notificationreply->updated_at->diffInHours() <= 24) 
                <span class=" rounded-pill text-primary bg-gradient-light fw-bolder px-2 mx-1">
                  جديد
                </span>
              @endif
            @endif
          </button>
        </h2>
        <div id="flush-collapse-{{$index+1}}" class="border-start border-end border-2 accordion-collapse collapse" aria-labelledby="flush-heading-{{$index+1}}" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body fw-bolder  fs-6">
            <div class="d-block mb-2">
              <span class="badge bg-gradient-info text-sm fs-6 text-light rounded-pill">انت </span> 
              <span class="badge bg-gradient-info text-sm fs-6 text-light rounded-pill"><i class="fa-solid fa-calendar-days text-white px-1"></i>{{$notify->created_at->diffForHumans()}} </span> 
            </div>
           {{$notify->message}}
          </div>

          @if($notify->notificationreply !== null)
          <hr class="horizontal  my-2 dark" style="height: 2px !important;">
          <div class="accordion-body fw-bolder  fs-6">
            <div class="d-block mb-2">
              <span class="badge bg-gradient-info text-sm fs-6 text-light rounded-pill">إدارة الموقع </span> 
              <span class="badge bg-gradient-info text-sm fs-6 text-light rounded-pill fw-none"><i class="fa-solid fa-calendar-days text-white px-1 text-sm"></i>{{$notify->notificationreply->created_at->diffForHumans()}} </span> 
            </div>
            {{$notify->notificationreply->message}}
            @if($notify->notificationreply->code !== null)
              <div class="my-3 position-relative">
                  <button class="copy-btn position-absolute btn bg-gradient-info py-1 px-3 m-0 fs-6 fw-bolder" aria-label="copy code">
                      <i class="fs-4 fa-regular fa-paste"></i>
                  </button>
                  <pre class="p-0 fs-5 "><code  class="language-javascript">
                  {{$notify->notificationreply->code}}
                  </code></pre>
              </div>
            @endif
          </div>
          @endif

        </div>
      </div>
          
      @endforeach
    </div>
    {!! $notifies ->onEachSide(2)-> links() !!}
  @else
    <div class="fs-4 text-center p-5 fw-bolder pt-1">لم تقوم بطرح اي اسئلة او رسائل للادمن </div>
  @endif 

  </div>
   
@endsection

@section('script')
<script>
  $(document).ready(function(){
    active_copy_btns();
    create_copy_btns();
  });
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
          let text=$(this).siblings('pre').children('code').text();
          navigator.clipboard.writeText(text);
          $(btn).css('color','initial');
        }
      });
    }
  } 
  function create_copy_btns(){
    let pre_code=$(".code-toolbar .toolbar");
    let pre_code_arr =[...pre_code];
    pre_code_arr.forEach(element => {
      $(element).before('<button class="copy-btn position-absolute btn bg-gradient-primary py-1 px-3 m-0 fs-6 fw-bolder" style="z-index:1;"><i class="fs-4 fa-regular fa-paste"></i></button>');
    });
  }
</script>
@endsection

