@extends('layouts.admin.dashboard')

@section('title','قسم جروبات الدروس')

@section('css')
<style>
   
</style>
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">قسم جروبات الدروس</li>

@endsection

@section('content')

    <div class="m-3  mb-0">
    <a class=" btn rounded-3 bg-gradient-primary mx-1" target="_blank"  href="{{route('LessonGroup-dashboard.create',$course_id)}}">أضافة جروب جديد</a>

    </div>

    

    @if($groups->count() > 0)
    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">الجروبات</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">العنوان</th>
                        <th class=" text-center fw-bolder">الدروس</th> 
                        <th class=" text-center fw-bolder">الحالة</th> 
                        <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @isset($groups)
                    @foreach($groups as $group)
                    <tr id="item-{{$group->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$group->title}}</span>
                            </div>
                        </td>
                         
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$group -> lessons->count()}}</span>
                            </div>
                        </td>
                         
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$group -> getActive()}}</span>
                            </div>
                        </td>
                         
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$group -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                          <div class="m-3">

                            @if($group->lessons()->count() !== 0)
                            <a href="{{route('LessonGroup-dashboard.show',$group -> id)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">جميع الدروس</a>
                            @else
                            <span class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">لا دروس</span>
                            @endif
                            
                            <a href="{{route('Lesson-dashboard.create',$group -> id)}}" target="_blank" class="btn rounded-3  bg-gradient-primary  border-2 fw-bolder mx-1 ">أضافة درس جديد</a>
                             
                            <a href="{{route('LessonGroup-dashboard.edit',$group -> id)}}" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1 ">تعديل</a>
                            
                            <form class="d-inline" action="{{route('LessonGroup-dashboard.status',$group -> id)}}" method="POST">
                                @csrf
                                <button class="btn rounded-3 border-2 font-weight-bolder mx-1 ajax-submit
                                @if($group -> active == 0)
                                btn-outline-info text-info
                                @else
                                bg-gradient-info text-white
                                @endif
                                ">@if($group -> active == 0)
                                    تفعيل
                                    @else
                                    الغاء تفعيل
                                @endif
                                </button>
                            </form>
                            
                            <button type="button" action="{{route('LessonGroup-dashboard.destroy',$group -> id)}}"
                                class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-danger   delete notification-active"
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
        {!! $groups ->onEachSide(2)-> links() !!}
    </div>
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة جروبات دروس بعد</div>

    @endif
 
@endsection

@section('script')
<script>
     scroll_to_right();
 delete_buttons();
    ajax_function();

</script>
@endsection