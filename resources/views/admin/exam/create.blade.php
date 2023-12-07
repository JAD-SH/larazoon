@extends('layouts.admin.dashboard')

@section('title','أنشاء أختبار')

@section('css')
<style>
  
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">اختبار الدرس {{$lesson_id}}</li>
@endsection

@section('content')


<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">
    <form action="{{route('Exam-dashboard.store')}}" method="POST" class="form  mx-2 rounded-5" id="lesson_create">
        @csrf
        <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">أنشاء أختبار</div>
        
        <input name="lesson_id" value="{{$lesson_id}}" type="hidden">

        <div class="px-4">
            <div class="fw-bolder text-danger my-3 fs-6">
                نظام الاختبارات هو اختيار من متعدد لذلك يرجى إضافة جواب واحد صحيح وبقية الاحتمالات خاطئة ويمكنك فقط إضافة 5 اسئلة لكل درس
            </div>
            
            <div class="questions-container  ">

                
                
            </div>

            <button type="button" id="new_question" class="btn rounded-3 bg-gradient-primary mx-1 ">
                إضافة سؤال اخر
            </button>    

            <div class="form-check form-switch col-md-12 px-3 my-4 text-center">
                <button type="submit" class="btn rounded-3 bg-gradient-primary mx-1 ">
                    حفظ
                </button>
                <button type="button" class="btn rounded-3 bg-gradient-secondary mr-1" onclick="window.close();">
                    تراجع
                </button>
                
            </div>

        </div>
    </form>
</div>
@endsection

@section('script')

<script>

    //ajax_function();
    
    $( document ).ready(function() {
        $('#new_question').click();
    });

    let question_number=1;

    let x;

    let y;

    function question_content(q_number , q_index){
        
        if(q_index ==0){
            x=`<span class="border border-2 border-danger text-dark">السؤال <span class="text-primary">${q_number}</span></span> ` ;
        }
        if(q_index ==1){
            x=`الجواب الصحيح ` ;
        }
        if(q_index ==2){
            x=`جواب خاطئ <span class="text-primary">${q_index-1}</span> ` ;
        }
        if(q_index ==3){
            x=`جواب خاطئ <span class="text-primary">${q_index-1}</span>  ` ;
        }
        if(q_index ==4){
            x=`جواب خاطئ <span class="text-primary">${q_index-1}</span>  ` ;
        }
           
            
          
        return $('.questions-container').append(`<div class="mb-3">
                <div class="my-3">
                    <label for="${q_number}-${q_index-1}" class="form-label fw-bolder text-dark">${x}</label>
                    <input id="${q_number}-${q_index-1}" type="text" required name=" question_${q_number}[] " class="form-control rounded-4">
                </div>
            </div>`);
//            <div id=" question_${q_number}${q_index}_error " style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg'></div>
    }
    $("#new_question").click(function(){
        
        for (let index = 0; index < 5; index++) {    
            question_content(question_number, index);   
        }

        
        question_number++;

        if(question_number == 6){
            $(this).remove();
            return false;
        }
    });
    
       
</script>
@endsection

