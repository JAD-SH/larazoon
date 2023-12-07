@extends('layouts.admin.dashboard')

@section('title','تعديل الدرس ')

@section('css')
<style>
  
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('LessonGroup-dashboard.show',$lesson->group->id)}}">جروب الدروس ({{$lesson->group->title}})</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">تعديل الدرس {{$lesson->title}}</li>
@endsection

@section('content')
 
<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


<form class="form  mx-2 rounded-5" action="{{route('Lesson-dashboard.update',$lesson -> id)}}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<input name="id" value="{{$lesson -> id}}" type="hidden">
<input name="group_id" value="{{$lesson->group->id}}" type="hidden">

<div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">تعديل الدرس</div>

  <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان الدرس</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"   value="{{$lesson -> title}}" >
            </div>
            @error('title')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"   value="{{$lesson -> slug}}" >
            </div>
            @error('slug')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <div class=" my-3">
                <label for="photo" class="form-label fw-bolder text-dark">صورة الدرس   (المفضل - 100/55)   (اختياري)</label>
                <input id="photo" type="file" name="photo"  class="form-control rounded-4">
            </div>
            @error('photo')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
            
        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="content" class="form-label fw-bolder text-dark">محتوى الدرس html</label>
                <textarea style="direction: ltr;" id="content" type="textarea" name="content" class=" form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light " rows="20">{{$lesson -> content}}</textarea>
            </div>
            @error('content')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="style" class="form-label fw-bolder text-dark">تنسيق الدرس css (اختياري)</label>
                <span class="text-danger fw-bold fs-xs"> ملاحظة : ادخل التنسيق بداخل &lt;style></span>
                <textarea style="direction: ltr;" id="style" type="textarea" name="style" class="form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="20">{{$lesson -> style}}</textarea>
            </div>
            @error('style')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="script" class="form-label fw-bolder text-dark">سكريبت الدرس javascript (اختياري)</label>
                <span class="text-danger fw-bold fs-xs"> ملاحظة : ادخل السكريبت بداخل &lt;script></span>
                <textarea style="direction: ltr;" id="script" type="textarea" name="script" class="form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="20">{{$lesson -> script}}</textarea>
            </div>
            @error('script')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="description" class="form-label fw-bolder text-dark">الوصف</label>
                <textarea id="description" type="textarea" name="description" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="5">{{$lesson -> description}}</textarea>
            </div>
            @error('description')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check form-switch col-md-12 px-3 my-4 text-center">
            <button type="submit"  type="button" class="btn rounded-3 bg-gradient-primary mx-1">
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

       
</script>
@endsection

