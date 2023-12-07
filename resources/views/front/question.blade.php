
@extends('layouts.front.site')

@section('title',$question->title)
@section('description',$question->description)
@section('og:url',route('Question.show',$question->slug))
@section('og:image',asset($question->photo))
@section('og:image:url',asset($question->photo))

@section('css')
    <style>
       
        .comment-reply-card{
            background-color:var(--bs-body-bg);
        }

        .trash-can-shook{
            transition:all .5s;
           
        }
        .trash-can-shook:hover i{
            box-shadow: 0px 0px 20px #f44335;
        }
       
        .ckeditor-display *{
            letter-spacing: .7px !important;
            font-size: 1.07rem !important;
        }
    </style>
    {!!$schemajspnscript!!}

@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Question.index')}}">{{$question->questionlibraries->first()->maincategory->first()->title}} <i class="m-auto fa-solid fa-clipboard-question"></i></a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$question->title}}</li>

@endsection

@section('content')


@verify
    @include('front.includes.alerts.delete-modal', ['title_warning' => 'هل حقا تريد حذف هذا التعليق','description_warning' => 'لن تستطيع استعادة التعليق بعد حذفه'])

    <form action="{{route('save-question',$question->id)}}" method="POST">
        @csrf
        <button data-sos-once="true" data-sos="sos-right" id="save-items-continer" class=" bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} position-fixed rounded-1 d-none d-lg-block ajax-submit">
            <i id="save-items-btn" class="fa-solid fa-plus text-white p-3 "></i>
        </button>
    </form>
@else
    <button data-sos-once="true" data-sos="sos-right" id="save-items-continer" class=" bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} position-fixed rounded-1 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#LoginModal" >
        <i id="save-items-btn" class="fa-solid fa-plus text-white p-3 "></i>
    </button>
@endverify

<div class="card m-1 m-md-4 py-4 px-2 px-md-3 border-0 rounded-5  shadow-sm mb-5 overflow-hidden">
    <div class="round-squer bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} "></div>
    <div class=" card-body p-0">
        <div class="row m-2">
        <div class="col-auto px-0">
            <a href="{{ $question->user->getPhoto() }}" class="avatar avatar-xl position-relative  nav-link ">
                <img src="{{ $question->user->getPhoto() }}" alt="profile_image" class="w-100 h-100 rounded-4 ">
            </a>     
        </div>
        <div class="col-auto my-auto mt-0">
            <a href="{{route('show-profile',$question->user->username)}}" class="h-100">
                <div class="mb-1 fs-5 fw-bolder">
                {{ $question->user->name }}
                @verify
                    @if(Auth::user()->id == $question->user_id)
                    <span class="text-primary fs-6">(أنت)</span>
                    @endif
                @endverify
                </div>
                <p class="mb-1 fw-bolder text-sm text-{{$question->questionlibraries->first()->maincategory->first()->color}}" style="font-size: 12px;">
                {{ $question->user->interest }} Developer 
                </p>
                <p class="mb-0 fw-bolder text-sm  " style="font-size: 12px;">
                    <i class="fa-solid fa-calendar-days text-{{$question->questionlibraries->first()->maincategory->first()->color}} px-1"></i>{{$question->created_at->diffForHumans()}} 
                </p>
            </a>
            @verify
                @if(Auth::user()->id == $question->user_id)
                    <a type="button" action="{{route('delete.question', $question->id)}}" style="left: 50%; top: 100px;"
                    class="delete d-inline-block position-absolute trash-can-shook my-2"
                    data-bs-toggle="modal" data-bs-target="#DeleteModal">
                    <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                    </a>
                @endif
            @endverify
        </div>
        </div>
        <div class=" mx-3 y-0 p-3 fw-bolder  text-center fs-4 text-dark">
        {{$question->title}}
        </div>

        <hr class="horizontal  my-2 dark">

                  
        <div class="m-md-2 p-3 mt-0">
            <span class="fs-6 fw-bolder mb-3 ckeditor-display">
            {!! $question->description !!}
            </span>
            
        </div>
        
        
        <div class="m-2 fw-bolder d-flex justify-content-start align-items-baseline">
            @foreach($question->questionlibraries as $questionlibrary) 
                <span class="badge bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} text-light rounded-pill text-sm mx-1"><i class="fa-solid fa-tag"></i>  {{$questionlibrary->title}}</span> 
            @endforeach         
        </div>
    </div>
