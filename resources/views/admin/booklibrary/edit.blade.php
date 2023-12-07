@extends('layouts.admin.dashboard')

@section('title','تعديل المكتبة ')

@section('css')
<style>
   form{ 
    background-color:white !important;
    }
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('BookLibrary-dashboard.index')}}">قسم مكتبة الكتب </a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">تعديل مكتبة الكتب {{$booklibrary->title}}</li>

@endsection

@section('content')








<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('BookLibrary-dashboard.update',$booklibrary -> id)}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <input name="id" value="{{$booklibrary -> id}}" type="hidden">
  
  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">تعديل مكتبة الكتب</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان المكتبة</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"   value="{{$booklibrary -> title}}" >
            </div>
            @error('title')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"   value="{{$booklibrary -> slug}}" >
            </div>
            @error('slug')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="description" class="form-label fw-bolder text-dark">الوصف</label>
                <textarea id="description" type="textarea" name="description" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="5">{{$booklibrary -> description}}</textarea>
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
    

    <form class="form  mx-2 rounded-3" action="{{route('BookLibrary-dashboard.update',$booklibrary -> id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h5 class="font-weight-bolder m-2 text-center p-3 border-bottom  border-2">تعديل المكتبة </h5>
        
        <input name="id" value="{{$booklibrary -> id}}" type="hidden">

        <div class="row px-4">

            <div class="col-md-10  mb-5">
                <h6 class="font-weight-bolder m-2 text-end">العنوان</h6>
                <div class="input-group input-group-outline  my-3">
                    <label class="form-label">عنوان المكتبة</label>
                    <input type="text" value="{{$booklibrary -> title}}"  name="title" class="font-weight-bolder form-control">
                </div>
                @error('title')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>

        
            <div class="col-md-10  mb-5">
                <div class="mb-3 ">
                    <h6 class="font-weight-bolder m-2 text-end">الوصف</h6>
                    <textarea type="textarea"   name="description" class="font-weight-bolder form-control border border-dark border-2 p-3 h6" id="exampleFormControlTextarea1" rows="3">
                    {{$booklibrary -> description}}
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
/*
const radioList = document.querySelectorAll("input[name=color]");
    const color = "{{$booklibrary -> color}}";

    for (let i = 0; radioList[i] ; i++) {
        if(radioList[i].getAttribute("value") === color){

            radioList[i].checked = true;
        }
        
    }
    */   
</script>
@endsection

