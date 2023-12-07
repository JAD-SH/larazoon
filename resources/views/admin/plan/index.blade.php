@extends('layouts.admin.dashboard')

@section('title','قسم الخطط')

@section('css')
<style>
   
</style>
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">قسم خطط التعلم</li>

@endsection

@section('content')

    
    <div class="m-3  mb-0">
        <!-- Button trigger modal -->
        <button action="{{route('Plan-dashboard.store')}}"
            type="button" class="btn rounded-3 bg-gradient-primary mx-1 add-plan" 
            data-bs-toggle="modal" data-bs-target="#add_plan">
            أضافة خطة تعلم جديدة
        </button>
        @include('admin.includes.alerts.add-edit-plan-modal')
    </div>




    @if($plans->count() > 0)
    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">خطط التعلم</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr class="text-nowrap">
                        <th class=" text-center fw-bolder">العنوان</th>
                        <th class=" text-center fw-bolder">الكورسات</th>
                        <th class=" text-center fw-bolder">عدد متابعين الخطة</th>
                        <th class=" text-center fw-bolder">الحالة</th>
                        <th class=" text-center fw-bolder">الوصف</th>
                        <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @isset($plans)
                    @foreach($plans as $plan)
                    <tr id="item-{{$plan->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$plan->title}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            @if($plan -> courses()->count() > 0)
                            <div class="m-3 ">
                                <div class="mb-0 text-end">
                                    @foreach($plan -> courses as $index=>$course)
                                    <p class="fw-bolder"><span class="text-danger "> {{$index+1}}#</span> {{$course->title}}</p>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            لم يتم إضافة كورسات بعد
                            @endif
                        </td>
                        

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$plan -> users() ->count()}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$plan -> getActive()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$plan -> description}} </span>
                            </div>
                        </td>
                        
                        
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$plan -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                              



                                @if($plan->users()->count() !== 0)
                                <a href="{{route('Plan-dashboard.show',$plan -> id)}}" target="_blank"  class="btn rounded-3  bg-gradient-secondary  border-2 fw-bolder mx-1">المتابعين</a>
                                @else
                                <span class="btn rounded-3  bg-gradient-secondary  border-2 fw-bolder mx-1">لا متابعين</span>
                                @endif
                            
                                
                                <button action="{{route('Plan-dashboard.update',$plan -> id)}}"
                                    type="button" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1 edit-plan" 
                                    data-bs-toggle="modal" data-bs-target="#add_plan">
                                    تعديل
                                </button>
                                
                                <form class="d-inline" action="{{route('Plan-dashboard.status',$plan -> id)}}" method="POST">
                                    @csrf
                                    <button class="btn rounded-3  border-2 fw-bolder mx-1 ajax-submit
                                    @if($plan -> active == 0)
                                    btn-outline-info text-info
                                    @else
                                    bg-gradient-info text-white
                                    @endif
                                    ">@if($plan -> active == 0)
                                        تفعيل
                                        @else
                                        الغاء تفعيل
                                    @endif
                                    </button>
                                </form>
                                
                                <button type="button" action="{{route('Plan-dashboard.destroy',$plan -> id)}}"
                                    class="btn rounded-3  bg-gradient-danger  border-2 fw-bolder mx-1 delete notification-active "
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                </button>
                                @if($plan -> courses() ->count() > 0)
                                    <a href="{{route('Plan-dashboard.create-plan-course',$plan -> id)}}" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1">تعديل كورسات الخطة</a>
                                @else
                                    <a href="{{route('Plan-dashboard.create-plan-course',$plan -> id)}}" class="btn rounded-3  bg-gradient-primary  border-2 fw-bolder mx-1">إضافة كورسات للخطة</a>
                                @endif

                  
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
        {!! $plans ->onEachSide(2)-> links() !!}


        
        
    </div>

    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة خطط تعلم بعد</div>

    @endif





<!-- 
    
