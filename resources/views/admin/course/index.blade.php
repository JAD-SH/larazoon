@extends('layouts.admin.dashboard')

@section('title','قسم الكورسات')

@section('css')
<style>
   
</style>
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">قسم الكورسات</li>

@endsection

@section('content')

    <div class="m-3  mb-0">
    <a class=" btn rounded-3 bg-gradient-primary mx-1" target="_blank"  href="{{route('Course-dashboard.create')}}">أضافة كورس جديد</a>

    </div>

    

    @if($courses->count() > 0)
    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-3 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">الكورسات</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">العنوان</th>
                        <th class=" text-center fw-bolder">الصورة</th>
                        <th class=" text-center fw-bolder">اللون</th>
                        <th class=" text-center fw-bolder">الدروس</th>
                        <th class=" text-center fw-bolder">المشاهدات</th>
                        <th class=" text-center fw-bolder">الاعجابات</th>
                        <th class=" text-center fw-bolder">المتابعين</th>
                        <th class=" text-center fw-bolder">الحالة</th>
                        <th class=" text-center fw-bolder">slug</th>
                        <th class=" text-center fw-bolder">الوصف</th>
                        <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @isset($courses)
                    @foreach($courses as $course)
                    <tr id="item-{{$course->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$course->title}}</span>
                            </div>
                        </td>
                        
                        <td class="atext-center">
                            <div class="m-3">
                                <img src="{{$course -> photo}}" class="w-100" alt="team4" style="width: 100px !important;">
                            </div>
                        </td>

                        <td class="text-center">
                            <div class="m-3">
                                <label class="btn text-light btn-{{$course ->color}}  border-2 fw-bolder">{{$course ->color}}</label>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$course->groups('groups')->with('lessons')->get()->pluck('lessons')->flatten()->count()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$course->groups('groups')->with('lessons')->get()->pluck('lessons')->flatten()->sum('views')}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$course->groups('groups')->with('lessons')->get()->pluck('lessons')->flatten()->sum('likes')}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$course -> users()->count()}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$course -> getActive()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$course -> slug}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$course -> description}} </span>
                            </div>
                        </td>
                        
                        
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$course -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                          <div class="m-3">

                            @if($course->groups()->count() !== 0)
                            <a href="{{route('Course-dashboard.show',$course -> id)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">جميع الجروبات</a>
                            @else
                            <span class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">لا جروبات</span>
                            @endif
                            
                            <a href="{{route('LessonGroup-dashboard.create',$course -> id)}}" target="_blank" class="btn rounded-3  bg-gradient-primary  border-2 fw-bolder mx-1 ">أضافة جروب جديد</a>
                            

                            @if($course->users()->count() !== 0)
                            <a href="{{route('Course-dashboard.followers',$course -> id)}}" class="btn rounded-3  bg-gradient-secondary  border-2 fw-bolder mx-1 ">المتابعين</a>
                            @else
                            <span class="btn rounded-3  bg-gradient-secondary  border-2 fw-bolder mx-1">لا متابعين</span>
                            @endif
                            
                            <a href="{{route('Course-dashboard.edit',$course -> id)}}" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1 ">تعديل</a>
                            
                            <form class="d-inline" action="{{route('Course-dashboard.status',$course -> id)}}" method="POST">
                                @csrf
                                <button class="btn rounded-3 border-2 font-weight-bolder mx-1 ajax-submit
                                @if($course -> active == 0)
                                btn-outline-info text-info
                                @else
                                bg-gradient-info text-white
                                @endif
                                ">@if($course -> active == 0)
                                    تفعيل
                                    @else
                                    الغاء تفعيل
                                @endif
                                </button>
                            </form>
                            
                            <button type="button" action="{{route('Course-dashboard.destroy',$course -> id)}}"
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
        {!! $courses ->onEachSide(2)-> links() !!}
    </div>
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة كورسات بعد</div>

    @endif
 
    <div class="m-3">
        <a href="{{route('Course-dashboard.media-page')}}" class="btn rounded-3  bg-gradient-dark  border-2 fw-bolder mx-1 text-light">Media <i class="fs-6 fa fa-play"></i></a>
        <a href="{{route('Course-dashboard.tryit-page')}}" class="btn rounded-3  bg-gradient-dark  border-2 fw-bolder mx-1 text-light">TryIt <i class="fs-6 fa fa-play"></i></a>
        <a href="{{route('Course-dashboard.downloader-page')}}" class="btn rounded-3  bg-gradient-dark  border-2 fw-bolder mx-1 text-light">Downloader</a>
    </div>
@endsection

@section('script')
<script>
     scroll_to_right();
 delete_buttons();
    ajax_function();

</script>
@endsection