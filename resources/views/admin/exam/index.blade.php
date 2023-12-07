@extends('layouts.admin.dashboard')

@section('title','قسم الاختبار')

@section('css')
<style>
    
</style>
@endsection


@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.show',$lesson->course -> id)}}">الكورس {{$lesson->course->title}}</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">اختبار الدرس {{$lesson->title}}</li>
@endsection

@section('content')

    @if($lesson->exams()->count() < 5)
    <div class="m-3 mb-0">
        <!-- من هنا تابع -->
        <button type="button" class="btn rounded-3 bg-gradient-primary mx-1 create-btn" action="{{route('Exam-dashboard.store-question',$lesson->id)}}"
            data-bs-toggle="modal" data-bs-target="#addEditExamQuestion">
            أضافة سؤال جديد
        </button>
    </div>
    @endif


    @if($lesson->count() > 0)

    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">الاختبارات <span class="text-primary">{{$lesson->exams()->count()}} من 5</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr class="text-nowrap">
                        <th class=" text-center fw-bolder">السؤال</th>
                        <th class=" text-center fw-bolder">الأجابة الصحيحة</th>
                        <th class=" text-center fw-bolder">الأجابة الخاطئة 1</th>
                        <th class=" text-center fw-bolder">الأجابة الخاطئة 2</th>
                        <th class=" text-center fw-bolder">الأجابة الخاطئة 3</th>
                        <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @if($lesson->exams()->count() > 0)
                    @foreach($lesson->exams as $exam)
                    <tr id="item-{{$exam->id}}">

                        <td class=" text-center question">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$exam->question}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center question">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$exam->right_answer}}</span>
                            </div>
                        </td>

                        <td class=" text-center question">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$exam->wrong_answer_1}}</span>
                            </div>
                        </td>

                        <td class=" text-center question">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$exam->wrong_answer_2}}</span>
                            </div>
                        </td>

                        <td class=" text-center question">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$exam->wrong_answer_3}}</span>
                            </div>
                        </td>                        

                        <td class=" text-center question">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$exam->created_at->diffForHumans()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">

                                <button id="{{$exam -> id}}" type="button" action="{{route('Exam-dashboard.update',$exam -> id)}}"
                                    class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-warning   edit-btn"
                                    data-bs-toggle="modal" data-bs-target="#addEditExamQuestion">
                                    تعديل
                                </button>
                                <button type="button" action="{{route('Exam-dashboard.destroy',$exam -> id)}}"
                                    class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-danger   delete notification-active"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                </button>
                                                        
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @include('admin.includes.alerts.add-edit-exam-question-modal')
    </div>

    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة اختبارات بعد</div>

    @endif

<!-- 
    
