@extends('layouts.front.site')

@section('css')
    <style>
        .addvertismrnt .card{
            border-radius:  1rem  .25rem .25rem 1rem  !important;
        }
        @media screen and (min-width: 992px){
            .content .content-question .card{
                border-radius: .25rem 1rem 1rem .25rem !important;
            }
            
        } 
        @media screen and (max-width: 992px){
            .addvertismrnt .card{
                
                border-radius: 1rem !important;
                margin: .5rem;
            }
            
        } 

        .coverCKEForm{
            width: 100%;
            height: 100%;
            background: blue;
            position: absolute;
            z-index: 20;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .coverCKEForm .outer-spinner, .coverCKEForm .inner-spinner{
            border-radius: 50%;
            animation-iteration-count: infinite;
			animation-duration: 1.4s;
            position: absolute;
            animation-timing-function: cubic-bezier(0.29, 0.13, 0.28, 0.71);;
        }
        .coverCKEForm .outer-spinner{
            width: 150px;
            height: 150px;
            border:20px solid #dddddd66;
            border-top-color: #3389fc;
            animation-name: oSpin;
        }
        .coverCKEForm .inner-spinner{
            width: 80px;
            height: 80px;
            border:15px solid #dddddd66;
            border-bottom-color: #ff4d89;
            animation-name: iSpin;
        }
        @keyframes oSpin {
			from{
                transform: rotate(0deg);
			}
			to{
                transform: rotate(360deg);
			}
		}
        @keyframes iSpin {
			from{
                transform: rotate(0deg);
			}
			to{
                transform: rotate(-360deg);
			}
		}
    </style>
@endsection

@if($maincategory->questionlibraries()->active()->count() > 0)

    @section('title',$maincategory->title)
    @section('description',$maincategory->description)

    @section('og:url',route($maincategory->route.'.index'))
    @section('og:image',asset($maincategory->photo))
    @section('og:image:url',asset($maincategory->photo))

    @section('path')
        <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$maincategory->title}} <i class="m-auto fa-solid fa-clipboard-question"></i></li>
    @endsection

    @section('content')
    
    @include('front.includes.alerts.title-description-photo', ['category' => $maincategory])

     
        @verify
            @include('front.includes.alerts.delete-modal', ['title_warning' => 'هل حقا تريد حذف هذا السؤال','description_warning' => 'لن تستطيع استعادة السؤال بعد حذفه'])
            <div  class=" m-3 m-md-4">
                <a data-sos-once="true" data-sos="sos-rotateZ" href="#CKEContainer"  class="btn btn-{{$maincategory->color}} m-1 fw-bolder rounded-3">
                    <i class="fa-solid fa-code"></i>  أطرح سؤال أو مشكلة يرمجية 
                </a>
            </div>
        @else
            <div  class="m-3 m-md-4">
                <!-- Button trigger modal -->
                <button data-sos-once="true" data-sos="sos-rotateZ" type="button" class="btn bg-gradient-{{$maincategory->color}} m-1 fw-bolder rounded-3" data-bs-toggle="modal" data-bs-target="#LoginModal">
                    <i class="fa-solid fa-code"></i>  أطرح سؤال أو مشكلة يرمجية 
                </button>

            </div>
        @endverify

        @if($questions->count() > 0)

            <div  data-sos-once="true" data-sos="sos-top"  class="card border-0 text-center mx-1 mb-3 mx-md-4 bg-none  rounded-5 py-4 d-block shadow-sm">
                <a href="{{route('Question.index')}}" class="btn 
                @isset($searchtype)
                    @if($searchtype == 'index')
                        btn-dark
                    @else
                        btn-{{$maincategory->color}}
                    @endif
                @else
                    btn-{{$maincategory->color}}
                @endisset
                    m-1 fw-bolder rounded-3 fs-6">احدث الاسئلة</a>
                <a href="{{route('question-top-likes')}}" class="btn 
                @isset($searchtype)
                    @if($searchtype == 'likes')
                        btn-dark
                    @else
                        btn-{{$maincategory->color}}
                    @endif
                @else
                    btn-{{$maincategory->color}}
                @endisset
                    m-1 fw-bolder rounded-3 fs-6">الاعلى اعجابا</a>
                <a href="{{route('question-top-views')}}" class="btn 
                @isset($searchtype)
                    @if($searchtype == 'views')
                        btn-dark
                    @else
                        btn-{{$maincategory->color}}
                    @endif
                @else
                    btn-{{$maincategory->color}}
                @endisset
                    m-1 fw-bolder rounded-3 fs-6">الاكثر مشاهدة</a>
                @foreach($maincategory->questionlibraries()->active()->get() as $questionlibrary)
                    <a id="{{$questionlibrary->id}}" href="{{route('question-search',$questionlibrary->slug)}}" class="btn 
                    @isset($currentquestionlibrary)
                        @if($questionlibrary ->id == $currentquestionlibrary->id)
                            btn-dark
                        @else
                            btn-{{$maincategory->color}}
                        @endif
                    @else
                        btn-{{$maincategory->color}}
                    @endisset 
                    m-1 fw-bolder rounded-3 fs-6">{{$questionlibrary->title}}</a>
                @endforeach
            </div>

            <div class="row m-0 content  p-0">

                <div class="col-lg-8 content-question">
                    
                    @foreach($questions as $index=>$question)

                        <div data-sos-once="true" data-sos="sos-left"  id="item-{{$question->id}}" class=" position-relative  card d-flex flex-md-row align-items-center  m-1 m-md-4 p-2 p-md-3 py-0  border-0 rounded-5  shadow-sm mb-3" >
                            @if($question->created_at->diffInDays() <= 3)
                                <div class="position-absolute overflow-hidden continer-new-box">
                                    <div class="  w-100 bg-gradient-danger  position-absolute text-white font-weight-bolder text-center text-sm new-box" >جديد</div>
                                </div>
                            @endif
                                <a class="nav-link text-md-start  mx-3 mx-md-0 link-block-idea-side-content" href="{{route('Question.show',$question->slug)}}">
                                    <div class="block-idea-side-content py-2  me-md-3">
                                        <i class="fa-solid fa-question  "></i> 
                                        <div class="block-idea-side {{$maincategory->color}}-block-idea-side"></div>
                                        <div class="block-idea-side {{$maincategory->color}}-block-idea-side"></div>
                                        <div class="block-idea-side {{$maincategory->color}}-block-idea-side"></div>
                                        <div class="block-idea-side {{$maincategory->color}}-block-idea-side"></div>
                                        <div class="block-idea-side {{$maincategory->color}}-block-idea-side"></div>
                                    </div>
                                </a>
                                <div class="py-2 py-md-0 question-all-content">
                                    <a class="nav-link text-md-start  mx-3 mx-md-0 link-block-idea-side-content" href="{{route('Question.show',$question->slug)}}">
                                        <div class="text-dark fw-bolder fs-5 ">
                                            {{$question->title}}
                                            @verify
                                                @if(Auth::user()->id == $question->user_id)
                                                <span class="text-primary fs-6">(أنت)</span>
                                                @endif
                                            @endverify
                                        </div>
                                    </a> 
                                    @verify
                                        @if(Auth::user()->id == $question->user_id)
                                            <a type="button" action="{{route('delete.question', $question->id)}}" style="left: 25px; top: 50px;"
                                            class="delete d-none d-md-inline-block position-absolute trash-can-shook"
                                            data-bs-toggle="modal" data-bs-target="#DeleteModal">
                                            <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                            </a>
                                        @endif
                                    @endverify
                                    <a class="nav-link text-md-start  mx-3 mx-md-0 link-block-idea-side-content" href="{{route('Question.show',$question->slug)}}">
                                        <div class="my-3  m-md-2  mx-3 mx-md-0">
                                            
                                            <span class="badge bg-gradient-{{$maincategory->color}} text-sm text-light rounded-pill"># {{$index+1}} </span>
                                            @foreach($question->questionlibraries as $questionlibrary) 
                                                <span class="badge bg-gradient-{{$maincategory->color}} text-sm text-light rounded-pill"><i class="fa-solid fa-tag"></i> {{$questionlibrary->title}} </span>
                                            @endforeach             
                                        </div>
                                        <div class="m-2 fw-bolder">
                                            <span class="badge text-sm text-secondary"><i class="fa-solid fa-comments text-{{$maincategory->color}} "></i> <span class="text-sm">{{($question->comments->count())+($question->comments()->whereHas('comment_replies')->with('comment_replies')->get()->pluck('comment_replies')->flatten()->count())}} <span class="text-sm d-none d-md-inline-block">اجابات</span></span> </span>
                                            <span class="badge text-sm text-secondary"><i class="fa-sharp fa-solid fa-eye text-{{$maincategory->color}} "></i>  <span class="text-sm">{{$question->views}}</span> <span class="text-sm d-none d-md-inline-block">المشاهدات</span></span>
                                            <span class="badge text-sm text-secondary"><i class="fa-solid fa-heart text-{{$maincategory->color}} "></i>  <span class="text-sm">{{$question->likes}}</span> <span class="text-sm d-none d-md-inline-block">الاعجابات</span></span>
                                            <span class="badge text-sm text-secondary"> <i class="fa-solid fa-calendar-days text-{{$maincategory->color}} px-1"></i><span class="text-sm">{{$question->created_at->diffForHumans()}}</span></span>
                                        </div>
                                    </a>
                                </div>
                            
                        </div>

                    @endforeach
                </div>

                <div  class="col-lg-4  bg-info ps-lg-0 addvertismrnt" style="height:100%;">
                    <div class="card border-0  rounded-5 shadow-sm py-4  p-3 me-lg-4 my-lg-4 text-dark" style="height:500px;">هنا الاعلان</div>
                    <div class="card border-0  rounded-5 shadow-sm py-4  p-3 me-lg-4  my-lg-4 text-dark">هنا الاعلان</div>
                </div>

                <div class=" d-flex align-items-center justify-content-center mt-3">
        
                    {!! $questions ->onEachSide(2)-> links() !!}
                </div>
            </div>

        @endif

        <div id="CKEContainer" data-sos-once="true" data-sos="sos-blur" class="card m-1 m-md-4 py-4 px-2 px-md-3  border-0 rounded-5  shadow-sm mb-3 ">
            <div class="coverCKEForm rounded-4">
                <div class="outer-spinner"></div>
                <div class="inner-spinner"></div>
            </div>
            @verify
                <form id="ckeditorForm" method="POST" action="{{route('create.question')}}">
                    @csrf   
                    <div class="fw-bolder mb-2 text-center pb-4 border-bottom  border-2 fs-4 pt-0 position-relative" style="z-index: 220000 !important;">طرح مشكلة برمجية جديدة</div>
                    <div class="text-danger fw-bolder">برجاء احترام سياسة مجتمعنا</div>
                    
                    <div class="input-group-dynamic my-4">
                        <label for="title" class="fw-bolder fs-6 my-1">عنوان السؤال</label>
                        <div class="input-group input-group-outline  mb-3 mt-1">
                            <input type="text" id="title" name="title" class="fw-bolder text-secondary form-control" placeholder="مثال : كيف اقوم بحل مشكلة تحميل android studio">
                            <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2 rounded-2'></div>
                        </div>
                    </div>

                    <div class="input-group-dynamic my-4">
                        <label class="fw-bolder fs-6 my-1">اختر مكتبات للسؤال</label>
                        <div class=" d-block">
                            
                            @foreach($maincategory->questionlibraries()->active()->get() as $index=>$questionlibrary)
                                <div class="form-check d-inline px-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="questionlibraries[]" type="checkbox" value="{{$questionlibrary->id}}" id="questionlibrary-{{$index}}">
                                        <label class="form-check-label" for="questionlibrary-{{$index}}">{{$questionlibrary->title}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="questionlibraries_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
                    </div>

                    <div class=" my-4">
                        <label class="fw-bolder fs-6 my-1" for="question-ckeditor">ادخل السؤال ادناه</label>
                        <div class="">
                            <div id="question-ckeditor" ></div>
                        </div>
                        <div id="description_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div> 
                    </div>
                    
                    <!--  يجب متابعة بقية العمل في الكونتروللير -->
                    <button  data-sos="sos-rotateZ" class=" ms-3 mt-3 btn rounded-3 bg-gradient-{{$maincategory->color}} fs-6  ckeditor-ajax-submit"  data-editor-id="question-ckeditor" data-editor-name="description">أرسل السؤال</button>
                </form>    
            @else
                <div class="not-allow-to-comment position-relative d-flex justify-content-center align-items-center">
                    <div class="w-100 h-100 opacity-75 bg-white position-absolute" style="z-index:111;"></div>
                    <button type="button" class="btn bg-gradient-{{$maincategory->color}} btn-block my-0 fs-6 rounded-4 position-absolute" data-bs-toggle="modal" data-bs-target="#LoginModal"  style="z-index:112;">
                        سجل الدخول لتتمكن من السؤال
                    </button>
                    <div class=" w-100 ">
                        <div class=" mb-3">
                            <label class="fw-bolder fs-6 my-1 pb-2 text-dark" >السؤال</label>
                            <textarea  rows="3"></textarea>
                        </div>
                        <!--  يجب متابعة بقية العمل في الكونتروللير -->
                        <button data-sos="sos-rotateZ"  class=" mt-3 btn rounded-3 bg-gradient-{{$maincategory->color}} fs-6">أرسل السؤال</button>
                    </div>
                </div>
            @endverify
        </div>
        
    @endsection
@else
    @section('title','الاسئلة')

    @section('path')
        <li class="breadcrumb-item fw-bolder active " aria-current="page">الأسئلة <i class="m-auto fa-solid fa-clipboard-question"></i></li>
    @endsection
    
    @section('content')
        <div data-sos-once="true" data-sos="sos-zoom-in" class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة مكتبة اسئلة بعد .. برجاء العودة لاحقا لتتمكن من طرح الاسئلة </div>
    @endsection
@endif

@section('script')

 
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/translations/ar.js"></script>

  
    <script>

        
    /*$(document).ready( function() {
    });*/
    createEditor( 'question-ckeditor', 'ادخل السؤال هنا' );

    $('#CKEContainer').ready(function() {
        $(".coverCKEForm").fadeOut(500)  
      });

</script>

<script>
    delete_buttons();

    ckeditor_ajax_function();

   
</script>

@endsection
