
@extends('layouts.front.site')


@section('meta_tags')
<meta name="robots" content="noindex">
@endsection
@section('css')
    <style>
        .btn i {
            color:unset !important;
        }
        
        .btn-check:checked+.btn i {
            color: var(--bs-btn-active-color) !important;
        }
        .index{
            animation-name: inIndex;
            animation-duration: 2s;
            transition:all .5s;
            animation-iteration-count: infinite;
            opacity: 0;
             
        }
        
       .text-shadow{
        text-shadow: 1px 1px 1px #ffffff80, -1px -1px 1px #ffffff80;
       }

 
        

    </style>
 @endsection


@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">سجل الداعم</li>
@endsection

@section('content')
    
    <div  class=" m-3 m-md-4">
        <a href="{{route('support-us')}}" id="support" data-sos-once="true" data-sos="sos-rotateZ" class="btn btn-primary m-1 fw-bolder rounded-3 fs-5">
            ادعمنا بالمبلغ الذي تراه مناسبا   
        </a>
    </div> 

    
    @isset($user->supports)
    
        <div class=" m-0 content  p-0">

        @if($user->supports->count() > 0)
            <div class="text-center">
                <div class=" col-md-8 col-lg-6 d-md-inline-block ">
                    <div data-sos-once="true" data-sos="sos-left" class=" position-relative  card m-1 m-md-2 p-3 border-0 rounded-5  shadow-sm mb-3" >
                        <div class="d-flex flex-row justify-content-center pt-2">
                            <div class="col-auto px-0 me-2 d-flex justify-content-center align-items-center">
                                <a href="{{ $user->getPhoto() }}" class=" avatar-xl position-relative  nav-link "  >
                                    <img src="{{ $user->getPhoto() }}" alt="profile_image" class=" w-100 rounded-4  h-100">
                                </a> 
                            </div>      
                            <div class="py-2  d-inline-block">
                                <a href="{{route('show-profile',$user->username)}}" class="nav-link text-md-start text-dark  fw-bolder fs-5  mx-md-0 link-block-idea-side-content">
                                    <span class=" fs-4  " >{{$user->name}}</span>
                                </a>  
                                <p class="mb-1 fw-bolder text-sm text-info " style="font-size: 12px;">
                                    {{$user->interest}}
                                </p>
                            </div>
                        </div> 
                        <div class="pt-4 text-dark d-flex justify-content-evenly">
                            <a class="px-3 py-2" target="_blank" href="{{$user->facebook}}">
                                <i class="fab fa-facebook fa-lg text-info fs-3"></i>
                            </a>
                            <a class="px-3 py-2" target="_blank" href="{{$user->twitter}}">
                                <i class="fab fa-twitter fa-lg text-info fs-3"></i>
                            </a>
                            <a class="px-3 py-2" target="_blank" href="{{$user->instagram}}">
                                <i class="fab fa-instagram fa-lg text-warning fs-3"></i>
                            </a>
                            <a class="px-3 py-2" target="_blank" href="{{$user->github}}">
                                <i class="fab fa-github fa-lg text-dark fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            @foreach($user->supports as $index=>$support)
                <div data-sos-once="true" data-sos="sos-left" class=" position-relative  card m-1 m-md-4 p-3 border-0 rounded-5  shadow-sm mb-3" >
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class=" p-2 fw-bolder fs-4 shadow-sm d-inline-block">
                            {{$support->support_value}}$  
                        </div> 
                        <div class=" p-2 fw-bolder fs-5 shadow-sm float-end d-inline-block">
                            {{$support->support_by}}   
                        </div> 
                        <div class=" p-2  fs-5 shadow-sm d-none d-md-inline-block">
                            {{$support->created_at->diffForHumans()}}   
                        </div> 
                    </div> 
                    @if($support->verification == 1 OR $support->verification == 2)
                        <div class="py-3 fw-normal mb-0 alert bg-gradient-@if($support->verification == 1)danger @elseif($support->verification == 2)success @endif  fs-5" role="alert">
                           {{$support->massage}}   
                        </div>
                    @else
                        <div class="py-3 fw-normal mb-0 alert bg-gradient-secondary  fs-5" role="alert">
                           لم يتم التحقق من دعمك بعد . نعمل بجهد من اجل ذلك   
                        </div>
                    @endif
                    <div class=" p-2 fw-bolder fs-4 shadow-sm d-block d-md-none">
                            {{$support->created_at->diffForHumans()}}   
                        </div> 
                </div>

            @endforeach
                 
        @else
            <div data-sos-once="true" data-sos="sos-zoom-in" class="fs-4 text-center p-5 fw-bolder">لم يدعمنا لحد الان  </div>
        @endif
    @endisset
    </div>


@endsection


@section('script')

<script>
    
</script>

 
@endsection