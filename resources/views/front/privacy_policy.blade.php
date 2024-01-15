@extends('layouts.front.site')

@section('meta_tags')
    <meta name="robots" content="noindex">
@endsection

@section('title','سياسة الخصوصية')
@section('description','صفحة سياسة الخصوصية هي صفحة تضم السياسة التي يتبعها موقعنا في جمع بيانات الزوار والتعامل معها ولماذا نقوم بجمعها ومع من تتم مشاركة هذه البيانات.')

@section('css')
    <style>
        .all-cont {line-height: 35px;}
         button[aria-expanded='true']{
            color: var(--bs-dark-rgb) !important;
            background-color: var(--bs-card-bg) !important;
        }
        .accordion-item{
            background-color: var(--bs-card-bg) !important;
        }
        .all-content ul li::marker {
            color: #fc6699;
            font-size: 18px;
        }
        ul.cir li {
            list-style: circle !important;
        }
        ul {
            padding-right: 1rem !important;
        }
        .word { 
            color: #e81f62 !important; 
            font-weight: bolder !important;
        }
    </style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">سياسة الخصوصية</li>
@endsection

@section('content')
    <div class="row justify-content-center mb-4">
        <h1 class="fs-3 fw-bolder m-2 p-2 text-center">سياسة الخصوصية</h1>
        <div data-sos-once="true" data-sos="sos-blur" class="col-12 col-md-11 col-lg-9 col-xl-8 position-relative  card align-items-center  p-4 m-4 pb-5 border-0 rounded-5  shadow-sm all-cont" >
            <h2 class="fs-4 fw-bolder mb-2 text-start w-100">صفحة سياسة الخصوصية</h2>
            <div class="fs-5">
                ندرك عزيزي الزائر ان معلوماتك الشخصية هامة وحساسة سواء لك كمستخدم او لنا كمشرفين على موقع <span class="word">{{Site()->ar_site_name}}</span> . لذلك فيما يلي أنواع البيانات التي نجمعها ونتعامل معها في هذا الموقع...
            </div>
            <ul class="">
                <li class="fs-5">عنوان بروتوكول الإنترنت <span class="word">IP Address</span> الخاص بك.</li>
                <li class="fs-5">مزود خدمة الإنترنت <span class="word">ISP</span>.</li>
                <li class="fs-5">نوعية المتصفح التي أستخدمته لزيارة موقعنا وأصداره.</li>
                <li class="fs-5">الوقت الذي قمت فيه بالزيارة.</li>
                <li class="fs-5">نوعية الجهاز الذي قمت فيه بالزيارة (<span class="word">Mobile</span> | <span class="word">Tablet</span> | <span class="word">Computer</span>).</li>
                <li class="fs-5">نوعية نظام التشغيل الذي تستخدمه (<span class="word">Windows</span> | <span class="word">Mac</span> | <span class="word">Android</span> | <span class="word">Linux</span>).</li>
                <li class="fs-5">الصفحات التي قمت بزيارتها عبر موقعنا.</li>
                <li class="fs-5"> ملفات تعريف الأرتباط <span class="word">Cookies</span>.</li>
                <li class="fs-5">ملفات تعريف الأرتباط من <span class="word">Google Analytics</span>.</li>
            </ul>
            <hr class="horizontal  my-3 dark w-100">
            <h2 class="fs-4 fw-bolder mb-2 text-start w-100">الغاية من جمع البيانات</h2>
            <div class="fs-5">
                نقوم بجمع هذه المعلومات لتحسن وتطوير هذا الموقع على المدى البعيد بالإضافة الى ذلك نحن نستحدم أداة تحليل المواقع الرسمية المقدمة من جوجل واسمها <span class="word">Google Analytics</span> ومهمة هذه الأداة تحليل الموقع ككل ونحن نقوم بدراسة هذه التحليلات بغرض التطوير من الموقع والمحتوى والخدمات التي نقدمها عموماً بالإضافة الى هذا إظهار الأعلانات المناسبة لكل مستخدم على حدى.
            </div>
            <hr class="horizontal  my-3 dark w-100">
            <h2 class="fs-4 fw-bolder mb-2 text-start w-100">مع من سنشارك المعلومات الخاصة بك</h2>
            <div class="fs-5">
                موقع <span class="word">{{Site()->ar_site_name}}</span> حريص جداً على سرية المعلومات والبيانات وخاصة البيانات الشخصية الخاصة بالمستخدمين لذلك نضمن لك انه لن يتم مشاركة بياناتك مع اي جهة خارجية بخلاف ما تم ذكره بالأعلى.
            </div>
            <hr class="horizontal  my-3 dark w-100">
        </div>
    </div>

@endsection

@section('script')

@endsection