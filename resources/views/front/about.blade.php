
@extends('layouts.front.site')


@section('meta_tags')
<meta name="robots" content="noindex">
@endsection

@section('css')

    <style>
         button[aria-expanded='true']{
            color: var(--bs-dark-rgb) !important;
            background-color: var(--bs-card-bg) !important;
        }
        .accordion-item{
        background-color: var(--bs-card-bg) !important;

    }
    </style>
 @endsection


@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">حول الموقع</li>
@endsection

@section('content')
   <div class="row text-center justify-content-center my-3">

    <div class="shadow-lg col-12 col-md-10 col-lg-8 col-xl-7 accordion accordion-flush px-0" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne1">
                <button class="accordion-button collapsed text-dark fw-bolder fs-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1" aria-expanded="false" aria-controls="flush-collapseOne1">
                        #1 هل يمكنني ان احول الموقع الى كتاب
                </button>
            </h2>
            <div id="flush-collapseOne1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne1" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body border border-3 border-info fs-5"> يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب <code>.accordion-flush</code>  يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب</div>
            </div>
        </div>
         
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne2">
                <button class="accordion-button collapsed text-dark fw-bolder fs-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne2" aria-expanded="false" aria-controls="flush-collapseOne2">
                        #1 هل يمكنني ان احول الموقع الى كتاب
                </button>
            </h2>
            <div id="flush-collapseOne2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne2" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body border border-3 border-info fs-5"> يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب <code>.accordion-flush</code>  يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب</div>
            </div>
        </div>
         
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne3">
                <button class="accordion-button collapsed text-dark fw-bolder fs-5 py-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne3" aria-expanded="false" aria-controls="flush-collapseOne3">
                        #1 هل يمكنني ان احول الموقع الى كتاب
                </button>
            </h2>
            <div id="flush-collapseOne3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne3" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body border border-3 border-info fs-5"> يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب <code>.accordion-flush</code>  يمكنني ان احول الموقع الى كتاب  يمكنني ان احول الموقع الى كتاب</div>
            </div>
        </div>
         
    </div>

    

@endsection


@section('script')

<script>
    
</script>

 
@endsection