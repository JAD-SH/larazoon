@extends('layouts.admin.dashboard')

@section('title','لوحة التحكم')

@section('css')
<style>
  
</style>
@endsection


@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">قسم الأشعارات</li>
@endsection

@section('content')


<div class="card border-0 text-center mx-1 mx-md-3 bg-none  rounded-5 py-4 d-block shadow-sm" >
    
    <a href="{{route('Notification-dashboard')}}" class=" btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6">احدث الاشعارات</a>

    <a href="{{route('Notification-dashboard.old')}}" class=" btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6">اقدم الاشعارات</a>

    <a href="{{route('Notification-dashboard.reply')}}" class=" btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6">التي قمت بالرد عليها</a>

    <a href="{{route('Notification-dashboard.not-reply')}}" class=" btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6">التي لم ترد عليها بعد</a>
</div>






    @if($asks->count() > 0)
    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">اسئلة واستفسارات المستخدمين للادمن</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>

                        <th class=" text-center fw-bolder">#</th>
                        <th class=" text-center fw-bolder">الأسم</th>
                        <th class=" text-center fw-bolder">الصورة</th>
                        <th class=" text-center fw-bolder">عنوان الاستفسار</th>
                        <th class=" text-center fw-bolder">هل قمت بمشاهدته</th>
                        <th class=" text-center fw-bolder">الاستفسار</th>
                        <th class=" text-center fw-bolder">تاريخ النشر</th>
                        <th class=" text-center fw-bolder">ردك عليه</th>
                        <th class=" text-center fw-bolder">تاريخ الرد</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @isset($asks)
                    @if($asks->count() > 0)
                    
                    @foreach($asks as $index=>$ask)
                    <tr id="item-{{$ask->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                @if($ask->updated_at->diffInHours() <= 24)
                                    <span class="d-inline-block bg-gradient-danger rounded" style="width:10px; height:10px; "></span> 
                                @endif
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$index+1}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$ask->user->name}}</span>
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <div class="m-3">
                                <img src="{{$ask ->user-> photo}}" class="w-100" alt="team4" style="width: 100px !important;">
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$ask->title}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$ask -> getWatch()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$ask -> message}} </span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$ask -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>

                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="@if($ask -> notificationreply !== null)width: 400px !important; @endif">@if($ask -> notificationreply !== null) {{$ask ->notificationreply -> message}} @else لم تقم بالرد بعد @endif</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">@if($ask -> notificationreply !== null) {{$ask -> notificationreply -> created_at->diffForHumans()}}  @else - @endif</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <a href="{{route('show-profile',$ask -> user-> username)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1">الملف الشخصي </a>
                                
                                @if($ask ->notificationreply !== null)
                                <button class=" btn rounded-3  bg-gradient-light  border-2 fw-bolder mx-1 border-dark" >قمت بالرد</button>
                                @else
                                <button id="{{$ask -> id}}"  class=" btn rounded-3  bg-gradient-dark  border-2 fw-bolder mx-1 reply-message text-light"  data-bs-toggle="modal" data-bs-target="#replyModalMessage">إضافة رد</button>
                                @endif
                                
                                <button type="button" action="{{route('User-dashboard.destroy',$ask -> user-> id)}}"
                                    class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-danger  delete notification-active fs-6  mb-0"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    حذف المستخدم
                                </button>
                    
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    @endisset
                </tbody>
            </table>
        </div>

        {!! $asks ->onEachSide(2)-> links() !!}
    </div>
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لا يوجد اي اسئلة او استفسارات من المستخدمين بعد</div>

    @endif
<!--
    
<div class="card px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">اسئلة واستفسارات المستخدمين للادمن</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
        <thead>
            <tr >
                <th class="border-dark text-center text-uppercase font-weight-bolder">#</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الأسم</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الصورة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">عنوان الاستفسار</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">هل قمت بمشاهدته</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الاستفسار</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">نشر </th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">ردك عليه </th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">تم الرد </th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        @isset($asks)
        @if($asks->count() > 0)
        
        @foreach($asks as $index=>$ask)
            <tr id="item-{{$ask->id}}">
                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$index+1}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$ask->user->name}}</h6>
                    </div>
                </td>

                <td class="atext-center">
                    <div class="w-100">
                        <img src="{{$ask ->user-> photo}}" class="img-fluid" alt="team4">
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$ask->title}}</h6>
                    </div>
                </td>

                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$ask->getWatch()}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center  text-wrap">
                    <div class="m-2">
                        <h6 class="mb-0"  style="width: 400px !important; ">{{$ask -> message}}</h6>
                    </div>
                </td>
                
                
                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$ask -> created_at->diffForHumans()}}</h6>
                    </div>
                </td>
               
                
                <td   class=" text-center  text-wrap">
                    <div class="m-2">
                        <h6 class="mb-0"  style="@if($ask -> notificationreply !== null)width: 400px !important; @endif">@if($ask -> notificationreply !== null) {{$ask ->notificationreply -> message}} @else لم تقم بالرد بعد @endif</h6>
                    </div>
                </td>

                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">@if($ask -> notificationreply !== null) {{$ask -> notificationreply -> created_at->diffForHumans()}}  @else - @endif</h6>
                    </div>
                </td>
               
                <td  class=" text-center" >
                    <div class="m-2">
                        
                        <a href="{{route('show-profile',$ask -> user-> username)}}" class="btn text-light btn-success  border-2 font-weight-bolder mx-1 fs-6  mb-0">الملف الشخصي </a>

                        @if($ask ->notificationreply !== null)
                        <button class=" btn btn-light  mx-0 my-1 py-2 px-3 fs-6 border border-2 border-dark" >قمت بالرد</button>
                        @else
                        <button id="{{$ask -> id}}"  class=" btn btn-dark  mx-0 my-1 py-2 px-3 fs-6 reply-message"  data-bs-toggle="modal" data-bs-target="#replyModalMessage">إضافة رد</button>
                        @endif

                        <button type="button" action="{{route('User-dashboard.destroy',$ask -> user-> id)}}"
                            class="btn text-light btn-danger  border-2 font-weight-bolder mx-1 delete notification-active fs-6  mb-0"
                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                            حذف المستخدم
                        </button>
                        
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
            @endisset
        </tbody>
    </table>
    </div>
    {!! $asks ->onEachSide(2)-> links() !!}