<div class="card  px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">الخطط</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
    <thead>
            <tr >
                <th class="border-dark text-center text-uppercase font-weight-bolder">العنوان</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الكورسات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">عدد متابعين الخطة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الحالة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الوصف</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">اخر تعديل</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        @isset($plans)
        @foreach($plans as $plan)
            <tr id="item-{{$plan->id}}">
                <td   class=" text-center title">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$plan -> title}}</h6>
                    </div>
                </td>
              
                <td   class="font-weight-bolder text-center" @if($plan -> courses()->count() > 0) style="overflow-y: scroll;" @endif>
                    @if($plan -> courses()->count() > 0)
                    <div class="m-3 " style="max-height: 150px;">
                        <h6 class="mb-0 text-end">
                            @foreach($plan -> courses as $index=>$course)
                            <p class="font-weight-bolder"><span class="text-danger "> {{$index+1}}#</span> {{$course->title}}</p>
                            @endforeach
                        </h6>
                    </div>
                    @else
                    لم يتم إضافة كورسات بعد
                    @endif
                </td>

                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$plan -> users() ->count()}}</h6>
                    </div>
                </td>
                
                <td  class=" text-center">
                    <div class="m-3 ">
                        
                        <h6 class="my-0">{{$plan -> getActive()}}</h6>
                    </div>
                </td>

                <td class=" text-center  text-wrap description">
                    <div class="m-3 ">
                        <h6 class="mb-0"  style="width: 400px !important; ">{{$plan -> description}}</h6>
                    </div>
                </td>
               
                
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$plan -> created_at->diffForHumans()}}</h6>
                    </div>
                </td>
               
                <td  class=" text-center" >
                    <div class="m-3">
                        
                        
                        <a href="{{route('Plan-dashboard.show',$plan -> id)}}" target="_blank"  class="btn text-light btn-secondary  border-2 font-weight-bolder mx-1 my-0"><h6 class="text-white m-0">المتابعين</h6></a>
                        
                        <button action="{{route('Plan-dashboard.update',$plan -> id)}}"
                            type="button" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1 my-0 edit-plan" 
                            data-bs-toggle="modal" data-bs-target="#add_plan">
                            <h6 class="text-white m-0">تعديل</h6>
                        </button>
                        
                        <form class="d-inline" action="{{route('Plan-dashboard.status',$plan -> id)}}" method="POST">
                            @csrf
                            <button class="fs-6 btn border-2 font-weight-bolder mx-1 my-0 ajax-submit
                            @if($plan -> active == 0)
                            btn-outline-info text-info
                            @else
                                btn-info text-white
                            @endif
                            ">@if($plan -> active == 0)
                                تفعيل
                                @else
                                الغاء تفعيل
                            @endif
                            </button>
                        </form>
                        
                        <button type="button" action="{{route('Plan-dashboard.destroy',$plan -> id)}}"
                            class="btn text-light btn-danger  border-2 font-weight-bolder mx-1 my-0 delete notification-active fs-6"
                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                            حذف
                        </button>
                        @if($plan -> courses() ->count() > 0)
                            <a href="{{route('Plan-dashboard.create-plan-course',$plan -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1 my-0"><h6 class="text-white m-0">تعديل كورسات الخطة</h6></a>
                        @else
                            <a href="{{route('Plan-dashboard.create-plan-course',$plan -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1 my-0"><h6 class="text-white m-0">إضافة كورسات للخطة</h6></a>
                        @endif
                        
                    </div>
                </td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table>
    </div>
    {!! $plans ->onEachSide(2)-> links() !!}
    <div class="m-3  mb-0">

        <!- Modal ->
        <div class="modal fade" id="add_plan" tabindex="-1" role="dialog" aria-labelledby="add_planTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title font-weight-bolder text-danger" id="exampleModalLabel">برجاء إدخال سؤال مختص بالتقنية والمعلوماتية</h6>
                        <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                            <span class="font-weight-bolder text-danger fs-5" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="add_edit-form-notification" method="POST" >
                            @csrf    
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">عنوان خطة التعلم</label>
                                <input type="text" name="title" class="form-control">
                                <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg my-2'></div>
                            </div>
                            <div class="input-group input-group-dynamic">
                                <textarea class="multisteps-form__textarea form-control" name="description" rows="2" placeholder="ادخل الوصف هنا." spellcheck="false"></textarea>
                                <div id="description_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg my-2'></div>
                            </div>
                            <div class="mt-3">

                                <button class="btn bg-gradient-primary fs-6 ajax-submit" data-bs-dismiss="modal">ارسال</button>
                                <button type="button" class="btn bg-gradient-secondary fs-6" data-bs-dismiss="modal">رجوع</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

-->

@endsection

@section('script')
<script>
     scroll_to_right();
    delete_buttons();
    ajax_function();
    add_plan();
    edit_plan();
    
    function add_plan(){
        let add_button = document.querySelector(".add-plan");
        add_button.onclick=function(){
            let action=$(add_button).attr('action');
            $(".add_edit-form-notification").attr("action",action);
        }
    }
    function edit_plan(){
        let edit_buttons = document.querySelectorAll(".edit-plan");

        for (let i = 0; edit_buttons[i] ; i++) {
            edit_buttons[i].onclick=function(){
                let action=$(edit_buttons[i]).attr('action');
                $(".add_edit-form-notification").attr("action",action);
                $(".add_edit-form-notification").append(`<input type="hidden" name="_method" value="PUT">`);
                let continer=$(edit_buttons[i]).parents('tr');
                //let old_title= $(continer).find('.title').text().replace(/\s+/g, "");
                //let old_description= $(continer).find('.description').text().replace(/\s+/g, "");
                let old_title= $(continer).find('.title').text().trim();
                let old_description= $(continer).find('.description').text().trim();
                $(".add_edit-form-notification").find("input[name='title']").attr("value",old_title);
                $(".add_edit-form-notification").find("textarea[name='description']").text(old_description);
            }
        }
    }

 
</script>
@endsection