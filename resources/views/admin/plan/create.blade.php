@extends('layouts.admin.dashboard')

@section('title','أنشاء أختبار')

@section('css')
<style>
  
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Plan-dashboard.index')}}">قسم خطط التعلم</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">انشاء وتعديل خطة التعلم</li>
@endsection

@section('content')

<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">

    <form action="{{route('Plan-dashboard.store-plan-course')}}" method="POST" class="form  mx-2 rounded-5">
        @csrf
        <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">انشاء وتعديل خطة التعلم</div>
        
        <input name="plan_id" value="{{$plan_id}}" type="hidden">

        <div class="px-4">
            <div class="questions-container ">

                
                
            </div>

            <button type="button" id="new_course" class="btn rounded-3 bg-gradient-primary mx-1 " >
                إضافة كورس اخر   
            </button>       
            
            <div class="form-check form-switch col-md-12 px-3 my-4 text-center">
                <button type="submit" id="enter" type="button" class="btn rounded-3 bg-gradient-primary mx-1 ">
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

    let course_count="{{$courses->count()}}";
    $( document ).ready(function() {
        $('#new_course').click();
    });

    let course_number=1;

    function question_content(course_number){
        
           
            
          
        return $('.questions-container').append(`
            <div class="mb-3">
                <div class="my-3">
                    <label for="course_${course_number}" class="form-label fw-bolder border border-2 border-danger text-dark">الكورس  ${course_number}#</label>
                    <select class="form-control rounded-4 " id="course_${course_number}" name="courses[]">
                        @if( $courses->count() > 0)
                        @foreach($courses as $course)
                        <option class="text-dark" value="{{$course->id}}">{{$course->title}}</option>
                        @endforeach
                        @endif
                        
                    </select>
                </div>
            </div>
            `);
//            <div id=" question_${q_number}${q_index}_error " style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg'></div>
    }
    $("#new_course").click(function(){
        
            question_content(course_number);   

        
        course_number++;

        if(course_number > course_count){
            $(this).remove();
            return false;
        }
    });
    
</script>
@endsection

