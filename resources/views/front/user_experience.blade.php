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
        .reaction-icon{
            animation-name: inReaction;
            animation-duration: 2s;
            transition:all .5s;
            animation-iteration-count: infinite;
            opacity: 0;
            transform: scale3d(1.5, 1.5, 1.5);
            
        }
        @keyframes inReaction {
            0%  { opacity: 0; display:none;}
            50% { opacity: 1; display:block;}
            100% {  opacity: 0; display:none;}
        }
    </style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">تجارب المستخدمين بالموقع</li>
@endsection

@section('content')
   
@verify
    @include('front.includes.alerts.delete-modal', ['title_warning' => 'هل حقا تريد حذف هذه التجربة','description_warning' => 'لن تستطيع استعادة التجربة بعد حذفها'])
    <div class="modal fade" id="CreateExperienceModal" tabindex="-1" role="dialog" aria-labelledby="CreateExperienceModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
                <div class="modal-header p-0 pb-3">
                    <h6 class="modal-title fw-bolder fs-6 text-danger" id="exampleModalLabel">برجاء احترام سياسة مجتمعنا في التواصل</h6>
                    <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                        <span class="font-weight-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="create-message-form text-start" method="POST"  action="{{route('user_experience_stor')}}">
                        @csrf    
                        <div class="  mb-3  ">
                            <div class="fw-bolder m-2 text-dark">ردة فعلك</div>
                            <div class="d-flex">
                                <input type="radio" value="1" class="btn-check" name="reaction" id="sad" autocomplete="off" >
                                <label class="btn btn-outline-danger rounded-5 fw-bolder m-1 w-25" for="sad"><i class="fa-solid fa-face-sad-tear fs-1"></i></label>
                                
                                <input type="radio" value="2" class="btn-check" name="reaction" id="normal" autocomplete="off">
                                <label class="btn btn-outline-warning rounded-5 fw-bolder m-1 w-25" for="normal"><i class="fa-solid fa-meh fs-1"></i></label>
                                
                                <input type="radio" value="3" class="btn-check" name="reaction" id="happy" autocomplete="off">
                                <label class="btn btn-outline-info rounded-5 fw-bolder m-1 w-25" for="happy"><i class="fa-solid fa-sharp fa-light fa-face-smile fs-1"></i></label>
                                
                                <input type="radio" value="4" class="btn-check tect-dark" name="reaction" id="very-happy" autocomplete="off" checked="">
                                <label class="btn btn-outline-success rounded-5 fw-bolder m-1 w-25" for="very-happy"><i class="fa-solid fa-face-grin-hearts fs-1"></i></label>
                            </div>
                            <div id="reaction_error" style="display:none;" class="bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg"></div>
                        </div>
                        <label for="experience" class="fw-bolder fs-6 my-1 pb-2 text-dark">اشرح تجربتك</label>
                        <div class="input-group input-group-dynamic mb-3">
                            <textarea id="experience" class="multisteps-form__textarea form-control" name="experience" rows="2" placeholder="ادخل التجربة هنا." spellcheck="false"></textarea>
                            <div id="experience_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg my-2'></div>
                        </div>
                        <button type="button" class="btn rounded-3 bg-gradient-primary fs-6 ajax-submit">أرسل التجربة</button>
                        <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->experience()->where('user_id',Auth::user()->id)->first() == null)
        <div  class=" m-3 m-md-4">
            <button data-sos-once="true" data-sos="sos-rotateZ" data-bs-toggle="modal" data-bs-target="#CreateExperienceModal"  class="btn btn-primary m-1 fw-bolder rounded-3">
                <i class="fa-solid fa-pen "></i> ادخل تجربتك
            </button>
        </div>
    @else
        <div  class=" m-3 m-md-4">
            <span data-sos-once="true" data-sos="sos-rotateZ" class="btn btn-primary m-1 fw-bolder rounded-3">
                قمت بطرح تجربتك
            </span>
        </div>
    @endif
