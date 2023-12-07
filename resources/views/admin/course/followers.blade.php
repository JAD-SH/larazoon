@extends('layouts.admin.dashboard')

@section('title','متابعي الكورس')

@section('css')
<style>
    
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">متابعي الكورس - {{$course -> title}}</li>
@endsection

@section('content')






    
<div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
    <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">المتابعين</h5>
    <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
        <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
            <thead>
                <tr class="text-nowrap">

                    <th class=" text-center fw-bolder">الأسم</th>
                    <th class=" text-center fw-bolder">الصورة</th>
                    <th class=" text-center fw-bolder">الإيميل</th>
                    <th class=" text-center fw-bolder">الجنس</th>
                    <th class=" text-center fw-bolder">العمر</th>
                    <th class=" text-center fw-bolder">الاهتمام</th>
                    <th class=" text-center fw-bolder">المستوى البرمجي</th>
                    <th class=" text-center fw-bolder">نسبة الاحتراف</th>
                    <th class=" text-center fw-bolder">مشاهدات</th>
                    <th class=" text-center fw-bolder">اعجابات</th>
                    <th class=" text-center fw-bolder">الحالة</th>
                    <th class=" text-center fw-bolder">الوصف</th>
                    <th class=" text-center fw-bolder">تاريخ الأنضمام</th>
                    <th class=" text-center fw-bolder">العمليات</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-nowrap align-middle">
                @isset($users)
                @foreach($users as $user)
                <tr  id="item-{{$user->id}}">
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$user->name}}</span>
                        </div>
                    </td>
                    
                    <td class="atext-center">
                        <div class="m-3">
                            <img src="{{$user -> photo}}" class="w-100" alt="team4" style="width: 100px !important;">
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$user->email}}</span>
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$user->getGender()}}</span>
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$user->getAge()}}</span>
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$user->interest}}</span>
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$user->level}}</span>
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$user->professionalism}}</span>
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            
                            <span class=" fw-bolder">{{$user ->views}}</span>
                        </div>
                    </td>
                    
                    <td class=" text-center">
                        <div class="m-3">
                            
                            <span class=" fw-bolder">{{$user ->likes}}</span>
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            
                            <span class=" fw-bolder">{{$user -> getActive()}}</span>
                        </div>
                    </td>
                    
                    <td class=" text-center text-wrap">
                        <div class="m-3 ">
                            <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$user -> description}} </span>
                        </div>
                    </td>
                    
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder">{{$user -> created_at->diffForHumans()}}</span>
                        </div>
                    </td>
                    
                    <td class=" text-center">
                        <div class="m-3">
                            

                            
                            <a href="{{route('show-profile',$user -> username)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1">الملف الشخصي</a>
                                                                            
                            <form class="d-inline" action="{{route('User-dashboard.status',$user -> id)}}" method="POST">
                                @csrf
                                <button class="btn rounded-3 border-2 fw-bolder mx-1 ajax-submit
                                @if($user -> active == 0)
                                btn-outline-info text-info
                                @else
                                    btn-info text-white
                                @endif
                                ">@if($user -> active == 0)
                                    تفعيل
                                    @else
                                    الغاء التفعيل
                                @endif
                                </button>
                            </form>
                            
                            
                            <button type="button" action="{{route('User-dashboard.destroy',$user -> id)}}"
                                class="btn rounded-3  bg-gradient-danger  border-2 fw-bolder mx-1 delete notification-active fs-6"
                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                            </button>



                        </div>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    {!! $users ->onEachSide(2)-> links() !!}
</div>





<!-- 
    
<div class="card  px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">المتابعين</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
    <thead>
            <tr >
                <th class="border-dark text-center text-uppercase font-weight-bolder">الأسم</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الصورة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الإيميل</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الجنس</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمر</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الاهتمام</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">المستوى البرمجي</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">نسبة الاحتراف</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الحالة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الوصف</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        @isset($users)
        @foreach($users as $user)
            <tr  id="item-{{$user->id}}">
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$user -> name}}</h6>
                    </div>
                </td>
                
                <td class="atext-center">
                    <div class="w-100">
                        <img src="{{$user -> photo}}" class="img-fluid" alt="team4">
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$user -> email}}</h6>
                    </div>
                </td>
                 
                <td  class=" text-center">
                    <div class="m-3">
                        
                        <h6 class="">{{$user -> getGender()}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$user -> getAge()}}</h6>
                    </div>
                </td>
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$user -> interest}}</h6>
                    </div>
                </td>
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$user -> level}}</h6>
                    </div>
                </td>
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$user -> professionalism}}</h6>
                    </div>
                </td>
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$user -> getActive()}}</h6>
                    </div>
                </td>
               
                <td   class=" text-center  text-wrap">
                    <div class="m-3 ">
                        <h6 class="mb-0"  style="width: 400px !important; ">{{$user -> description}}</h6>
                    </div>
                </td>
               
               



                <td  class=" text-center" >
                    <div class="m-3">
                        
                        
                        <a href="{{route('show-profile',$user -> id)}}" class="btn text-light btn-success  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">الملف الشخصي</h6></a>
                                                                        
                        <form class="d-inline" action="{{route('User-dashboard.status',$user -> id)}}" method="POST">
                            @csrf
                            <button class="fs-6 btn border-2 font-weight-bolder mx-1 ajax-submit
                            @if($user -> active == 0)
                            btn-outline-info text-info
                            @else
                                btn-info text-white
                            @endif
                            ">@if($user -> active == 0)
                                تفعيل
                                @else
                                الغاء التفعيل
                            @endif
                            </button>
                        </form>
                        
                        
                        <button type="button" action="{{route('User-dashboard.destroy',$user -> id)}}"
                            class="btn text-light btn-danger  border-2 font-weight-bolder mx-1 delete notification-active fs-6"
                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                            حذف
                        </button>

                    </div>
                </td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table>
    </div>
    {!! $users ->onEachSide(2)-> links() !!}

</div>

-->

@endsection

@section('script')
<script>
     scroll_to_right();
 delete_buttons();
    ajax_function();

</script>
@endsection