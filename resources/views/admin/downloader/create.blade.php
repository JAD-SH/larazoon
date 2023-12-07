@extends('layouts.admin.dashboard')

@section('title','أنشاء Downloader جديدة')

@section('css')
<style>
   #code{direction: ltr;}
    
</style>
@endsection


@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">أنشاء Downloader جديدة</li>
@endsection

@section('content')

   


<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">


    <form class="form  mx-2 rounded-5" action="{{route('Downloader-dashboard.store')}}" method="POST">
    @csrf

        <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">أنشاء Downloader جديدة</div>

            <div class="px-4">
        
                <div class="  mb-3">
                    <div class=" my-3">
                        <label for="slug" class="form-label fw-bolder text-dark">slug</label>
                        <input id="slug" type="text" name="slug" class="form-control  rounded-4"  placeholder="مثال : how-much-programers-salery" >
                    </div>
                    <div id="slug_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg'></div>
                </div>
        
                <div class="  mb-3">
                    <div class="mb-3 ">
                        <label for="file" class="form-label fw-bolder text-dark">الملف - Downloader</label>
                        <input id="file" type="file" name="file" class="form-control  rounded-4"  >
                    </div>
                    <div id="file_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
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
        </div>
    </form>
</div>
 
@endsection
@section('script')
<script>

ajax_function();
</script>
@endsection