@else
    <div  class="m-3 m-md-4">
        <button data-sos-once="true" data-sos="sos-rotateZ" type="button" class="btn bg-gradient-primary m-1 fw-bolder rounded-3" data-bs-toggle="modal" data-bs-target="#LoginModal">
         <i class="fa-solid fa-pen "></i> ادخل تجربتك
        </button>
    </div>
@endverify
 
    <div class=" m-0 content  p-0">

    @if($experiences->count() > 0)
        <div class=" ">
            
            @foreach($experiences as $index=>$experience)

                <div data-sos-once="true" data-sos="sos-left"  id="item-{{$experience->id}}" class=" position-relative  card m-1 m-md-4 p-3 pt-0 border-0 rounded-5  shadow-sm mb-3" >
                    @if($experience->created_at->diffInDays() <= 3)
                        <div class="position-absolute overflow-hidden continer-new-box">
                            <div class="  w-100 bg-gradient-danger  position-absolute text-white font-weight-bolder text-center text-sm new-box" >جديد</div>
                        </div>
                    @endif
                    <div class="d-flex flex-md-row">
                        <div class="col-auto px-0 me-2 d-flex justify-content-center align-items-center">
                            <a href="{{ $experience->user->getPhoto() }}" class=" avatar-xl position-relative  nav-link " style="">
                                <img src="{{ $experience->user->getPhoto() }}" alt="{{$experience->user->name}}" class="w-100 rounded-4 h-100">
                                <div class="reaction-icon position-absolute bg-light d-none d-md-block"  style=" top:0; left:0; border-radius: 50%">
                                    <i class=" {{ $experience->reaction }}" style="font-size:74px !important; "></i> 
                                </div>
                            </a> 
                        </div>      
                        <div class="py-2  ">
                            <a href="{{route('show-profile',$experience->user->username)}}" class="nav-link text-md-start  mx-3 mx-md-0">
                                <div class="text-dark fw-bolder fs-5 ">
                                    {{$experience->user->name}}
                                    @verify
                                    @if(Auth::user()->id == $experience->user->id)
                                    <span class="text-primary fs-6">(أنت)</span>
                                    @endif
                                    @endverify
                                </div>
                            </a> 
                            @verify
                                @if(Auth::user()->id == $experience->user->id)
                                    <button type="button" action="{{route('user_experience_delete')}}" style="left: 40px; top: 50px;"
                                        class="delete position-absolute trash-can-shook" data-bs-toggle="modal" 
                                        data-bs-target="#DeleteModal" aria-label="delete experience">
                                        <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                    </button>
                                @endif
                            @endverify
                        <p class="mb-1 fw-bolder text-sm text-info" style="font-size: 12px;">
                            {{$experience->user->interest}}
                        </p>
                        <div class="m-2 fw-bolder">
                            <span class="badge text-sm text-secondary"> <i class="fa-solid fa-calendar-days text-primary px-1"></i><span class="text-sm">{{$experience->user->created_at->diffForHumans()}}</span></span>
                        </div>
                        
                    </div>
                    
                    </div>
                    <hr class="horizontal dark">
                    <div class="  p-3">
                        <p class="fs-4">
                            {{$experience->experience}}
                        </p>
                        <div data-sos-once="false" data-sos="sos-right"  class="  bg-light d-inline-block d-md-none"  style=" border-radius: 50%">
                            <i class=" {{ $experience->reaction }}" style="font-size:74px !important; "></i> 
                        </div> 
                         
                    </div>
                 </div>

            @endforeach
        </div>
    @else
        <div data-sos-once="true" data-sos="sos-zoom-in" class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة تجارب بعد</div>
    @endif
        <div class=" d-flex align-items-center justify-content-center mt-3">

            {!! $experiences ->onEachSide(2)-> links() !!}
        </div>
    </div>

@endsection

@section('script')

<script>
    delete_buttons();
</script>

@endsection