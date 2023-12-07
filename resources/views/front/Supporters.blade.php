
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


       @media screen and (min-width: 767px){
            
        

            .dollars{
                animation-name: inScale;
                animation-duration: 2s;
                transition:all .5s;
                animation-iteration-count: infinite;
            }

            @keyframes inScale {
                0% {scale: 1;}
                50% {scale: 1.5;}
                100% {scale: 1;}
            }
        }
@keyframes inIndex {
    0%   { opacity: 0; display:none;}
  
     50% {  opacity: 1; display:block;}
     100% {  opacity: 0; display:none;}
}

        
.sscaallee:hover{
    scale:1.1;
}
    </style>
 @endsection


@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">الداعمين الأساطير</li>
@endsection

@section('content')
   
@isset($top_supporters)
    @if($top_supporters->count() > 0)
        <p class="fw-bolder fs-4" for="support">ادعمنا ب (@if($top_supporters[0] !== null) <span class="text-info fs-4">{{$top_supporters[0]->support_value+1}} $</span> @else 1 @endif) لتحصل على المرتبة العظمى <span class="fs-4 text-info">#1</span> في المستوى الالماسي</p>
    @else
        <p class="fw-bolder fs-4" for="support">كن اول الداعمين اذا رأيت موقعنا يستحق</p>
    @endif
@endisset

@isset($all_supporters)
    @if($all_supporters->count() > 0)
        <p class="fw-bolder fs-4" for="support">ادعمنا لتحصل على المرتبة العظمى <span class="fs-4 text-info">#1</span> في المستوى الالماسي</p>
    @else
        <p class="fw-bolder fs-4" for="support">كن من الداعمين اذا رأيت ان موقعنا يستحق</p>
    @endif
