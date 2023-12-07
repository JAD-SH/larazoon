@extends('layouts.admin.dashboard')

@section('title','قسم الدروس الملحقة')

@section('css')
<style>
   
</style>
@endsection
@if($accessors->count() > 0)
@section('path')
    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">دروس ملحقة للدرس ({{$accessors[0]->lesson->title}}) </li>
@endsection

@section('content')

    <div class="m-3 ">
        <a class=" btn rounded-3 bg-gradient-primary mx-1" target="_blank"  href="{{route('LessonAccessor-dashboard.create',$lesson_id)}}">أضافة درس جديد</a>
        <a class="btn rounded-3 bg-gradient-warning mx-1" href="{{route('Lesson-dashboard.trashed',$accessors[0]->lesson -> id)}}">سلة المهملات <i class="fa-solid fa-trash-can text-danger text-gradient  "></i></a>

    </div>



    @if($accessors->count() > 0)

    <div class="card border-0 text-center mx-1 mx-md-3 bg-none  rounded-5 py-4 d-block shadow-sm">

        <a id="filter-index-accessor" href="{{route('Lesson-dashboard.show',$lesson_id)}}" class="btn bg-gradient-{{$accessors[0]->lesson->group->course->color}} m-1 fw-bolder rounded-3 fs-6"> الأحدث  </a>
        <a id="filter-older-accessor" href="{{route('Lesson-dashboard.older',$lesson_id)}}" class="btn bg-gradient-{{$accessors[0]->lesson->group->course->color}} m-1 fw-bolder rounded-3 fs-6"> الاقدم  </a>
        <a id="filter-unactive-accessor" href="{{route('Lesson-dashboard.un-active',$lesson_id)}}" class="btn bg-gradient-{{$accessors[0]->lesson->group->course->color}} m-1 fw-bolder rounded-3 fs-6"> الغير مفعل  </a>
        <a id="filter-top-views-accessor" href="{{route('Lesson-dashboard.top-views',$lesson_id)}}" class="btn bg-gradient-{{$accessors[0]->lesson->group->course->color}} m-1 fw-bolder rounded-3 fs-6">  الأكثر مشاهدة   </a>
        <a id="filter-top-likes-accessor" href="{{route('Lesson-dashboard.top-likes',$lesson_id)}}" class="btn bg-gradient-{{$accessors[0]->lesson->group->course->color}} m-1 fw-bolder rounded-3 fs-6"> الأكثر اعجابا  </a>
 
    </div>

    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">دروس ملحقة للدرس (<span class="text-{{$accessors[0]->lesson->group->course->color}} fs-5">{{$accessors[0]->lesson->title}}</span>)</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr class="text-nowrap">
                        <th class=" text-center fw-bolder">العنوان</th>
                        <th class=" text-center fw-bolder">الصورة</th>
                        <th class=" text-center fw-bolder">المشاهدات</th>
                        <th class=" text-center fw-bolder">الاعجابات</th>
                         <th class=" text-center fw-bolder">الحالة</th>
                        <th class=" text-center fw-bolder">slug</th>
                        <th class=" text-center fw-bolder">الوصف</th>
                        <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @isset($accessors)
                    @foreach($accessors as $lesson)
                    <tr id="item-{{$lesson->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$lesson->title}}</span>
                            </div>
                        </td>

                        <td class="text-center">
                            <div class="m-3">
                                <img src="{{$lesson -> photo}}" class="w-100" alt="team4" style="width: 100px !important;">
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$lesson -> views}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$lesson -> likes}}</span>
                            </div>
                        </td>
                         
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$lesson -> getActive()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$lesson -> slug}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$lesson -> description}} </span>
                            </div>
                        </td>
                        
                        
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$lesson -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                              
                                    
                                <a href="{{route('Lesson-dashboard.show',$lesson -> id)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1">عرض الدرس</a>

                                <a href="{{route('Lesson-dashboard.edit',$lesson -> id)}}" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1">تعديل</a>

                                <a href="{{route('Lesson-dashboard.tryit-page',$lesson -> id)}}" class="btn rounded-3  bg-gradient-dark  border-2 fw-bolder mx-1 text-light">TryIt <i class="fs-6 fa fa-play"></i></a>
                                <a href="{{route('Lesson-dashboard.image-page',$lesson -> id)}}" class="btn rounded-3  bg-gradient-light  border-2 fw-bolder mx-1 text-dark">Image <i class="fs-6 fa fa-play"></i></a>
                                
                                <a href="#" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 text-light">دروس تابعة</a>
                                
                                <button type="button" action="{{route('Lesson-dashboard.move',$lesson -> id)}}"
                                class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-primary move"
                                data-bs-toggle="modal" data-bs-target="#MoveTo">
                                نقل
                                </button>
                                

                                <form class="d-inline" action="{{route('Lesson-dashboard.status',$lesson -> id)}}" method="POST">
                                    @csrf
                                    <button class="btn rounded-3  border-2 fw-bolder mx-1 ajax-submit
                                    @if($lesson -> active == 0)
                                    btn-outline-info text-info
                                    @else
                                    bg-gradient-info text-white
                                    @endif
                                    ">@if($lesson -> active == 0)
                                    تفعيل
                                    @else
                                    الغاء تفعيل
                                    @endif
                                    </button>
                                </form>

                                <button type="button" action="{{route('Lesson-dashboard.destroy',$lesson -> id)}}"
                                    class="btn rounded-3 bg-gradient-danger  border-2 fw-bolder mx-1 delete notification-active "
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-trash-can text-danger text-gradient fs-5"></i>
                                </button>

                                @if($lesson -> exams() ->count() > 0)
                                    <a href="{{route('Exam-dashboard.show',$lesson -> id)}}" class="btn rounded-3 bg-gradient-warning  border-2 fw-bolder mx-1">عرض وتعديل الاختبار</a>
                                    
                                    <form class="d-inline" action="{{route('Exam-dashboard.status-exam',$lesson -> id)}}" method="POST">
                                        @csrf
                                        <button class=" btn rounded-3  border-2 fw-bolder mx-1 ajax-submit
                                        @if($lesson -> active == 0)
                                        btn-outline-info text-info
                                        @else
                                        bg-gradient-info text-white
                                        @endif
                                        ">
                                        @if($lesson -> active == 0)
                                        تفعيل الاختبار
                                        @else
                                        الغاء تفعيل الاختبار
                                        @endif
                                        </button>
                                    </form>
                                    
                                    <button type="button" action="{{route('Exam-dashboard.destroy-exam',$lesson -> id)}}"
                                        class="btn rounded-3 bg-gradient-danger  border-2 fw-bolder mx-1 delete notification-active "
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        حذف الاختبار
                                    </button>
                                @else
                                    <a href="{{route('Exam-dashboard.create',$lesson -> id)}}" class="btn rounded-3  bg-gradient-warning border-2 fw-bolder mx-1">إضافة اختبار للدرس</a>
                                @endif






                  
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
        </div>

        {!! $accessors ->onEachSide(2)-> links() !!}
    </div>
 
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة دروس بعد</div>

    @endif

@endsection
@else
    @section('path')
        <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
    @endsection


    @section('content')
    <div class="m-3 ">
        <a class=" btn rounded-3 bg-gradient-primary mx-1" target="_blank"  href="{{route('LessonAccessor-dashboard.create',$lesson_id)}}">أضافة درس ملحق جديد</a>
    </div>
    <div  class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة دروس ملحقة بعد  </div>
    @endsection
@endif
@section('script')
<script>
     scroll_to_right();
     move_buttons();
 delete_buttons();
    ajax_function();

    let accessors_filter_btn = document.getElementById("{{Session::get('accessors-filter')}}");
    if(accessors_filter_btn){
        $(accessors_filter_btn).addClass('bg-gradient-dark');
    }

</script>
@endsection