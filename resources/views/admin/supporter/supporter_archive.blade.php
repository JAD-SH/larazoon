@extends('layouts.admin.dashboard')

@section('title','سجل الداعم')

@section('css')
<style>
  
</style>
@endsection

@section('path')
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Supporter-dashboard.index')}}">قسم الداعمين</a></li>

    <li class="breadcrumb-item fw-bolder active " aria-current="page">سجل الداعم</li>
@endsection

@section('content')



    @if($supporter_archive->count() > 0)

        
         
    <div class="card m-1 m-md-3 border-0 rounded-5 mb-5 overflow-hidden shadow-sm">
    <div class="fw-bolder m-2 fs-5 text-dark text-center p-3">سجل الداعم ( <span class="text-info fs-4">{{$supporter_archive[0]->user->name}}</span> )</div>
    <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
        <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
            <thead>
                <tr class="text-nowrap">
                     <th class=" text-center fw-bolder">البريد الالكتروني</th>
                    <th class=" text-center fw-bolder">قيمة الدعم</th>
                    <th class=" text-center fw-bolder">طريقة الدعم</th>
                    <th class=" text-center fw-bolder">التحقق</th>
                    <th class=" text-center fw-bolder">العمليات</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-nowrap align-middle">
                @isset($supporter_archive)
                @foreach($supporter_archive as $support)
                <tr id="item-{{$support->id}}">
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$support -> email}}</span>
                        </div>
                    </td>
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$support -> support_value}}</span>
                        </div>
                    </td>
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$support -> support_by}}</span>
                        </div>
                    </td>
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">
                                @if($support -> verification == 2) <span class="text-success fs-6">تم التحقق - وهو داعم</span>
                                @elseif($support -> verification == 1) <span class="text-danger fs-6">تم التحقق - وهو ليس داعم</span>
                                @else لم يتم التحقق بعد @endif</span>
                        </div>
                    </td>
                      
                    <td class=" text-center">
                        <div class="m-3">


                            <button action="{{route('Supporter-dashboard.edit-value',$support -> id)}}"
                                type="button" class="btn rounded-3 bg-gradient-warning mx-1 edit-suporter" 
                                data-bs-toggle="modal" data-bs-target="#edit_suporter">
                                تعديل قيمة الدعم
                            </button>
                              
                            @if($support -> verification == 2)
                                <button class="btn rounded-3  border-2 fw-bolder mx-1
                                 bg-gradient-info   ">نعم - قام بدعمنا</button>
                            @else
                                <form class="d-inline" action="{{route('Supporter-dashboard.verification',$support -> id)}}" method="POST">
                                    @csrf
                                    <input name="verification" value="2" type="hidden">
                                    <button class="btn rounded-3  border-2 fw-bolder mx-1 ajax-submit
                                    btn-outline-info   ">نعم - قام بدعمنا</button>
                                </form>
                            @endif

                            @if($support -> verification == 1)
                                <button class="btn rounded-3  border-2 fw-bolder mx-1
                                 bg-gradient-info   ">لا - لم يدعمنا</button>
                            @else
                                <form class="d-inline" action="{{route('Supporter-dashboard.verification',$support -> id)}}" method="POST">
                                    @csrf
                                    <input name="verification" value="1" type="hidden">
                                    <button class="btn rounded-3  border-2 fw-bolder mx-1 ajax-submit
                                    btn-outline-info   ">لا - لم يدعمنا</button>
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