</div>


    @include('front.includes.alerts.likes-views', 
       ['isliked' => 'question'.$question->id.'IsLiked' ,
        'likedroute' => route('Question.AddLike',$question->id) ,
        'color' => $question->questionlibraries->first()->maincategory->first()->color ,
        'name' => 'السؤال',
        'likes' => $question->likes,'views' => $question->views])


        

<div class=" mb-5">
    <div class="m-1 m-md-4 mb-3">

        <div data-sos="sos-left" class="my-3">
            <span class="fw-bolder fs-4 py-2 pe-4">إجابات <span class="fw-bolder fs-4 text-{{$question->questionlibraries->first()->maincategory->first()->color}}  ">{{($question->comments->where('comment_id',null)->count())}} </span></span>
        </div>
        @verify
        <div class="">
            <!-- Button trigger modal -->
            <a data-sos="sos-right" href="#ckeditorForm" class="btn bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}}  btn-block my-0 fs-6 rounded-4" >
                <i class="fas fa-reply"></i> اقترح حل لهذه المشكلة البرمجية 
            </a>
        <!-- هذه للتعليق وليس لاقتراح حل-->
        @include('front.includes.alerts.create-comment-modal')
        
        </div>
        @else
        <div class="">
            <!-- Button trigger modal -->
            <button data-sos="sos-rotateZ" type="button" class="btn bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} btn-block my-0 fs-6 rounded-4" data-bs-toggle="modal" data-bs-target="#LoginModal">
               <i class="fas fa-reply"></i> اقترح حل لهذه المشكلة البرمجية 
            </button>
            
        </div>
        @endverify
    </div>
    
    @if($question->comments()->count() > 0)
        @foreach($question->comments->where('comment_id',null) as $index=>$comment)
        <div data-sos-once="true" data-sos="sos-top"  id="item-{{$comment->id}}" class="card m-1 m-md-4 py-4 px-2 px-md-3  border-0 rounded-5  shadow-sm mb-3 border-bottom border-2 border-{{$question->questionlibraries->first()->maincategory->first()->color}}">
            <div class=" @if($index == 0) border border-primary rounded-5 border-2 @endif">
                <div class="  pb-0 py-md-0 m-2">
                    
                    <div class="w-100 text-center d-md-none @if($index == 0)   mt-3 @endif">
                    
                        @if($index == 0) 
                            <span class="bg-gradient-warning py-1 px-2 rounded-3">افضل إجابة <i class="fa-solid fa-ranking-star text-warning"></i></span> 
                        @endif
                        @verify
                            @if(Auth::user()->id == $comment->user_id)
                                <a type="button" action="{{route('delete.comment', $comment->id)}}"
                                class="delete float-end me-3"
                                data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                </a>
                            @endif
                        @endverify
                    </div>
                    <div class="row m-2 flex-nowrap">

                    <div class="col-auto px-0">
                        <div class="d-inline-block me-2 text-center">
                            @if(! session()->has('comment'.$comment->id.'IsLiked'))
                                <form  action="{{route('Comment.AddLike',$comment->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn bg-gradient-light rounded-5 p-1  pb-0 ajax-submit">
                                        <i class=" text-info fa-solid fa-angle-up fs-4 fw-bolder"></i>
                                    </button>
                                </form>
                            @else 
                                <button class="btn bg-gradient-light rounded-5 p-1  pb-0" disabled>
                                    <i class=" fa-solid fa-angle-up fs-4 fw-bolder"></i>
                                </button>
                            @endif

                            <div class=" my-2 fw-bolder fs-6 text-@if ($comment->likes < 0)danger @elseif ($comment->likes > 0)success @else()dark @endif">{{$comment->likes}}</div>

                            @if(! session()->has('comment'.$comment->id.'IsDisLiked'))
                                <form  action="{{route('Comment.AddDisLike',$comment->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn bg-gradient-light rounded-5 p-1 pb-0 ajax-submit">
                                        <i class=" text-dark fa-solid fa-angle-down fs-4 fw-bolder"></i>
                                    </button>
                                </form>
                            @else 
                                <button class="btn bg-gradient-light rounded-5 p-1 pb-0" disabled>
                                    <i class=" text-dark fa-solid fa-angle-down fs-4 fw-bolder"></i>
                                </button>                            
                            @endif
                        </div>

                        <a href="{{ $comment->user->getPhoto() }}" class="avatar avatar-xl position-relative py-1 nav-link ">
                            <img src="{{ $comment->user->getPhoto() }}" alt="profile_image" class="w-100 h-100 rounded-4 ">
                        </a>    
                            
                    </div>
                    <div class="col-auto my-auto d-flex justify-content-center">
                        <a href="{{route('show-profile',$comment->user->username)}}" class="h-100 d-inline-block">
                            <div class="mb-1 fs-5 fw-bolder text-dark">
                                {{ $comment->user->name }}
                                @verify
                                    @if(Auth::user()->id == $comment->user_id)
                                    <span class="text-primary fs-6">(أنت)</span>
                                    @endif
                                @endverify
                                <p class="mb-1 text-sm text-{{$question->questionlibraries->first()->maincategory->first()->color}}" style="font-size: 12px;">
                                    {{ $comment->user->interest }} Developer  
                                </p>
                                <p class="mb-0 text-sm  " style="font-size: 12px;">
                                    <i class="fa-solid fa-calendar-days text-{{$question->questionlibraries->first()->maincategory->first()->color}} px-1"></i>{{$comment->created_at->diffForHumans()}} 
                                </p>
                            </div>
                        </a>
                            <div class="mb-1 fs-5 fw-bolder text-dark d-inline-block">
                                @if($index == 0) <span class="bg-gradient-warning py-1 px-2 rounded-3 d-none d-md-inline-block">افضل إجابة <i class="fa-solid fa-ranking-star text-warning"></i></span> @endif
                                @verify
                                    @if(Auth::user()->id == $comment->user_id)
                                    <a type="button" action="{{route('delete.comment', $comment->id)}}" style="left: 40px; top: 50px;"
                                    class="delete d-none d-md-inline-block position-absolute trash-can-shook"
                                        data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                        <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                    </a>
                                    @endif
                                @endverify
                                @if( $comment->created_at->diffInHours() <= 24) 
                                    <span class=" rounded-pill  bg-gradient-danger fw-bolder px-2 mx-1"> 
                                            جديد
                                    </span>
                                @endif
                            </div>
                            
                    </div>
                </div>
                <div class="my-3 p-2">
                    <span class="mb-2 ckeditor-display">
                        {!!$comment->comment!!} 
                    </span>
                </div>
                
            <div class=" m-2 fw-bolder d-flex justify-content-between align-items-baseline">
                    
                    @verify

                    <button action="{{route('add.comment-reply',$comment->id)}}" type="button" class="fs-6 m-1 btn bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} mb-0 py-1 px-2 rounded-3 comment-reply"
                        data-bs-toggle="modal" data-bs-target="#CreateCommentReplyModal">
                        قم بالرد  <i class="fas fa-reply"></i>
                    </button>

                    @else

                    <button type="button" class="fs-6 m-1 btn bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} mb-0 py-1 px-2 rounded-3" 
                    data-bs-toggle="modal" data-bs-target="#LoginModal">
                     قم بالرد  <i class="fas fa-reply"></i>
                    </button>
                        
                    @endverify

                    
                    </div>
                </div>
            </div>

            @if($comment->comment_replies()->count() > 0)
            <div class=" m-2 fw-bolder d-flex justify-content-between align-items-baseline">
                    

                    <span class="fs-6 m-1 bg-gradient-primary mb-0 py-1 px-2 rounded-3" >
                        مناقشة حول الاجابة الخاصة ب {{ $comment->user->name }}
                    </span>
            </div>
            @foreach($comment->comment_replies as $index=>$reply)
            


                <div data-sos-once="true" data-sos="sos-top" id="item-{{$reply->id}}" class="card m-1 m-md-4 py-4 px-2 px-md-3  border-0 rounded-5  shadow-sm mb-3 comment-reply-card">
                    <div class=" ">
                        <div class="  pb-0 py-md-0 m-2">
                            <div class="w-100 text-center d-md-none  ">
                                @verify
                                    @if(Auth::user()->id == $reply->user_id)
                                        <a type="button" action="{{route('delete.comment', $reply->id)}}"
                                        class="delete  float-end me-3"
                                        data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                        <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                        </a>
                                    @endif
                                @endverify
                            </div>
                            <div class="row m-2 flex-nowrap">
                            <div class="col-auto px-0">
                                <div class="d-inline-block me-2 text-center">
                                    @if(! session()->has('comment'.$reply->id.'IsLiked'))
                                        <form  action="{{route('Comment.AddLike',$reply->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn bg-gradient-light rounded-5 p-1  pb-0 ajax-submit">
                                                <i class=" text-info fa-solid fa-angle-up fs-4 fw-bolder"></i>
                                            </button>
                                        </form>
                                    @else 
                                        <button class="btn bg-gradient-light rounded-5 p-1  pb-0" disabled>
                                            <i class=" fa-solid fa-angle-up fs-4 fw-bolder"></i>
                                        </button>
                                    @endif

                                    <div class=" my-2 fw-bolder fs-6 text-@if ($reply->likes < 0)danger @elseif ($reply->likes > 0)success @else()dark @endif">{{$reply->likes}}</div>

                                    @if(! session()->has('comment'.$reply->id.'IsDisLiked'))
                                        <form  action="{{route('Comment.AddDisLike',$reply->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn bg-gradient-light rounded-5 p-1 pb-0 ajax-submit">
                                                <i class=" text-dark fa-solid fa-angle-down fs-4 fw-bolder"></i>
                                            </button>
                                        </form>
                                    @else 
                                        <button class="btn bg-gradient-light rounded-5 p-1 pb-0" disabled>
                                            <i class=" text-dark fa-solid fa-angle-down fs-4 fw-bolder"></i>
                                        </button>                            
                                    @endif
                                </div>

                                <a href="{{ $reply->user->getPhoto() }}" class="avatar avatar-xl position-relative py-1 nav-link ">
                                    <img src="{{ $reply->user->getPhoto() }}" alt="profile_image" class="w-100 h-100 rounded-4 ">
                                </a>          
                                
                            </div>
                            <div class="col-auto my-auto d-flex justify-content-center">
                                <a href="{{route('show-profile',$reply->user->username)}}" class="h-100">
                                    <div class="mb-1 fs-5 fw-bolder text-dark">
                                        {{ $reply->user->name }}

                                        @verify
                                            @if(Auth::user()->id == $reply->user_id)
                                            <span class="text-primary fs-6">(أنت)</span>
                                            @endif
                                        @endverify

                                        <p class="mb-1 text-sm text-{{$question->questionlibraries->first()->maincategory->first()->color}}" style="font-size: 12px;">
                                            {{ $reply->user->interest }} Developer  
                                        </p>
                                        <p class="mb-0 text-sm  " style="font-size: 12px;">
                                        <i class="fa-solid fa-calendar-days text-{{$question->questionlibraries->first()->maincategory->first()->color}} px-1"></i>{{$reply->created_at->diffForHumans()}} 
                                        </p>
                                    </div>
                                </a>
                                <div class="mb-1 fs-5 fw-bolder text-dark d-inline-block">
                                    @verify
                                        @if(Auth::user()->id == $reply->user_id)
                                            <a type="button" action="{{route('delete.comment', $reply->id)}}" style="left: 40px; top: 50px;"
                                            class="delete d-none d-md-inline-block position-absolute trash-can-shook"
                                            data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                            <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                            </a>
                                        @endif
                                    @endverify
                                    @if( $reply->created_at->diffInHours() <= 24) 
                                        <span class=" rounded-pill  bg-gradient-danger fw-bolder px-2 mx-1"> 
                                                جديد
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="my-3 p-2">
                            <span class="mb-2 ckeditor-display">
                                {!!$reply->comment!!} 
                            </span>
                        </div>
                        
                        </div>
                    </div>
                </div>

            @endforeach
            @endif

        </div>
         
        @endforeach
    @endif       
