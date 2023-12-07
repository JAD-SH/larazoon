@extends('layouts.admin.dashboard')

@section('title','الأقسام الرئيسية')

@section('css')
<style>
  
</style>
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">الأقسام الرئيسية</li>
@endsection

@section('content')



    @if($maincategories->count() > 0)
    <div class="card m-1 m-md-3 border-0 rounded-5 mb-5 overflow-hidden shadow-sm">
    <div class="fw-bolder m-2 fs-5 text-dark text-center p-3">الأقسام الرئيسية</div>
    <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
        <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
            <thead>
                <tr>
                    <th class=" text-center fw-bolder">العنوان</th>
                    <th class=" text-center fw-bolder">الصورة</th>
                    <th class=" text-center fw-bolder">الأيقونة</th>
                    <th class=" text-center fw-bolder">اللون</th>
                    <th class=" text-center fw-bolder">الحالة</th>
                    <th class=" text-center fw-bolder">slug</th>
                    <th class=" text-center fw-bolder">الوصف</th>
                    <th class=" text-center fw-bolder">اخر تعديل</th>
                    <th class=" text-center fw-bolder">العمليات</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-nowrap align-middle">
                @isset($maincategories)
                @foreach($maincategories as $maincategory)
                <tr id="item-{{$maincategory->id}}">
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$maincategory -> title}}</span>
                        </div>
                    </td>
                    
                    <td class="atext-center">
                        <div class="m-3">
                            <img src="{{$maincategory -> light_photo}}" class="w-100" alt="team4" style="width: 100px !important;">
                        </div>
                    
                        <div class="m-3">
                            <img src="{{$maincategory -> dark_photo}}" class="w-100" alt="team4" style="width: 100px !important;">
                        </div>
                    </td>
                    
                    <td class="text-center">
                        <div class="m-3">
                            <i class="{{$maincategory -> icon}} fs-5"></i>
                        </div>
                    </td>
                    
                    <td class="text-center">
                        <div class="m-3">
                            <label class="btn text-light btn-{{$maincategory ->color}}  border-2 fw-bolder">{{$maincategory ->color}}</label>
                        </div>
                    </td>
                    
                    
                    <td class=" text-center">
                        <div class="m-3">
                            
                            <span class=" fw-bolder">{{$maincategory -> getActive()}}</span>
                        </div>
                    </td>

                    <td class=" text-center">
                        <div class="m-3">
                            
                            <span class=" fw-bolder">{{$maincategory -> slug}}</span>
                        </div>
                    </td>
                    
                    <td class=" text-center text-wrap">
                        <div class="m-3 ">
                            <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$maincategory -> description}} </span>
                        </div>
                    </td>
                    
                    
                    
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder">{{$maincategory -> updated_at->diffForHumans()}}</span>
                        </div>
                    </td>
                    
                    <td class=" text-center">
                        <div class="m-3">


                        <a href="{{route('MainCategory-dashboard.edit',$maincategory -> id)}}" class="btn  bg-gradient-warning  border-2 fw-bolder mx-1 ">تعديل</a>
                                
                                @if($maincategory ->route == 'Course')
                                    <button class="fs-6 btn border-2 fw-bolder mx-1 bg-gradient-secondary ">مفعل دائما</button>
                                @else
                                <form class="d-inline" action="{{route('MainCategory-dashboard.status',$maincategory -> id)}}" method="POST">
                                    @csrf
                                    <button class="fs-6 btn border-2 fw-bolder mx-1 ajax-submit
                                    @if($maincategory -> active == 0)
                                    btn-outline-info text-info
                                    @else
                                        bg-gradient-info text-white
                                    @endif
                                    ">@if($maincategory -> active == 0)
                                        تفعيل
                                        @else
                                        الغاء تفعيل
                                    @endif
                                    </button>
                                </form>
                                @endif
                                                
                        </div>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    {!! $maincategories ->onEachSide(2)-> links() !!}
    </div>

    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة اقسام رئيسية بعد</div>

    @endif


<!-- 
    

<div class="card px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">الأقسام الرئيسية</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
        <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
            <thead>
                <tr >
                    <th class="border-dark text-center text-uppercase font-weight-bolder">العنوان</th>
                    <th class="border-dark text-center text-uppercase font-weight-bolder">الصورة</th>
                    <th class="border-dark text-center text-uppercase font-weight-bolder">الأيقونة</th>
                    <th class="border-dark text-center text-uppercase font-weight-bolder">اللون</th>
                    <th class="border-dark text-center text-uppercase font-weight-bolder">الحالة</th>
                    <th class="border-dark text-center text-uppercase font-weight-bolder">الوصف</th>
                    <th class="border-dark text-center text-uppercase font-weight-bolder">اخر تعديل</th>
                    <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @isset($maincategories)
                @foreach($maincategories as $maincategory)
                <tr id="item-{{$maincategory->id}}">
                    <td   class=" text-center">
                        <div class="m-3">
                            <h6 class="mb-0">{{$maincategory -> title}}</h6>
                        </div>
                    </td>
                    
                    <td class="atext-center">
                        <div class="m-3 w-100">
                            <img src="{{$maincategory -> photo}}" class="img-fluid" alt="team4">
                        </div>
                    </td>
                    
                    <td class="text-center">
                        <div class="m-3">
                            <i class="{{$maincategory -> icon}}"></i>
                        </div>
                    </td>
                    
                    <td class="text-center">
                        <div class="m-3">
                            <label class="btn text-light btn-{{$maincategory ->color}}  border-2 font-weight-bolder">{{$maincategory ->color}}</label>
                        </div>
                    </td>
                
                    
                    <td  class=" text-center">
                        <div class="m-3">
                            
                            <h6 class="">{{$maincategory -> getActive()}}</h6>
                        </div>
                    </td>
                    
                    <td   class=" text-center text-wrap">
                        <div class="m-3 ">
                            <h6 class="mb-0" style="width: 400px !important; ">{{$maincategory -> description}}</h6>
                        </div>
                    </td>
                
                    
                
                    <td   class=" text-center">
                        <div class="m-3">
                            <h6 class="mb-0">{{$maincategory -> created_at->diffForHumans()}}</h6>
                        </div>
                    </td>
                
                    <td  class=" text-center" >
                        <div class="m-3">
                            
                            <a href="{{route('MainCategory-dashboard.edit',$maincategory -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">تعديل</h6></a>
                                
                            @if($maincategory ->route == 'Course')
                                <button class="fs-6 btn border-2 font-weight-bolder mx-1 btn-secondary text-white">مفعل دائما</button>
                            @else
                            <form class="d-inline" action="{{route('MainCategory-dashboard.status',$maincategory -> id)}}" method="POST">
                                @csrf
                                <button class="fs-6 btn border-2 font-weight-bolder mx-1 ajax-submit
                                @if($maincategory -> active == 0)
                                btn-outline-info text-info
                                @else
                                    btn-info text-white
                                @endif
                                ">@if($maincategory -> active == 0)
                                    تفعيل
                                    @else
                                    الغاء تفعيل
                                @endif
                                </button>
                            </form>
                            @endif
                            
                        </div>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    {!! $maincategories ->onEachSide(2)-> links() !!}
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