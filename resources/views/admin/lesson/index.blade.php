@extends('layouts.admin.dashboard')

@section('title','قسم الدروس')

@section('css')
<style>
   
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('Course-dashboard.index')}}">قسم الكورسات</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">جروب الدروس ({{$lessons[0]->group->title}}) </li>
@endsection

@section('content')

    <div class="m-3 ">
        <a class=" btn rounded-3 bg-gradient-primary mx-1" target="_blank"  href="{{route('Lesson-dashboard.create',$lessons[0]->group -> id)}}">أضافة درس جديد</a>
        <a class="btn rounded-3 bg-gradient-warning mx-1" href="{{route('Lesson-dashboard.trashed',$lessons[0]->group -> id)}}">سلة المهملات <i class="fa-solid fa-trash-can text-danger text-gradient  "></i></a>

    </div>



    @if($lessons->count() > 0)

    <div class="card border-0 text-center mx-1 mx-md-3 bg-none  rounded-5 py-4 d-block shadow-sm">

        <a id="filter-index" href="{{route('LessonGroup-dashboard.show',$group_id)}}" class="btn bg-gradient-{{$lessons[0]->group->course->color}} m-1 fw-bolder rounded-3 fs-6"> الأحدث  </a>
        <a id="filter-older" href="{{route('LessonGroup-dashboard.older',$group_id)}}" class="btn bg-gradient-{{$lessons[0]->group->course->color}} m-1 fw-bolder rounded-3 fs-6"> الاقدم  </a>
        <a id="filter-unactive" href="{{route('LessonGroup-dashboard.un-active',$group_id)}}" class="btn bg-gradient-{{$lessons[0]->group->course->color}} m-1 fw-bolder rounded-3 fs-6"> الغير مفعل  </a>
        <a id="filter-top-views" href="{{route('LessonGroup-dashboard.top-views',$group_id)}}" class="btn bg-gradient-{{$lessons[0]->group->course->color}} m-1 fw-bolder rounded-3 fs-6">  الأكثر مشاهدة   </a>
        <a id="filter-top-likes" href="{{route('LessonGroup-dashboard.top-likes',$group_id)}}" class="btn bg-gradient-{{$lessons[0]->group->course->color}} m-1 fw-bolder rounded-3 fs-6"> الأكثر اعجابا  </a>
 
    </div>

    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">الدروس (<span class="text-{{$lessons[0]->group->course->color}} fs-5">{{$lessons[0]->group->title}}</span>)</h5>
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
                        <th class=" text-center fw-bolder">اسئلة الاختبار</th>
                        <th class=" text-center fw-bolder">الحالة</th>
                        <th class=" text-center fw-bolder">slug</th>
                        <th class=" text-center fw-bolder">الدروس الملحقة</th>
                        <th class=" text-center fw-bolder">الوصف</th>
                        <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @isset($lessons)
                    @foreach($lessons as $lesson)
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
                                
                                <span class=" fw-bolder">{{$lesson -> exams()->count()}}</span>
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
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$lesson -> accessors->count()}}</span>
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
                                
                                <a href="{{route('Lesson-dashboard.accessors',$lesson -> id)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 text-light">دروس ملحقة</a>
                                
                                <button type="button" action="{{route('Lesson-dashboard.move',$lesson -> id)}}"
                                class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-primary move"
                                data-bs-toggle="modal" data-bs-target="#MoveToList">
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

        {!! $lessons ->onEachSide(2)-> links() !!}
    </div>


    <div class="modal fade" id="MoveToList" tabindex="-1" role="dialog" aria-labelledby="MoveToListTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
                <div class="modal-header  p-0 pb-3">
                    <div class="modal-title fs-6  fw-bolder text-danger" id="exampleModalLabel">نقل الدرس لكورس اخر</div>
                    <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                    <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mt-3">
                        <button type="button" action="{{route('Lesson-dashboard.move',$lesson -> id)}}"
                            class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-primary move"
                            data-bs-toggle="modal" data-bs-target="#MoveToCourse">
                            نقل لكورس اخر
                        </button>
                        <button type="button" action="{{route('Lesson-dashboard.move',$lesson -> id)}}"
                            class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-primary move"
                            data-bs-toggle="modal" data-bs-target="#MoveToGroup">
                            نقل لجروب في نفس الكورس اخر
                        </button>
                        <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">رجوع</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="MoveToGroup" tabindex="-1" role="dialog" aria-labelledby="MoveToGroupTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
                <div class="modal-header  p-0 pb-3">
                    <div class="modal-title fs-6  fw-bolder text-danger" id="exampleModalLabel">نقل الدرس لجروب اخر</div>
                    <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                    <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="move-form" method="POST" >
                        @csrf    
                        <select class="form-select" aria-label="Default select example"  name="group_id">
                            @foreach($lessons[0]->group->course->groups as $group)
                                <option class="text-dark"  value="{{$group->id}}">{{$group->title}}</option>
                            @endforeach
                        </select>
                        <div class="mt-3">
                            <button class="btn rounded-3 bg-gradient-primary fs-6 ajax-submit" data-bs-dismiss="modal">موافق .. قم بالنقل</button>
                            <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">رجوع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="MoveToCourse" tabindex="-1" role="dialog" aria-labelledby="MoveToCourseTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
                <div class="modal-header  p-0 pb-3">
                    <div class="modal-title fs-6  fw-bolder text-danger" id="exampleModalLabel">نقل الدرس لكورس اخر</div>
                    <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                    <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="move-form" method="POST" >
                        @csrf    
                        
                        <select class="form-select" aria-label="Default select example"  name="group_id">
                            @if(Courses() !== null)
                                @foreach(Courses() as $course)

                                    @if($course->id == $lessons[0]->group->course->id)
                                        @continue
                                    @endif
                                    @foreach($course->groups as $group) 
                                        <option class="text-dark"  value="{{$group->id}}">{{$course->title}}-{{$group->title}}</option>
                                    @endforeach
                                @endforeach
                            @endif
                        </select>
                        <div class="mt-3">

                            <button class="btn rounded-3 bg-gradient-primary fs-6 ajax-submit" data-bs-dismiss="modal">موافق .. قم بالنقل</button>
                            <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">رجوع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة دروس بعد</div>

    @endif