</div>
<div data-sos-once="true" data-sos="sos-blur" class="card m-1 m-md-4 py-4 px-2 px-md-3  border-0 rounded-5  shadow-sm mb-3 ">
    @verify
    <form id="ckeditorForm" method="POST" action="{{route('add.comment',$question->id)}}">
        @csrf   
        <div class=" mb-3">
            <label class="fw-bolder fs-6 my-1 pb-2 text-dark" for="comment-ckeditor">الاجابة</label>
            <div class="">
                <textarea id="comment-ckeditor"></textarea>
            </div>
        </div>
        <div class=" mb-3">
            <div id="comment_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div> 
        </div>
        <!--  يجب متابعة بقية العمل في الكونتروللير -->
        <button data-sos-once="true" data-sos="sos-rotateZ" class=" mt-3 btn rounded-3 bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} fs-6  ckeditor-ajax-submit" data-editor-id="comment-ckeditor" data-editor-name="comment">أرسل الإجابة</button>
    </form>    
    @else
    <div class="not-allow-to-comment position-relative d-flex justify-content-center align-items-center">
        <div class="w-100 h-100 opacity-75 bg-white position-absolute" style="z-index:111;"></div>
        <button data-sos-once="true" data-sos="sos-rotateZ" type="button" class="btn bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} btn-block my-0 fs-6 rounded-4 position-absolute" data-bs-toggle="modal" data-bs-target="#LoginModal"  style="z-index:112;">
            سجل الدخول لتتمكن من الاجابة
        </button>
        <div class=" w-100 ">
            <div class=" mb-3">
                <label class="fw-bolder fs-6 my-1 pb-2 text-dark" for="comment-ckeditor">الاجابة</label>
                <div class="">
                    <div id="comment-ckeditor"></div>
                </div>
            </div>
            <!--  يجب متابعة بقية العمل في الكونتروللير -->
            <button  class=" mt-3 btn rounded-3 bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} fs-6">أرسل الإجابة</button>
        </div>
    </div>
    @endverify
    </div>
    
        <!--
            The "super-build" of CKEditor 5 served via CDN contains a large set of plugins and multiple editor types.
            See https://ckeditor.com/docs/ckeditor5/latest/installation/getting-started/quick-start.html#running-a-full-featured-editor-from-cdn
            <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>
            <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/translations/ar.js"></script>
        -->
        <!--
            Uncomment to load the Spanish translation
            <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/translations/es.js"></script>
        -->
       
