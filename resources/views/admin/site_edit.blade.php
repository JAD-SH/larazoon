@extends('layouts.admin.dashboard')

@section('title','تعديل بيانات الموقع')

@section('css')
<style>

</style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('dashboard')}}">لوحة التحكم</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">تعديل بيانات الموقع</li>
@endsection

@section('content')

 
<div class="card mx-1 mx-md-3 mt-3 mb-5 border-0 rounded-5 shadow-sm">

  <form class="form  mx-2 rounded-5" action="{{route('Site-dashboard.update')}}" method="POST" enctype="multipart/form-data">
  @csrf
  
  <div class="fw-bolder m-2 text-center p-3 border-bottom fs-4 text-dark border-2">تعديل بيانات الموقع</div>

    <div class="px-4">

        <div class="  mb-3">
            <div class=" my-3">
                <label for="site_name" class="form-label fw-bolder text-dark">اسم الموقع بالانجليزية</label>
                <input id="site_name" type="text" name="site_name" class="form-control  rounded-4"   value="{{Site() -> site_name}}" >
            </div>
            @error('site_name')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
         
        <div class="  mb-3">
            <div class=" my-3">
                <label for="ar_site_name" class="form-label fw-bolder text-dark">اسم الموقع بالعربية</label>
                <input id="ar_site_name" type="text" name="ar_site_name" class="form-control  rounded-4"   value="{{Site() -> ar_site_name}}" >
            </div>
            @error('ar_site_name')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
         
        <div class="  mb-3">
            <div class=" my-3">
                <label for="site_description" class="form-label fw-bolder text-dark">نبذة او وصف عن الموقع</label>
                <input id="site_description" type="text" name="site_description" class="form-control  rounded-4"   value="{{Site() -> site_description}}" >
            </div>
            @error('site_description')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
         
        <div class="mb-3">
            <div class=" my-3">
                <label for="site_photo" class="form-label fw-bolder text-dark">صورة الموقع (المفضل - 100/55)</label>
                <input id="site_photo" type="file" name="site_photo"  class="form-control rounded-4">
            </div>
            @error('site_photo')
            <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
           
        <div class="mb-3">
            <div class=" my-3">
                <label for="site_logo" class="form-label fw-bolder text-dark">لوجو الموقع (600*600)</label>
                <input id="site_logo" type="file" name="site_logo"  class="form-control rounded-4">
            </div>
            @error('site_logo')
            <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
           
        <!--
        <div class="mb-3">
            <div class=" my-3">
                <label for="site_sm_logo" class="form-label fw-bolder text-dark">لوجو صغير للموقع (200)</label>
                <input id="site_sm_logo" type="file" name="site_sm_logo"  class="form-control rounded-4">
            </div>
            @error('site_sm_logo')
            <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
        --> 

        <div class="  mb-3">
            <div class=" my-3">
                <label for="facebook" class="form-label fw-bolder text-dark">رابط facebook</label>
                <input id="facebook" type="text" name="facebook" class="form-control rounded-4" value="{{Site() -> facebook}}" >
            </div>
            @error('facebook')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
 
        <div class="  mb-3">
            <div class=" my-3">
                <label for="twitter" class="form-label fw-bolder text-dark">رابط twitter</label>
                <input id="twitter" type="text" name="twitter" class="form-control rounded-4" value="{{Site() -> twitter}}" >
            </div>
            @error('twitter')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
 
        <div class="  mb-3">
            <div class=" my-3">
                <label for="instagram" class="form-label fw-bolder text-dark">رابط instagram</label>
                <input id="instagram" type="text" name="instagram" class="form-control rounded-4" value="{{Site() -> instagram}}" >
            </div>
            @error('instagram')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
  
        <div class="  mb-3">
            <div class=" my-3">
                <label for="github" class="form-label fw-bolder text-dark">رابط github</label>
                <input id="github" type="text" name="github" class="form-control rounded-4" value="{{Site() -> github}}" >
            </div>
            @error('github')
                <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
            @enderror
        </div>
  
        <div class="mb-3">
            <div class=" my-3">
                <label for="user_profile_background" class="form-label fw-bolder text-dark">صورة خلفية الملف الشخصي للمستخدمين (300*1365)</label>
                <input id="user_profile_background" type="file" name="user_profile_background"  class="form-control rounded-4">
            </div>
            @error('user_profile_background')
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
