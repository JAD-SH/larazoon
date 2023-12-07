@extends('layouts.admin.dashboard')

@section('title','قسم الداعمين')

@section('css')
<style>
  
</style>
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">قسم الداعمين</li>
@endsection

@section('content')



    @if($supporters->count() > 0)

          
        <div class="modal fade" id="edit_suporter" tabindex="-1" role="dialog" aria-labelledby="edit_suporterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
                    <div class="modal-header  p-0">
                        <div class="fw-bolder fs-6 my-1 pb-2 text-dark" id="exampleModalLabel">قيمة الدعم بعد الاطلاع عليها</div>
                        <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                            <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="edit-form-notification" method="POST" >
                            @csrf    
                             <div class="input-group input-group-outline mb-3">
                                <input id="support_value" type="number" name="support_value" class="form-control">
                                <div id="support_value_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                            </div> 
                            <div class="mt-3">

                                <button class="btn rounded-3 bg-gradient-primary fs-6 ajax-submit" data-bs-dismiss="modal">ارسال</button>
                                <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">رجوع</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <div class="card m-1 m-md-3 border-0 rounded-5 mb-5 overflow-hidden shadow-sm">
    <div class="fw-bolder m-2 fs-5 text-dark text-center p-3">قسم الداعمين</div>
    <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
        <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
            <thead>
                <tr class="text-nowrap">
                    <th class=" text-center fw-bolder">اسم المستخدم</th>
                    <th class=" text-center fw-bolder">البريد الالكتروني</th>
                    <th class=" text-center fw-bolder">قيمة الدعم</th>
                    <th class=" text-center fw-bolder">طريقة الدعم</th>
                    <th class=" text-center fw-bolder">التحقق</th>
                    <th class=" text-center fw-bolder">العمليات</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-nowrap align-middle">
                @isset($supporters)
                @foreach($supporters as $supporter)
                <tr id="item-{{$supporter->id}}">
                    <td class=" text-center">
                        <div class="m-3">
                            @if($supporter->verification == null)
                                <span class="d-inline-block bg-gradient-danger rounded" style="width:10px; height:10px; "></span> 
                            @endif
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$supporter -> user->name}}</span>
                        </div>
                    </td>
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$supporter -> email}}</span>
                        </div>
                    </td>
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$supporter -> support_value}}</span>
                        </div>
                    </td>
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$supporter -> support_by}}</span>
                        </div>
                    </td>
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">
                                @if($supporter -> verification == 2) <span class="text-success fs-6">تم التحقق - وهو داعم</span>
                                @elseif($supporter -> verification == 1) <span class="text-danger fs-6">تم التحقق - وهو ليس داعم</span>
                                @else لم يتم التحقق بعد @endif</span>
                        </div>
                    </td>
                      
                    <td class=" text-center">
                        <div class="m-3">


                            <button action="{{route('Supporter-dashboard.edit-value',$supporter -> id)}}"
                                type="button" class="btn rounded-3 bg-gradient-warning mx-1 edit-suporter" 
                                data-bs-toggle="modal" data-bs-target="#edit_suporter">
                                تعديل قيمة الدعم
                            </button>
                              
                            
                            @if($supporter -> verification == 2)
                                <button class="btn rounded-3  border-2 fw-bolder mx-1
                                 bg-gradient-info   ">نعم - قام بدعمنا</button>
                            @else
                                <form class="d-inline" action="{{route('Supporter-dashboard.verification',$supporter -> id)}}" method="POST">
                                    @csrf
                                    <input name="verification" value="2" type="hidden">
                                    <button class="btn rounded-3  border-2 fw-bolder mx-1 ajax-submit
                                    btn-outline-info   ">نعم - قام بدعمنا</button>
                                </form>
                            @endif

                            @if($supporter -> verification == 1)
                                <button class="btn rounded-3  border-2 fw-bolder mx-1
                                 bg-gradient-info   ">لا - لم يدعمنا</button>
                            @else
                                <form class="d-inline" action="{{route('Supporter-dashboard.verification',$supporter -> id)}}" method="POST">
                                    @csrf
                                    <input name="verification" value="1" type="hidden">
                                    <button class="btn rounded-3  border-2 fw-bolder mx-1 ajax-submit
                                    btn-outline-info   ">لا - لم يدعمنا</button>
                                </form>
                            @endif
                            
                            <a href="{{route('Supporter-dashboard.supporter-archive',$supporter -> user_id)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1">سجل الدعم</a>
                                
                             
                                                
                        </div>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    {!! $supporters ->onEachSide(2)-> links() !!}
    </div>

    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم دعم الموقع بعد</div>

    @endif

@endsection

@section('script')
<script>
     scroll_to_right();
 delete_buttons();
    ajax_function();
    edit_suporter();
    function edit_suporter(){
        let edit_btns = document.querySelectorAll(".edit-suporter");
        for (let i = 0; edit_btns[i] ; i++) {
            edit_btns[i].onclick=function(){
                let action=$(edit_btns[i]).attr('action');
                $(".edit-form-notification").attr("action",action);
                
            }
        }
    }
</script>
@endsection