<!--
    

<div class="card  px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">الدروس</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
    <thead>
            <tr >
                <th class="border-dark text-center text-uppercase font-weight-bolder">العنوان</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الحالة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">المشاهدات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الاعجابات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الوصف</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">اسئلة الاختبار</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">اخر تعديل</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>

            </tr>
        </thead>
        <tbody class="table-group-divider">
        @isset($lessons)
        @foreach($lessons as $lesson)
            <tr id="item-{{$lesson->id}}">
                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$lesson->title}}</h6>
                    </div>
                </td>

                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$lesson->views}}</h6>
                    </div>
                </td>

                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$lesson->likes}}</h6>
                    </div>
                </td>
                
                <td  class=" text-center">
                    <div class="m-3 ">
                        
                        <h6 class="">{{$lesson -> getActive()}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center  text-wrap">
                    <div class="m-3">
                        <h6 class="mb-0"  style="width: 400px !important; ">{{$lesson -> description}}</h6>
                    </div>
                </td>
               
                <td   class=" text-center  text-wrap">
                    <div class="m-3">
                        <h6 class="mb-0"  style="width: 400px !important; ">{{$lesson -> exams()->count()}}</h6>
                    </div>
                </td>
               
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$lesson -> created_at->diffForHumans()}}</h6>
                    </div>
                </td>
               
                <td  class=" text-center" >
                    <div class="m-3">
                        
                        <a href="{{route('Lesson-dashboard.show',$lesson -> id)}}" class="btn text-light btn-success  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">عرض الدرس</h6></a>

                        <a href="{{route('Lesson-dashboard.edit',$lesson -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">تعديل</h6></a>
                        
                        
                        <form class="d-inline" action="{{route('Lesson-dashboard.status',$lesson -> id)}}" method="POST">
                            @csrf
                            <button class="fs-6 btn border-2 font-weight-bolder mx-1 ajax-submit
                            @if($lesson -> active == 0)
                            btn-outline-info text-info
                            @else
                            btn-info text-white
                            @endif
                            ">@if($lesson -> active == 0)
                            تفعيل
                            @else
                            الغاء تفعيل
                            @endif
                            </button>
                        </form>
                    
                        <button type="button" action="{{route('Lesson-dashboard.destroy',$lesson -> id)}}"
                            class="btn text-light btn-danger  border-2 font-weight-bolder mx-1 delete notification-active fs-6"
                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                            حذف
                        </button>

                        @if($lesson -> exams() ->count() > 0)
                            <a href="{{route('Exam-dashboard.show',$lesson -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">عرض وتعديل الاختبار</h6></a>
                            
                            <form class="d-inline" action="{{route('Exam-dashboard.status-exam',$lesson -> id)}}" method="POST">
                                @csrf
                                <button class="fs-6 btn border-2 font-weight-bolder mx-1 ajax-submit
                                @if($lesson -> active == 0)
                                btn-outline-info text-info
                                @else
                                    btn-info text-white
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
                                class="btn text-light btn-danger  border-2 font-weight-bolder mx-1 delete notification-active fs-6"
                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                حذف الاختبار
                            </button>
                        @else
                            <a href="{{route('Exam-dashboard.create',$lesson -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">إضافة اختبار للدرس</h6></a>
                        @endif
                        
                    </div>
                </td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table>
    </div>
    {!! $lessons ->onEachSide(2)-> links() !!}

</div>

 -->

@endsection

@section('script')
<script>
     scroll_to_right();
     move_buttons();
 delete_buttons();
    ajax_function();

    let lessons_filter_btn = document.getElementById("{{Session::get('lessons-filter')}}");
    if(lessons_filter_btn){
        $(lessons_filter_btn).addClass('bg-gradient-dark');
    }

</script>
@endsection