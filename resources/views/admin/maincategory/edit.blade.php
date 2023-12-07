@extends('layouts.admin.dashboard')

@section('title','تعديل القسم')

@section('css')
<style>

</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('MainCategory-dashboard.index')}}">الأقسام الرئيسية</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">تعديل قسم {{$maincategory->title}}</li>
@endsection

@section('content')








<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">

  <form class="form  mx-2 rounded-5" action="{{route('MainCategory-dashboard.update',$maincategory -> id)}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <input name="id" value="{{$maincategory -> id}}" type="hidden">
  
  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">تعديل القسم</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان القسم</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"   value="{{$maincategory -> title}}" >
            </div>
            @error('title')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        
        <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"   value="{{$maincategory -> slug}}" >
            </div>
            @error('slug')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <div class=" my-3">
                <label for="light_photo" class="form-label fw-bolder text-dark">صورة القسم(300*1365)</label>
                <input id="light_photo" type="file" name="light_photo"  class="form-control rounded-4">
            </div>
            @error('light_photo')
            <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        
        
        <div class="mb-3">
            <div class=" my-3">
                <label for="dark_photo" class="form-label fw-bolder text-dark">صورة القسم(300*1365)</label>
                <input id="dark_photo" type="file" name="dark_photo"  class="form-control rounded-4">
            </div>
            @error('dark_photo')
            <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        
        <div class="  mb-3">
            <div class=" my-3">
                <label for="icon" class="form-label fw-bolder text-dark">الايقونة</label>
                <input id="icon" type="text" name="icon" class="form-control  rounded-4"   value="{{$maincategory -> icon}}" >
            </div>
            @error('icon')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="  mb-3  ">
            <div class="fw-bolder m-2 text-dark">اللون</div>
            <input type="radio" value="primary" class="btn-check" name="color" id="primary-outlined" autocomplete="off">
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="primary-outlined">primary</label>

            <input type="radio" value="success" class="btn-check" name="color" id="success-outlined" autocomplete="off">
            <label class="btn btn-outline-success rounded-3 border-2 fw-bolder m-1" for="success-outlined">success</label>
            
            <input type="radio" value="info" class="btn-check" name="color" id="info-outlined" autocomplete="off">
            <label class="btn btn-outline-info rounded-3 border-2 fw-bolder m-1" for="info-outlined">info</label>

            <input type="radio" value="warning" class="btn-check" name="color" id="warning-outlined" autocomplete="off">
            <label class="btn btn-outline-warning rounded-3 border-2 fw-bolder" for="warning-outlined">warning</label>
            
            <input type="radio" value="danger" class="btn-check" name="color" id="danger-outlined" autocomplete="off">
            <label class="btn btn-outline-danger rounded-3 border-2 fw-bolder m-1" for="danger-outlined">Danger</label>
            
            @error('color')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>

        <div class="  mb-3">
            <div class="mb-3 ">
                <label for="description" class="form-label fw-bolder text-dark">الوصف</label>
                <textarea id="description" type="textarea" name="description" class="fw-bolder form-control border border-dark border-2 p-3 rounded-4" rows="5">{{$maincategory -> description}}</textarea>
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
    
    <form class="form mx-2 rounded-3" action="{{route('MainCategory-dashboard.update',$maincategory -> id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h5 class="font-weight-bolder m-2 text-center p-3 border-bottom border-2">تعديل القسم</h5>

        <input name="id" value="{{$maincategory -> id}}" type="hidden">
        
        <div class="row  px-4">

            <div class="col-md-10  mb-5">
                <h6 class="font-weight-bolder m-2 text-end">العنوان</h6>
                <div class="input-group input-group-outline  my-3">
                    <input type="text" name="title" value="{{$maincategory -> title}}" class="font-weight-bolder form-control">
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
                <h6 class="font-weight-bolder m-2 text-end">الايقونة <i class="{{$maincategory -> icon}}"></i></h6>
                <div class="input-group input-group-outline  my-3">
                    <input type="text" name="icon" value="{{$maincategory -> icon}}" class="font-weight-bolder form-control">
                </div>
                @error('icon')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <div class="col-md-10  mb-5  text-end">
                <h6 class="font-weight-bolder m-2">اللون</h6>
                <input type="radio"  value="primary" class="btn-check" name="color" id="primary-outlined"  autocomplete="off">
                <label class="btn text-light btn-outline-primary  border-2 font-weight-bolder" for="primary-outlined">primary</label>

                <input type="radio"  value="success" class="btn-check" name="color" id="success-outlined"  autocomplete="off">
                <label class="btn text-light btn-outline-success  border-2 font-weight-bolder" for="success-outlined">success</label>
                
                <input type="radio"  value="info" class="btn-check" name="color" id="info-outlined"  autocomplete="off">
                <label class="btn text-light btn-outline-info  border-2 font-weight-bolder" for="info-outlined">info</label>

                <input type="radio"  value="warning" class="btn-check tect-dark" name="color" id="warning-outlined"  autocomplete="off">
                <label class="btn text-light btn-outline-warning border-2 font-weight-bolder" for="warning-outlined">warning</label>
                
                <input type="radio"  value="danger" class="btn-check" name="color" id="danger-outlined"  autocomplete="off">
                <label class="btn text-light btn-outline-danger  border-2 font-weight-bolder" for="danger-outlined">Danger</label>
                
                @error('color')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <div class="col-md-10  mb-5">
                <div class="mb-3 ">
                    <h6 class="font-weight-bolder m-2 text-end">الوصف</h6>
                    <textarea type="textarea" name="description" class="font-weight-bolder form-control border border-dark border-2 p-3 h6" id="exampleFormControlTextarea1" rows="3">
                    {{$maincategory -> description}}
                    </textarea>
                </div>
                @error('description')
                    <p class='w-100 bg-danger alert text-light m-0 p-2'>
                        <strong class="font-weight-bolder ">{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <div class="form-check form-switch col-md-12 px-3 mb-5 text-center">
                <button type="submit" class="btn btn-primary">
                    <h6 class="text-white mb-0">حفظ</h6>
                </button>
                <button type="button" class="btn btn-secondary mr-1"
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

    let radioList = document.querySelectorAll("input[name=color]");
    let old_color = "{{$maincategory -> color}}";

    for (let i = 0; radioList[i] ; i++) {
        if(radioList[i].getAttribute("value") === old_color){

            radioList[i].checked = true;
        }
        
    }
</script>
@endsection
