@extends('layouts.admin.dashboard')

@section('title','أنشاء درس ملحق جديد')

@section('css')
<style>
   
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Lesson-dashboard.show',$lesson_id)}}">جروب الدروس  </a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">أنشاء درس ملحق جديد</li>
@endsection

@section('content')









<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('LessonAccessor-dashboard.store')}}" method="POST">
  @csrf

  <input name="lesson_id" value="{{$lesson_id}}" type="hidden">
  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">أنشاء درس ملحق جديد</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان الدرس</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"  placeholder="مثال : التحم في تنسيق div" >
            </div>
            <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
          </div>
        <div class="  mb-3">
            <div class=" my-3">
                <label for="about" class="form-label fw-bolder text-dark">وسم - خاصية - كود - دالة</label>
                <input id="about" type="text" name="about" class="form-control  rounded-4"  placeholder="مثال :  <div>">
            </div>
            <div id="about_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
          </div>
        
        <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"  placeholder="مثال : التحم في تنسيق div" >
            </div>
            <div id="slug_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
        </div>
        
        <div class="mb-3">
            <div class=" my-3">
                <label for="photo" class="form-label fw-bolder text-dark">صورة للدرس   (المفضل - 100/55)   (اختياري)</label>
                <input id="photo" type="file" name="photo"  class="form-control rounded-4">
            </div>
            <div id="photo_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="content" class="form-label fw-bolder text-dark">محتوى الدرس html</label>
                <textarea id="content" type="textarea" name="content" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="5"></textarea>
            </div>
            <div id="content_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="description" class="form-label fw-bolder text-dark">الوصف</label>
                <textarea id="description" type="textarea" name="description" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="5"></textarea>
            </div>
            <div id="description_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
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

