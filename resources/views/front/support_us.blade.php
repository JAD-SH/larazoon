@extends('layouts.front.site')

@section('meta_tags')
    <meta name="robots" content="noindex">
@endsection

@section('css')

@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">ادعم الموقع</li>
@endsection

@section('content')
   <h1 class="  text-info fs-2 text-center mb-5 mt-3">ادعم الموقع</h1>
    <div class="text-center  mb-3">
        <a href=""  class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6">ادعمنا عبر بايبال</a>
        <a  href="" class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6">ادعمنا عبر باتريون</a>
    </div>
    <div class="text-center mb-5">
        @verify
        <a href="{{route('score-support')}}" class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6"  >هل قمت بدعمنا؟ اضغط لتحصل على ترتيب في قائمة الداعمين</a>
        @else
        <button class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6"  data-bs-toggle="modal" data-bs-target="#LoginModal">هل قمت بدعمنا؟ اضغط لتحصل على ترتيب في قائمة الداعمين</button>
        @endverify
    </div>
@endsection

@section('script')

@endsection