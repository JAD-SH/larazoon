@extends('layouts.admin.dashboard')

@section('title','تعديل المقال ')

@section('css')
<style>
   
</style>
@endsection

@section('path')
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('ArticleLibrary-dashboard.index')}}">قسم مكتبة المقالات</a></li>
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('ArticleLibrary-dashboard.show',$article->articlelibrary->id)}}">مكتبة مقالات {{$article->articlelibrary->title}}</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">تعديل المقال {{$article->title}}</li>

@endsection

@section('content')







<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('Article-dashboard.update',$article -> id)}}" method="POST"  enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <input name="id" value="{{$article -> id}}" type="hidden">
  <input name="library_id" value="{{$article->articlelibrary->id}}" type="hidden">
  
  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">تعديل المقال</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان المقال</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"   value="{{$article -> title}}" >
            </div>
            @error('title')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"   value="{{$article -> slug}}" >
            </div>
            @error('slug')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

          <div class="mb-3">
            <div class=" my-3">
                <label for="photo" class="form-label fw-bolder text-dark">صورة المقال (600*1000)</label>
                <input id="photo" type="file" name="photo"  class="form-control rounded-4">
            </div>
            @error('photo')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
          </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="content" class="form-label fw-bolder text-dark">محتوى المقال html</label>
                <textarea style="direction: ltr;" id="content" type="textarea" name="content" class="form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="20">{{$article -> content}}</textarea>
            </div>
            @error('content')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="style" class="form-label fw-bolder text-dark">تنسيق المقال css (اختياري)</label>
                <span class="text-danger fw-bold fs-xs"> ملاحظة : ادخل التنسيق بداخل &lt;style></span>
                <textarea style="direction: ltr;" id="style" type="textarea" name="style" class="form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="20">{{$article -> style}}</textarea>
            </div>
            @error('style')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="script" class="form-label fw-bolder text-dark">سكريبت المقال javascript (اختياري)</label>
                <span class="text-danger fw-bold fs-xs"> ملاحظة : ادخل السكريبت بداخل &lt;script></span>
                <textarea style="direction: ltr;" id="script" type="textarea" name="script" class="form-control border border-dark border-2 p-3 rounded-4 bg-dark text-light" rows="20">{{$article -> script}}</textarea>
            </div>
            @error('script')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="description" class="form-label fw-bolder text-dark">الوصف</label>
                <textarea id="description" type="textarea" name="description" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="5">{{$article -> description}}</textarea>
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



<!--


    <form class="form  mx-2 rounded-3" action="{{route('Article-dashboard.update',$article -> id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h5 class="font-weight-bolder m-2 text-center p-3 border-bottom  border-2">تعديل المقال </h5>
        
        <input name="id" value="{{$article -> id}}" type="hidden">

        <input name="library_id" value="{{$article->articlelibrary->id}}" type="hidden">

        <div class="row px-4">

            <div class="col-md-10  mb-5">
                <h6 class="font-weight-bolder m-2 text-end">عنوان المقال</h6>
                <div class="input-group input-group-outline  my-3">
                    <input type="text"  value="{{$article -> title}}"  name="title" class="font-weight-bolder form-control">
                </div>
                @error('title')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <div class=" col-md-5 mb-5 font-weight-bolde  text-wihte">
                <h6 class="m-2 text-end">الصورة</h6>
                <div class=" border border-secondary rounded-2 border-1 mb-2">
                <input type="file" name="photo" class="form-control form-control-lg" aria-label="مثال على إدخال ملف كبير">
                </div>
                @error('photo')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            
            <div class="col-md-12  mb-5">
                <div class="mb-3 ">
                    <h6 class="font-weight-bolder m-2 text-end">محتوى المقال html</h6>
                    <textarea type="textarea" name="content" class="font-weight-bolder form-control border border-dark border-2 p-3 h6" id="exampleFormControlTextarea1" rows="3">
                    {{$article -> content}}
                    </textarea>
                </div>
                @error('content')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <div class="col-md-10  mb-5">
                <div class="mb-3 ">
                    <h6 class="font-weight-bolder m-2 text-end">الوصف</h6>
                    <textarea type="textarea" name="description" class="font-weight-bolder form-control border border-dark border-2 p-3 h6" id="exampleFormControlTextarea1" rows="3">
                    {{$article -> description}}
                    </textarea>
                </div>
                @error('description')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <div class="form-check form-switch col-md-12 px-3 mb-5 text-center">
                <button type="submit" class="btn btn-primary mx-1">
                    <h6 class="text-white mb-0">حفظ</h6>
                </button>
                <button type="button" class="btn btn-secondary mx-1"
                    onclick="history.back();">
                    <h6 class="text-white mb-0">تراجع</h6>
                </button>
                
            </div>


        </div>
    </form>
    
 -->
@endsection
@section('script')
<script>

       
</script>
@endsection

