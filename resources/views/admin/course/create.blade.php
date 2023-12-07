@extends('layouts.admin.dashboard')

@section('title','أنشاء كورس جديد')

@section('css')
<style>
  
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">أنشاء كورس جديد</li>
@endsection

@section('content')







<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


  <form class="form  mx-2 rounded-5" action="{{route('Course-dashboard.store')}}" method="POST">
  @csrf

  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">أنشاء كورس جديد</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="title" class="form-label fw-bolder text-dark">عنوان الكورس</label>
                <input id="title" type="text" name="title" class="form-control  rounded-4"  placeholder="مثال : Css" >
            </div>
            <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
          </div>
        <div class="  mb-3">
            <div class=" my-3">
                <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                <input id="slug" type="text" name="slug" class="form-control  rounded-4"  placeholder="مثال : Css" >
            </div>
            <div id="slug_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
          </div>

          <div class="mb-3">
            <div class=" my-3">
                <label for="photo" class="form-label fw-bolder text-dark">صورة الكورس (600*1000)</label>
                <input id="photo" type="file" name="photo"  class="form-control rounded-4">
            </div>
            <div id="photo_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
          </div>

          
        <div class="  mb-3  ">
            <div class="fw-bolder m-2 text-dark">اللون</div>
            <input type="radio" value="primary" class="btn-check" name="color" id="primary-outlined" autocomplete="off" checked="">
            <label class="btn btn-outline-primary rounded-3 border-2 fw-bolder m-1" for="primary-outlined">primary</label>

            <input type="radio" value="success" class="btn-check" name="color" id="success-outlined" autocomplete="off">
            <label class="btn btn-outline-success rounded-3 border-2 fw-bolder m-1" for="success-outlined">success</label>
            
            <input type="radio" value="info" class="btn-check" name="color" id="info-outlined" autocomplete="off">
            <label class="btn btn-outline-info rounded-3 border-2 fw-bolder m-1" for="info-outlined">info</label>

            <input type="radio" value="warning" class="btn-check tect-dark" name="color" id="warning-outlined" autocomplete="off">
            <label class="btn btn-outline-warning rounded-3 border-2 fw-bolder" for="warning-outlined">warning</label>
            
            <input type="radio" value="danger" class="btn-check" name="color" id="danger-outlined" autocomplete="off">
            <label class="btn btn-outline-danger rounded-3 border-2 fw-bolder m-1" for="danger-outlined">Danger</label>
            
            <div id="color_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
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

    <form class="form  mx-2 rounded-3" action="{{route('Course-dashboard.store')}}" method="POST">
        @csrf
        <h5 class="font-weight-bolder m-2 text-center p-3 border-bottom  border-2">أنشاء كورس جديد</h5>

        <div class="px-4">

            <div class="  mb-5">
                <h6 class="font-weight-bolder m-2 text-end">العنوان</h6>
                <div class="input-group input-group-outline  my-3">
                    <label class="form-label">عنوان الكورس</label>
                    <input type="text" name="title" class="font-weight-bolder form-control">
                </div>
                <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg'></div>
            </div>

            <div class="  mb-5 font-weight-bolde  text-wihte">
                <h6 class="m-2 text-end">الصورة</h6>
                <div class=" border border-secondary rounded-2 border-1 mb-2">
                <input type="file" name="photo" class="form-control form-control-lg" aria-label="مثال على إدخال ملف كبير">
                </div>
                <div id="photo_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg'></div>
            </div>

            <div class="  mb-5  text-end">
                <h6 class="font-weight-bolder m-2">اللون</h6>
                <input type="radio"  value="primary" class="btn-check" name="color" id="primary-outlined" autocomplete="off" checked>
                <label class="btn text-light btn-outline-primary mb-0  border-2 font-weight-bolder" for="primary-outlined">primary</label>

                <input type="radio"  value="success" class="btn-check" name="color" id="success-outlined" autocomplete="off">
                <label class="btn text-light btn-outline-success mb-0  border-2 font-weight-bolder" for="success-outlined">success</label>
                
                <input type="radio"  value="info" class="btn-check" name="color" id="info-outlined" autocomplete="off">
                <label class="btn text-light btn-outline-info mb-0  border-2 font-weight-bolder" for="info-outlined">info</label>

                <input type="radio"  value="warning" class="btn-check tect-dark" name="color" id="warning-outlined" autocomplete="off">
                <label class="btn text-light btn-outline-warning mb-0 border-2 font-weight-bolder" for="warning-outlined">warning</label>
                
                <input type="radio"  value="danger" class="btn-check" name="color" id="danger-outlined" autocomplete="off">
                <label class="btn text-light btn-outline-danger mb-0  border-2 font-weight-bolder" for="danger-outlined">Danger</label>
                
                <div id="color_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg'></div>
            </div>

            <div class="  mb-5">
                <div class="mb-3 ">
                    <h6 class="font-weight-bolder m-2 text-end">الوصف</h6>
                    <textarea type="textarea" name="description" class="font-weight-bolder form-control border border-dark border-2 p-3 h6" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div id="description_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg'></div>
            </div>

           
            <div class="form-check form-switch col-md-12 px-3 mb-5 text-center">
                <button type="button" class="btn btn-primary mx-1  ajax-submit">
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

