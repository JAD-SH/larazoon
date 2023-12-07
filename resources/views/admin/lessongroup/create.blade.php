@extends('layouts.admin.dashboard')

@section('title','أنشاء درس جديد')

@section('css')
<style>
   
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.show',$course_id)}}">الكورس  </a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">أنشاء جروب دروس جديد</li>
@endsection

@section('content')
 
<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('LessonGroup-dashboard.store')}}" method="POST">
  @csrf
  <input name="course_id" value="{{$course_id}}" type="hidden">
  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">أنشاء جروب جديد</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان الجروب</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"  placeholder="مثال : مقدمة" >
            </div>
            <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
          </div>
          
        <div class="form-check form-switch col-md-12 px-3 my-4 text-center">
            <button type="button" class="btn rounded-3 bg-gradient-primary mx-1 ajax-submit">
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
ajax_function(); 
</script>
@endsection

