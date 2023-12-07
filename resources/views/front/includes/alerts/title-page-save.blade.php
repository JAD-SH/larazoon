
<div data-sos-once="true" data-sos="sos-left" class="m-1 m-md-4 my-2">

    <div class="bg-gradient-{{$color}} d-inline-block my-0 py-1 px-3 fs-6 rounded-4 fw-bolder mx-1 text-light  ">
        {{$librarytitle}} <i class="fa-solid fa-tag"></i> 
    </div>
    <div class="bg-gradient-{{$color}} d-inline-block my-0 py-1 px-3 fs-6 rounded-4 fw-bolder mx-1 text-light ">
        {{$createdat}}  <i class="fa-solid fa-calendar-days text-light "></i>
    </div>
</div>


<div data-sos-once="true" data-sos="sos-zoom-out" class="card m-1 m-md-4 page-title p-2 p-md-3  border-0 rounded-5 shadow-sm bg-gradient-{{$color}}">
    <h1 class="text-center text-light fs-4 mb-0">{{$title}}</h1>
</div>


@verify

    <form action="{{$saveroute}}" method="POST">
        @csrf
        <button data-sos-once="true" data-sos="sos-right" id="save-items-continer" class=" bg-gradient-{{$color}} position-fixed rounded-1 d-none d-lg-block ajax-submit">
            <i id="save-items-btn" class="fa-solid fa-plus text-white p-3 "></i>
        </button>
    </form>
@else
    <button data-sos-once="true" data-sos="sos-right" id="save-items-continer" class=" bg-gradient-{{$color}} position-fixed rounded-1 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#LoginModal" >
        <i id="save-items-btn" class="fa-solid fa-plus text-white p-3 "></i>
    </button>
@endverify