@endisset
      
    <div  class=" m-3 m-md-4">
        <a href="{{route('support-us')}}" id="support" data-sos-once="true" data-sos="sos-rotateZ" class="btn btn-primary m-1 fw-bolder rounded-3 fs-5">
            ادعمنا بالمبلغ الذي تراه مناسبا   
        </a>
    </div> 

    
    @isset($top_supporters)
    
        <div class=" m-0 content  p-0">

        @if($top_supporters->count() > 0)
            <div class=" ">
                
                @foreach($top_supporters as $index=>$supporter)
                    <div class="m-2 mb-3 m-md-4" data-sos-once="true" data-sos="sos-right" >
                        @if($index == 0)
                        <i class="fa-solid fa-gem  fs-1 px-2 text-info"></i> <span class="fs-1 fw-bolder text-info">الالماسي</span>
                        @elseif($index == 3)
                        <i class="fa-solid fa-crown  fs-2 px-2 text-warning"></i> <span class="fs-2 fw-bolder text-warning">الذهبي</span>
                        @elseif($index == 6)
                        <i class="fa-solid fa-cubes  fs-3 px-2 text-secondsry"></i> <span class="fs-3 fw-bolder text-secondsry">الفضي</span>
                        @elseif($index == 9)
                        <i class="fa-solid fa-square  fs-4 px-2 text-danger"></i> <span class="fs-4 fw-bolder text-danger">البرونزي</span>
                        @endif
                    </div>
                    <div data-sos-once="true" data-sos="sos-left" class="@if($index >= 0 && $index <= 2)bg-gradient-info @endif position-relative  card m-1 m-md-4 p-3 border-0 rounded-5  shadow-sm mb-3" >
                        <div class="d-block d-md-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row">
                                <div class="col-auto px-0 me-2 d-flex justify-content-center align-items-center">
                                    <a href="{{ $supporter->user->getPhoto() }}" class=" avatar-xl position-relative  nav-link "  >
                                        <img src="{{ $supporter->user->getPhoto() }}" alt="profile_image" class="@if($index >= 0 && $index <= 2) text-shadow @endif w-100 rounded-4 h-100">
                                        <!-- <div class=" position-absolute bg-light d-none d-md-block"  style=" top:0; left:0; border-radius: 50%">
                                            <i class="fa-solid fa-messages-question" style="font-size:74px !important; "></i> 
                                        </div>
                                        -->
                                        <span class="position-absolute fw-bolder @if($index >= 0 && $index <= 2) index  @endif  text-shadow fs-5 text-info d-none d-md-inline-block" style="top:0; right:5px;">#{{$index+1}}</span>
                                        <span class="position-absolute fw-bolder  text-shadow   fs-4 text-info d-md-none" style="top:0; right:5px;">#{{$index+1}}</span>
                                    </a> 
                                </div>      
                                <div class="py-2  ">
                                    <a href="{{route('show-profile',$supporter->user->username)}}" class="nav-link text-md-start text-dark @if($index >= 0 && $index <= 2) text-shadow @endif fw-bolder fs-5 mx-3 mx-md-0 link-block-idea-side-content">
                                        <span class=" fs-4  "@if($index >= 0 && $index <= 2)  style="color:#515151 !important;"  @endif>{{$supporter->user->name}}</span>
                                        @verify
                                            @if(Auth::user()->id == $supporter->user->id)
                                                <span class="text-primary fs-6 ">(أنت)</span>
                                            @endif
                                        @endverify
                                    </a>  
                                    <p class="mb-1 fw-bolder text-sm text-info @if($index >= 0 && $index <= 2)   text-light @endif" style="font-size: 12px;">
                                        {{$supporter->user->interest}}
                                    </p>
                                </div>
                            
                            </div>
                            <div class="d-flex d-md-none my-3  p-2 justify-content-between shadow-sm">
                                <span class=" fs-5 px-2 fw-bolder @if($index >= 0 && $index <= 2) text-light @endif">{{$supporter->support_by}}</span>
                                <div class="fw-bolder fs-5 px-2  @if($index >= 0 && $index <= 2) text-light @endif">
                                    @if($index >= 0 && $index <= 2)
                                <i class="fa-solid fa-gem  fs-5 px-2 text-info"></i> 
                                @elseif($index >= 3 && $index <= 5)
                                <i class="fa-solid fa-crown  fs-5 px-2 text-warning"></i> 
                                @elseif($index >= 6 && $index <= 8)
                                <i class="fa-solid fa-cubes  fs-5 px-2 text-secondsry"></i> 
                                @elseif($index >= 9 && $index <= 11)
                                <i class="fa-solid fa-square  fs-5 px-2 text-danger"></i> 
                                @endif
                                {{$supporter->support_value}} $</div>
                                  
                            </div> 
                            
                            <div class="p-2 fw-bolder text-light d-flex justify-content-center align-items-center">
                                @if($supporter->user->facebook !== null)
                                <a class="m-1 shadow p-2" target="_blank" href="{{$supporter->user->facebook}}">
                                    <i class="fab fa-facebook fa-lg text-info fs-2"></i>
                                </a>
                                @endif 
                                @if($supporter->user->twitter !== null)
                                <a class="m-1 shadow p-2" target="_blank" href="{{$supporter->user->twitter}}">
                                    <i class="fab fa-twitter fa-lg text-info fs-2"></i>
                                </a>
                                @endif 
                                @if($supporter->user->instagram !== null)
                                <a class="m-1 shadow p-2" target="_blank" href="{{$supporter->user->instagram}}">
                                    <i class="fab fa-instagram fa-lg text-warning fs-2"></i>
                                </a>
                                @endif 
                                @if($supporter->user->github !== null)
                                <a class="m-1 shadow p-2" target="_blank" href="{{$supporter->user->github}}">
                                    <i class="fab fa-github fa-lg text-dark fs-2"></i>
                                </a>
                                @endif 
                            </div> 
                            <div class="d-none d-md-inline-block @if($index >= 0 && $index <= 2) text-light @endif p-2 fw-bolder fs-5 shadow-sm">
                                {{$supporter->support_by}}  
                            </div> 
                            <div class="d-none d-md-inline-block @if($index >= 0 && $index <= 2) dollars text-light @endif p-2 fw-bolder fs-5 shadow-sm">
                                 
                                @if($index >= 0 && $index <= 2)
                                <i class="fa-solid fa-gem  fs-5 px-2 text-info"></i> 
                                @elseif($index >= 3 && $index <= 5)
                                <i class="fa-solid fa-crown  fs-5 px-2 text-warning"></i> 
                                @elseif($index >= 6 && $index <= 8)
                                <i class="fa-solid fa-cubes  fs-5 px-2 text-secondsry"></i> 
                                @elseif($index >= 9 && $index <= 11)
                                <i class="fa-solid fa-square  fs-5 px-2 text-danger"></i> 
                                @endif
                                {{$supporter->support_value}}$  
                            </div> 
                        </div> 
                    </div>

                @endforeach
                <div  class=" m-3 m-md-4 text-center">
                    <a href="{{route('all_supporters_page')}}" data-sos-once="true" data-sos="sos-rotateZ" class="btn btn-primary m-1 fw-bolder rounded-3 fs-5">
                        بقية الداعمين     
                    </a>
                </div> 
            </div>
        @else
            <div data-sos-once="true" data-sos="sos-zoom-in" class="fs-4 text-center p-5 fw-bolder">لم يتم دعم الموقع بعد من المستخدمين <i class="fa-solid fa-face-sad-tear fs-2 text-warning"></i></div>
        @endif
    @endisset
    @isset($all_supporters)
    
        <div class=" m-0 content  p-0">

        @if($all_supporters->count() > 0)
            <div class=" ">
                
                @foreach($all_supporters as $index=>$supporter)
                     
                    <div data-sos-once="true" data-sos="sos-left" class=" position-relative  card m-1 m-md-4 p-3 border-0 rounded-5  shadow-sm mb-3" >
                        <div class="d-block d-md-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row">
                                <div class="col-auto px-0 me-2 d-flex justify-content-center align-items-center">
                                    <a href="{{ $supporter->user->getPhoto() }}" class=" avatar-xl position-relative  nav-link "  >
                                        <img src="{{ $supporter->user->getPhoto() }}" alt="profile_image" class=" w-100 rounded-4 h-100">
                                        <div class=" position-absolute bg-light d-none d-md-block"  style=" top:0; left:0; border-radius: 50%">
                                            <i class="fa-solid fa-messages-question" style="font-size:74px !important; "></i> 
                                        </div>
                                        <span class="position-absolute fw-bolder  text-shadow fs-5 text-info d-none d-md-inline-block" style="top:0; right:5px;">#{{$index+1}}</span>
                                        <span class="position-absolute fw-bolder  text-shadow   fs-4 text-info d-md-none" style="top:0; right:5px;">#{{$index+1}}</span>
                                    </a> 
                                </div>      
                                <div class="py-2  ">
                                    <a href="{{route('show-profile',$supporter->user->username)}}" class="nav-link text-md-start text-dark  fw-bolder fs-5 mx-3 mx-md-0 link-block-idea-side-content">
                                        <span class=" fs-4  " >{{$supporter->user->name}}</span>
                                        @verify
                                            @if(Auth::user()->id == $supporter->user->id)
                                                <span class="text-primary fs-6 ">(أنت)</span>
                                            @endif
                                        @endverify
                                    </a>  
                                    <p class="mb-1 fw-bolder text-sm text-info " style="font-size: 12px;">
                                        {{$supporter->user->interest}}
                                    </p>
                                </div>
                            
                            </div>
                            <div class="d-flex justify-content-between d-md-none my-2 p-2  shadow-sm">
                                <span class="fw-bolder fs-5"> {{$supporter->support_by}} </span>
                                <span class="fw-bolder fs-5"> {{$supporter->support_value}}$   </span>
                            </div> 
                            <div class="p-2 fw-bolder text-light d-flex justify-content-center align-items-center">
                                @if($supporter->user->facebook !== null)
                                <a class="m-1 shadow p-2" target="_blank" href="{{$supporter->user->facebook}}">
                                    <i class="fab fa-facebook fa-lg text-info fs-2"></i>
                                </a>
                                @endif 
                                @if($supporter->user->twitter !== null)
                                <a class="m-1 shadow p-2" target="_blank" href="{{$supporter->user->twitter}}">
                                    <i class="fab fa-twitter fa-lg text-info fs-2"></i>
                                </a>
                                @endif 
                                @if($supporter->user->instagram !== null)
                                <a class="m-1 shadow p-2" target="_blank" href="{{$supporter->user->instagram}}">
                                    <i class="fab fa-instagram fa-lg text-warning fs-2"></i>
                                </a>
                                @endif 
                                @if($supporter->user->github !== null)
                                <a class="m-1 shadow p-2" target="_blank" href="{{$supporter->user->github}}">
                                    <i class="fab fa-github fa-lg text-dark fs-2"></i>
                                </a>
                                @endif 
                            </div>   
                            <div class="d-none d-md-inline-block p-2 fw-bolder fs-5 shadow-sm ">
                                {{$supporter->support_by}} -  <span class="float-end fs-5"> {{$supporter->support_value}}$</span> 
                            </div> 
                             
                        </div> 
                    </div>

                @endforeach
                 
            </div>
        @else
            <div data-sos-once="true" data-sos="sos-zoom-in" class="fs-4 text-center p-5 fw-bolder">كن من الداعمين اذا رأيت ان موقعنا يستحق  </div>
        @endif
    @endisset
    
    </div>


@endsection


@section('script')

<script>
    
</script>

 
@endsection