@endsection


@section('script')
<!-- 
        قمت بتوقيف الكود للانه cdn يأخذ وقت في كل مرة اجرب الاكواد لذلك قمت مؤقتا بتحميله ووضعه في الملف CKEditor.min.js ثم استدعيه 
        <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/translations/ar.js"></script>
        <script src="{{asset('public/assets/js/core/CKEditor.js')}}"></script>
        <script src="{{asset('public/assets/js/core/CKEditor-ar.js')}}"></script>
    -->

<!-- ckrditor يجب عليك نفعيل هذا الكود------------ وقفته مشان السرعة حاليا
ckrditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/translations/ar.js"></script>


<script>
    // This sample still does not showcase all CKEditor 5 features (!)
    // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
    create_save_btn("{{$question->questionlibraries->first()->maincategory->first()->color}}","{{route('save-question',$question->id)}}");
    
    $(document).ready( function() {
        createEditor( 'comment-ckeditor', 'ادخل الاجابة هنا' );
        createEditor( 'reply-ckeditor', 'ادخل التعليق هنا' );
    });
    
   
</script>

<script>
    delete_buttons();
  // ajax_function();

   
   ckeditor_ajax_function();
    
    comm_repl_btns();
    function comm_repl_btns(){
    let c_r_b = document.querySelectorAll(".comment-reply");

    for (let i = 0; c_r_b[i] ; i++) {
      c_r_b[i].onclick=function(){
        let crb_action_data=$(c_r_b[i]).attr('action');
        $(".create-comment-reply-form").attr("action",crb_action_data);
      }
    }
  }


    let ckeditorContent = [...$('.ckeditor-display').children()];
    ckeditorContent.forEach(element => {
        let eleText = element.textContent.replace(/\s/g, "");
        if(eleText.length === 0)
        $(element).remove();
    }); 


    
</script>

@endsection
