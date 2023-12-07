@extends('layouts.admin.dashboard')

@section('title','أنشاء مكتبة جديدة')

@section('css')
<style>
  
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('BookLibrary-dashboard.index')}}">قسم مكتبة الكتب</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">أنشاء مكتبة كتب جديدة</li>
@endsection

@section('content')





<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('BookLibrary-dashboard.store')}}" method="POST">
  @csrf

  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">أنشاء مكتبة كتب جديدة</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان المكتبة</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"  placeholder="مثال : jquery" >
            </div>
            <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
          </div>

        <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"  placeholder="مثال : jquery" >
            </div>
            <div id="slug_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
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



<!--


    <form class="form  mx-2 rounded-3"  action="{{route('BookLibrary-dashboard.store')}}" method="POST">
        @csrf
        <h5 class="font-weight-bolder m-2 text-center p-3 border-bottom  border-2">أنشاء مكتبة كتب جديدة</h5>

        <div class="px-4">

            <div class="  mb-5">
                <h6 class="font-weight-bolder m-2 text-end">العنوان</h6>
                <div class="input-group input-group-outline  my-3">
                    <label class="form-label">عنوان مكتبة الكتب</label>
                    <input type="text" name="title" class="font-weight-bolder form-control">
                </div>
                <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg'></div>
            </div>

            <div class="  mb-5">
                <div class="mb-3 ">
                    <h6 class="font-weight-bolder m-2 text-end">الوصف</h6>
                    <textarea type="textarea" name="description" class="font-weight-bolder form-control border border-dark border-2 p-3 h6" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div id="description_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg'></div>
            </div>

            <div class="form-check form-switch col-md-12 px-3 mb-5 text-center">
                <button type="button" class="btn btn-primary mx-1   ajax-submit">
                    <h6 class="text-white mb-0">حفظ</h6>
                </button>
                <button type="button" class="btn btn-secondary mx-1"
                    onclick="history.back();">
                    <h6 class="text-white mb-0">عودة</h6>
                </button>
                
            </div>


        </div>
    </form>
    
 -->
@endsection
@section('script')
<script>
ajax_function();
   
       
</script>
@endsection

