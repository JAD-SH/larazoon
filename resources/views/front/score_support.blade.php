
@extends('layouts.front.site')


@section('meta_tags')
<meta name="robots" content="noindex">
@endsection

@section('css')

    <style>
         .form-check{
            line-height: 15px;
         }
    </style>
 @endsection


@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">سجل في ترتيب الداعمين</li>
@endsection

@section('content')
   <h1 class="  text-info fs-2 text-center mb-5 mt-3">انت الان في طور التسجيل على ترتيب في قسم الداعمين</h1>
    <div class="text-center  mb-3  m-1 m-md-4 py-4 px-2 px-md-3  ">
        <p class="fs-5 fw-bolder">عزيزي <span class="text-info fs-5">{{Auth::user()->name}}</span> بعد عملية دعم الموقع يمكنك اذا اردت ان تحصل على ترتيب في قسم الداعمين وكلما كانت قيمة دعمك اكبر كلما حصلت على ترتيب اعلى ... وبعد قيامك بدعم الموقع يجب عليك ادخال بيانات الدعم لتحصل على ترتيب في قسم الداعمين وبعدها في مدة اقصاها 24 ساعة سنرسل لك رسالة تأكيد على ملف الشخصي مضمونها نجاح عملية ادخالك في ترتيب الداعمين وشكرا.</p>
    </div>
     
    <div data-sos-once="true" data-sos="sos-blur" class="card m-1 m-md-4 py-4 px-2 px-md-3  border-0 rounded-5  shadow-sm mb-3 ">
        <form class="" id="ckeditorForm" method="POST" action="{{route('save-score-support')}}">
            @csrf   
            <div class="d-lg-flex justify-content-around text-center my-4">

                <div class="col-11 col-md-7 col-lg-5 d-inline-block">
                    <label for="email" class="fw-bolder fs-5 my-2 float-start">البريد الالكتروني الداعم</label>
                    <div class="input-group input-group-outline  mb-3 mt-1">
                        <input type="email" id="email" name="email" class="fs-5 text-secondary form-control rounded-1" placeholder="مثال : example@example.com ">
                     </div>
                    @error('email')
                        <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-11 col-md-7 col-lg-5 d-inline-block ">
                    <label for="support_value" class="fw-bolder fs-5 my-2 float-start">قيمة الدعم المادي الذي قدمته لنا ب <span class=" text-info mx-2 fs-5">$</span> او <span class=" text-info mx-2 fs-5">€</span></label>
                    <div class="input-group input-group-outline  mb-3 mt-1">
                        <input type="number" id="support_value" name="support_value" class="fw-bolder text-secondary form-control  rounded-1" >
                    </div>
                    @error('support_value')
                    <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-11 col-md-7 col-lg-5 d-block mx-auto">
                <label for="support_by" class="fw-bolder fs-5 my-2 float-start">وسيلة الدعم</label>
                <div class="input-group input-group-outline justify-content-around mb-3 mt-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="patreon" name="support_by" id="patreon" checked>
                        <label class="form-check-label fs-5 fw-bolder" for="patreon">
                            Patreon
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="paypal" name="support_by" id="paypal">
                        <label class="form-check-label fs-5 fw-bolder" for="paypal">
                            Paypal
                        </label>
                    </div>
                </div>
                @error('support_by')
                    <div class='bg-danger text-white m-0 p-2 fw-bolder w-100'>{{ $message }}</div>
                @enderror
            </div>
            <!--  يجب متابعة بقية العمل في الكونتروللير -->
            <button data-sos="sos-rotateZ" type="submit" class="d-block ms-3 mt-3 btn rounded-3 bg-gradient-info fs-6 "  >طلب الترتيب</button>
        </form> 
    </div>
@endsection


@section('script')

<script>
    
</script>

 
@endsection