</div>

 -->
 <hr class="horizontal  my-2 dark">


    @if($messages->count() > 0)
    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">ابلاغات المستخدمين عن مشلة ما</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">#</th>
                        <th class=" text-center fw-bolder">الأسم</th>
                        <th class=" text-center fw-bolder">الصورة</th>
                        <th class=" text-center fw-bolder">عنوان الابلاغ</th>
                        <th class=" text-center fw-bolder">هل قمت بمشاهدته</th>
                        <th class=" text-center fw-bolder">الابلاغ</th>
                        <th class=" text-center fw-bolder">تاريخ النشر</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @isset($messages)
                    @if($messages->count() > 0)
                    
                    @foreach($messages as $index=>$message)
                    <tr id="item-{{$message->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                @if($message->updated_at->diffInHours() <= 24)
                                    <span class="d-inline-block bg-gradient-danger rounded" style="width:10px; height:10px; "></span> 
                                @endif
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$index+1}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$message->user->name}}</span>
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <div class="m-3">
                                <img src="{{$message ->user-> photo}}" class="w-100" alt="team4" style="width: 100px !important;">
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$message->title}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$message -> getWatch()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$message -> message}} </span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$message -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <a href="{{route('show-profile',$message -> user-> username)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1">الملف الشخصي </a>
                                
                                <button type="button" action="{{route('User-dashboard.destroy',$message -> user-> id)}}"
                                    class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-danger  delete notification-active fs-6  mb-0"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    حذف المستخدم
                                </button>
                    
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    @endisset
                </tbody>
            </table>
        </div>

        {!! $messages ->onEachSide(2)-> links() !!}
    </div>
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لا يوجد اي ابلاغات من المستخدمين بعد</div>

    @endif


<!-- 
    
<div class="card px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">ابلاغات المستخدمين عن مشلة ما</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
        <thead>
            <tr >
                <th class="border-dark text-center text-uppercase font-weight-bolder">#</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الأسم</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الصورة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">عنوان الابلاغ</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">هل قمت بمشاهدته</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الابلاغ</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">نشر </th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">ردك عليه </th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">تم الرد </th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        @isset($messages)
        @if($messages->count() > 0)
        
        @foreach($messages as $index=>$message)
            <tr id="item-{{$message->id}}">
                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$index+1}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$message->user->name}}</h6>
                    </div>
                </td>

                <td class="atext-center">
                    <div class="w-100">
                        <img src="{{$message ->user-> photo}}" class="img-fluid" alt="team4">
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$message->title}}</h6>
                    </div>
                </td>

                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$message->getWatch()}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center  text-wrap">
                    <div class="m-2">
                        <h6 class="mb-0"  style="width: 400px !important; ">{{$message -> message}}</h6>
                    </div>
                </td>
                
                
                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">{{$message -> created_at->diffForHumans()}}</h6>
                    </div>
                </td>

                <td   class=" text-center  text-wrap">
                    <div class="m-2">
                        <h6 class="mb-0"  style="@if($message -> notificationreply !== null)width: 400px !important; @endif">@if($message -> notificationreply !== null) {{$message ->notificationreply -> message}} @else لم تقم بالرد بعد @endif</h6>
                    </div>
                </td>

                <td   class=" text-center">
                    <div class="m-2">
                        <h6 class="mb-0">@if($message -> notificationreply !== null) {{$message -> notificationreply -> created_at->diffForHumans()}}  @else - @endif</h6>
                    </div>
                </td>
               
                <td  class=" text-center" >
                    <div class="m-2">
                        
                        <a href="{{route('show-profile',$message -> user-> username)}}" class="btn text-light btn-success  border-2 font-weight-bolder mx-1 fs-6 mb-0">الملف الشخصي </a>

                        @if($message ->notificationreply !== null)
                        <button class=" btn btn-light  mx-0 my-1 py-2 px-3 fs-6  border border-2 border-dark" >قمت بالرد</button>
                        @else
                        <button id="{{$message -> id}}"  class=" btn btn-dark  mx-0 my-1 py-2 px-3 fs-6 reply-message"  data-bs-toggle="modal" data-bs-target="#replyModalMessage">إضافة رد</button>
                        @endif

                        <button type="button" action="{{route('User-dashboard.destroy',$message -> user-> id)}}"
                            class="btn text-light btn-danger  border-2 font-weight-bolder mx-1 delete notification-active fs-6  mb-0"
                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                            حذف المستخدم
                        </button>
                        
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
            @endisset
        </tbody>
    </table>
    </div>
    {!! $messages ->onEachSide(2)-> links() !!}

</div>

-->

    <!-- Modal -->
    @include('admin.includes.alerts.create-reply-modal')
    
@endsection



@section('script')

<script>
     scroll_to_right();

delete_buttons();
    ajax_function();

    let create_reply_btns = document.querySelectorAll(".reply-message");
  let create_reply_form=document.querySelector(".create-reply-message-form input[name='notification_id']");
  create_reply_btns.forEach(btn => {
    btn.onclick=function(){

      $(create_reply_form).attr('value',$(this).attr('id'))
    }
  });
</script>
@endsection
