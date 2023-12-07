@extends('layouts.admin.dashboard')

@section('title','تعديل كتاب ')

@section('css')
<style>
 
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('BookLibrary-dashboard.index')}}">قسم مكتبة الكتب </a></li>
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('BookLibrary-dashboard.show',$book->booklibrary->id)}}">مكتبة كتب {{$book->booklibrary->title}}</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">تعديل الكتاب {{$book->title}}</li>

@endsection

@section('content')

   




<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('Book-dashboard.update',$book -> id)}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

    <input name="id" value="{{$book -> id}}" type="hidden">
    <input name="library_id" value="{{$book->booklibrary->id}}" type="hidden">
  
  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">تعديل الكتاب</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان الكتاب</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"   value="{{$book -> title}}" >
            </div>
            @error('title')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        
        <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"   value="{{$book -> slug}}" >
            </div>
            @error('slug')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <div class=" my-3">
                <label for="photo" class="form-label fw-bolder text-dark">صورة الكتاب(820*600)</label>
                <input id="photo" type="file" name="photo"  class="form-control rounded-4">
            </div>
            @error('photo')
            <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <div class=" my-3">
                <label for="file" class="form-label fw-bolder text-dark">الكتاب ( PDF)</label>
                <input id="file" type="file" name="file"  class="form-control rounded-4">
            </div>
            @error('file')
            <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="  mb-3">
            <div class=" my-3">
                <label for="language" class="form-label fw-bolder text-dark">لغة الكتاب</label>
                <input id="language" type="text" name="language" class="form-control  rounded-4"   value="{{$book -> language}}" >
            </div>
            @error('language')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="  mb-3">
            <div class=" my-3">
                <label for="author" class="form-label fw-bolder text-dark">مؤلف الكتاب</label>
                <input id="author" type="text" name="author" class="form-control  rounded-4"   value="{{$book -> author}}" >
            </div>
            @error('author')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        
        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="description" class="form-label fw-bolder text-dark">الوصف</label>
                <textarea id="description" type="textarea" name="description" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="5">{{$book -> description}}</textarea>
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
    
    <form class="form  mx-2 rounded-3" action="{{route('Book-dashboard.update',$book -> id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h5 class="font-weight-bolder m-2 text-center p-3 border-bottom  border-2">تعديل كتاب </h5>
        
        <input name="id" value="{{$book -> id}}" type="hidden">

        <input name="library_id" value="{{$book->booklibrary->id}}" type="hidden">

        <div class="row px-4">

            <div class="col-md-10  mb-5">
                <h6 class="font-weight-bolder m-2 text-end">العنوان</h6>
                <div class="input-group input-group-outline  my-3">
                    <label class="form-label">عنوان الكتاب</label>
                    <input type="text"  value="{{$book -> title}}"  name="title" class="font-weight-bolder form-control">
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

            <div class="col-md-10  mb-5">
                <h6 class="font-weight-bolder m-2 text-end">اللغة</h6>
                <div class="input-group input-group-outline  my-3">
                    <label class="form-label">لغة الكتاب</label>
                    <input type="text" value="{{$book -> language}}"  name="language" class="font-weight-bolder form-control">
                </div>
                @error('language')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>
            
            <div class="col-md-10  mb-5">
                <h6 class="font-weight-bolder m-2 text-end">اسم المؤلف</h6>
                <div class="input-group input-group-outline  my-3">
                    <label class="form-label">اسم المؤلف</label>
                    <input type="text" value="{{$book -> author}}"  name="author" class="font-weight-bolder form-control">
                </div>
                @error('author')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>


            <div class="col-md-10  mb-5">
                <div class="mb-3 ">
                    <h6 class="font-weight-bolder m-2 text-end">الوصف</h6>
                    <textarea type="textarea" name="description" class="font-weight-bolder form-control border border-dark border-2 p-3 h6" id="exampleFormControlTextarea1" rows="3">
                    {{$book -> description}}
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

