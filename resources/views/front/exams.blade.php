@extends('layouts.front.site')

@section('title','أختبار اتمام الكورس '.$course->title)

@section('meta_tags')
    <meta name="robots" content="noindex">
@endsection

@section('css')
    <style>
        ::-webkit-scrollbar-thumb {
            background: var(--bs-{{$course->color}});
        }
        .card p{
            color: #344767;
        }
        .dark-version .card p{
            color:#bfb8b8 !important;
        }
        .correct-option{
            background-color: #8ffd8d9c  !important;
            border:1px solid #09d105  !important;
        }
        div:has(> input[type='radio']){
            border:1px solid #d7d7d700;
        }
        div:has(> input[type='radio']:checked){
            background-color: var(--bs-body-bg);
            border:1px solid var(--bs-text-color);
        }
    </style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('profile')}}"><i class="fa-solid fa-address-card"></i></a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">اختبار اتمام الكورس</li>
@endsection

@section('content')

<div class="card d-flex m-1 m-md-4 p-2 p-md-4 pt-0  border-0 rounded-5  shadow-sm">
    <h1 class=" m-0 p-3 fw-bolder  text-center fs-4">
        أختبار اتمام الكورس <span class="text-{{$course->color}} fs-3 border-2 border-{{$course->color}} border-bottom">{{$course->title}}</span>
    </h1>
    <div class=" card-body pt-2">
        @if($course->exams()->count() > 0)

        <form method="POST" action="{{route('Exam.check-course-answers')}}">
            @csrf    

            <input class="form-control" name="course_id" value="{{$course->id}}" type="hidden">

            <div  class="input-group input-group-outline pt-2 align-items-end">
                @foreach($course->exams as $index=> $exam)
                <div data-sos-once="true" data-sos="sos-blur" class="col-12 all-questions">
                    <div class=" fw-bolder fs-4 py-1 border-start border-3 border-{{$course->color}} ps-1">
                        <span class="text-{{$course->color}} fs-4" style="float: right;">{{$index+1}} -  </span>
                        {{$exam->question}}
                    </div>
                    <div class=" d-grid mt-2">
                        <div class="d-inline-block option ps-2 py-1">
                            <input class="form-check-input mt-2" type="radio" name="{{$exam->id}}" id="" value="{{$exam->right_answer}}" >
                            <div class="d-inline-block mx-2">
                                <label class="form-check-label fs-5" for="">
                                {{$exam->right_answer}}
                                </label>
                            </div>
                        </div>
                        <div class=" d-inline-block option ps-2 py-1">
                            <input class="form-check-input mt-2" type="radio" name="{{$exam->id}}" id="" value="{{$exam->wrong_answer_1}}">
                            <div class="d-inline-block mx-2">
                                <label class="form-check-label fs-5" for="">
                                {{$exam->wrong_answer_1}}
                                </label>
                            </div>
                        </div>
                        <div class=" d-inline-block option ps-2 py-1">
                            <input class="form-check-input mt-2" type="radio" name="{{$exam->id}}" id="" value="{{$exam->wrong_answer_2}}">
                            <div class="d-inline-block mx-2">
                                <label class="form-check-label fs-5" for="">
                                {{$exam->wrong_answer_2}}
                                </label>
                            </div>
                        </div>
                        <div class=" d-inline-block option ps-2 py-1">
                            <input class="form-check-input mt-2" type="radio" name="{{$exam->id}}" id="" value="{{$exam->wrong_answer_3}}">
                            <div class="d-inline-block mx-2">
                                <label class="form-check-label fs-5" for="">
                                {{$exam->wrong_answer_3}}
                                </label>
                            </div>
                        </div>
                        <div id="{{$exam->id}}_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    <hr>
                </div>

                @endforeach
                
            </div>
            <div class=" fw-bolder fs-6 p-1 mb-2 text-end">  بالتوفيق   _{{Auth::user()->name}}_</div>
            <button class="btn bg-gradient-{{$course->color}} fs-6 ajax-submit">أرسل الإجابات</button>
            <button type="button" class="btn bg-gradient-secondary fs-6 mx-2" data-bs-dismiss="modal"  onclick="window.close();">عودة</button>
        </form>
        @else
        <p class=" fw-bolder">لا يوجد اختبار لهذا الدرس بعد الرجاء العودة في وقت لاحق</p>
        <button type="button" class="btn bg-gradient-secondary fs-6 mb-0 mx-2" data-bs-dismiss="modal"  onclick="window.close();">عودة</button>
        @endif
        
    </div>
   
</div>



@endsection


@section('script')

<script>

    let all_questions = [...document.querySelectorAll(".all-questions")];
    let options_question;
    all_questions.forEach(question => {
        
        options_question = [...$(question).find('div .option')];
        options_question.forEach(option => {
            y=Math.floor(Math.random() *20);
            option.style.order=y;
        });
        
    });
    let all_options_inputs = [...document.querySelectorAll(".form-check-input")];
    function show_correct_answers(correctAnswers){
        $("input[type='radio']").attr('disabled','');
        new Map(Object.entries(correctAnswers)).forEach((value,key) => {
          
            $(`input[name='${key}'][value='${value}']`).parent().addClass('correct-option');
        });
        $(".ajax-submit").remove();
    }
//ajax_function();

</script>

@endsection