<div class="card px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">الاختبارات <span class="text-primary">{{$lesson->exams()->count()}} من 5</span></h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
    <thead>
            <tr >
                <th class="border-dark text-center text-uppercase font-weight-bolder">السؤال</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الأجابة الصحيحة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الأجابة الخاطئة 1</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الأجابة الخاطئة 2</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الأجابة الخاطئة 3</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">اخر تعديل</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        @if($lesson->exams()->count() > 0)
        @foreach($lesson->exams as $exam)
            <tr id="item-{{$exam->id}}">

                <td class=" text-center question">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$exam->question}}</h6>
                    </div>
                </td>

                <td class=" text-center question">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$exam->right_answer}}</h6>
                    </div>
                </td>

                <td class=" text-center question">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$exam->wrong_answer_1}}</h6>
                    </div>
                </td>

                <td class=" text-center question">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$exam->wrong_answer_2}}</h6>
                    </div>
                </td>

                <td class=" text-center question">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$exam->wrong_answer_3}}</h6>
                    </div>
                </td>
                
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$exam -> created_at->diffForHumans()}}</h6>
                    </div>
                </td>
               
                <td  class=" text-center" >
                    <div class="m-3">
                        
                        <button id="{{$exam -> id}}" action_data="{{route('Exam-dashboard.update',$exam -> id)}}" type="button" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1 edit-btn"
                            data-bs-toggle="modal" data-bs-target="#addEditExamQuestion">
                            <h6 class="text-white m-0">تعديل</h6>
                        </button>
                        
                        <button type="button" action="{{route('Exam-dashboard.destroy',$exam -> id)}}"
                            class="btn text-light btn-danger  border-2 font-weight-bolder mx-1 delete notification-active fs-6"
                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                            حذف 
                        </button>
                        
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
        
    </table>
    </div>

    <div class="col-md-4">
        <!- Button trigger modal ->

        <!- Modal ->
        <div class="modal fade" id="addEditExamQuestion" tabindex="-1" role="dialog" aria-labelledby="addEditExamQuestionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title font-weight-bolder text-danger" id="exampleModalLabel">برجاء إدخال سؤال متخصص بشرح الدرس او ما شابه ذلك</h6>
                        <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                            <span class="font-weight-bolder text-danger fs-5" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" class="edit-create-form-notification">
                        @csrf    
                        
                            <div class="mb-5">
                                <label class="font-weight-bolder m-0 text-end d-block"> السؤال </label>
                                <div class="input-group input-group-outline  m-0">
                                    <input type="text" required name="question" class="font-weight-bolder form-control question">
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="font-weight-bolder m-0 text-end d-block"> الأجابة الصحيحة </label>
                                <div class="input-group input-group-outline  m-0">
                                    <input type="text" required name="right_answer" class="font-weight-bolder form-control question">
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="font-weight-bolder m-0 text-end d-block"> الأجابة الخاطئة 1 </label>
                                <div class="input-group input-group-outline  m-0">
                                    <input type="text" required name="wrong_answer_1" class="font-weight-bolder form-control question">
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="font-weight-bolder m-0 text-end d-block"> الأجابة الخاطئة 2 </label>
                                <div class="input-group input-group-outline  m-0">
                                    <input type="text" required name="wrong_answer_2" class="font-weight-bolder form-control question">
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="font-weight-bolder m-0 text-end d-block"> الأجابة الخاطئة 3 </label>
                                <div class="input-group input-group-outline  m-0">
                                    <input type="text" required name="wrong_answer_3" class="font-weight-bolder form-control question">
                                </div>
                            </div>
                            <button type="submit"  class="btn bg-gradient-primary fs-6 ">ادخال الاختبار</button>
                            <button type="button" class="btn bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

-->
@endsection

@section('script')

<script>


//يجب العمل من هنا والتاكد من جميع الازرار تعمل بشكل صحيح
scroll_to_right();
    delete_buttons();
    ajax_function();

    let question_input=document.querySelectorAll(`.edit-create-form-notification input.question`);
    let form_question_input=document.querySelector(`.edit-create-form-notification`);
    
    let edit_btns = document.querySelectorAll(".edit-btn");
    edit_questions();
    function edit_questions(){
        
        for (let i = 0; edit_btns[i] ; i++) {
            edit_btns[i].onclick=function(){
                let id=$(this).attr('id');
                let action_data=$(this).attr('action');
                let old_question_value=document.querySelectorAll(`#item-${id} td.question`);
                
                $(form_question_input).attr("action",action_data);
                ////يجب غيجاد طريقة لوضع PUT في الفورم عند الضغط على زر تعديل
                $(form_question_input).append(`<input type="hidden" name="_method" value="PUT">`);
                ////
                for (let index = 0; index < 5; index++) {
                    $(question_input[index]).attr('value',old_question_value[index].textContent.trim());//trim() لحذف المسافات الفارغة من بداية ونهاية النص
                }
                
            }
        }
    }

    let edit_create = document.querySelector(".create-btn");
    create_question();
    function create_question(){
        edit_create.onclick=function(){
        question_input.forEach(element => {
            $(element).attr("value",'');
        });
            let action_data=$(edit_create).attr('action');
                
                $(".edit-create-form-notification").attr("action",action_data);
            
        }

    }
    
    
    
</script>

@endsection