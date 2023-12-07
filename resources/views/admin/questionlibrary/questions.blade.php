@extends('layouts.admin.dashboard')

@section('title','مكتبة الأسئلة')

@section('css')
<style>
   
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('QuestionLibrary-dashboard.index')}}">قسم مكتبة الاسئلة</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">الكورس {{$questions[0]->questionlibraries->first()->title}}</li>
@endsection

@section('content')




@if($questions->count() > 0)


    <div class="card border-0 text-center mx-1 mx-md-3 bg-none  rounded-5 py-4 d-block shadow-sm">

        <a id="filter-index" href="{{route('QuestionLibrary-dashboard.show',$library_id)}}" class="btn bg-gradient-{{$questions[0]->questionlibraries[0]->maincategory->first()->color}} m-1 fw-bolder rounded-3 fs-6"> الأحدث  </a>
        <a id="filter-older" href="{{route('QuestionLibrary-dashboard.older',$library_id)}}" class="btn bg-gradient-{{$questions[0]->questionlibraries[0]->maincategory->first()->color}} m-1 fw-bolder rounded-3 fs-6"> الاقدم  </a>
        <a id="filter-unactive" href="{{route('QuestionLibrary-dashboard.un-active',$library_id)}}" class="btn bg-gradient-{{$questions[0]->questionlibraries[0]->maincategory->first()->color}} m-1 fw-bolder rounded-3 fs-6"> الغير مفعل  </a>
        <a id="filter-top-views" href="{{route('QuestionLibrary-dashboard.top-views',$library_id)}}" class="btn bg-gradient-{{$questions[0]->questionlibraries[0]->maincategory->first()->color}} m-1 fw-bolder rounded-3 fs-6">  الأكثر مشاهدة   </a>
        <a id="filter-top-likes" href="{{route('QuestionLibrary-dashboard.top-likes',$library_id)}}" class="btn bg-gradient-{{$questions[0]->questionlibraries[0]->maincategory->first()->color}} m-1 fw-bolder rounded-3 fs-6"> الأكثر اعجابا  </a>
        <a id="filter-top-comments" href="{{route('QuestionLibrary-dashboard.top-likes',$library_id)}}" class="btn bg-gradient-{{$questions[0]->questionlibraries[0]->maincategory->first()->color}} m-1 fw-bolder rounded-3 fs-6"> الأكثر إجابات  </a>
 
    </div>


    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">مكتبة الأسئلة </h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">العنوان</th>
                        <th class=" text-center fw-bolder">المشاهدات</th>
                        <th class=" text-center fw-bolder">الاعجابات</th>
                        <th class=" text-center fw-bolder">الحالة</th>
                        <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    @isset($questions)
                    @foreach($questions as $question)
                    <tr id="item-{{$question->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$question->title}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$question -> views}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$question -> likes}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$question -> getActive()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$question -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                

                                <a  href="#" class=" btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">عرض السؤال</a>
                                
                                <form class="d-inline" action="{{route('QuestionLibrary-dashboard.question-status',$question -> id)}}" method="POST">
                                    @csrf
                                    <button class="btn rounded-3  border-2 fw-bolder mx-1  ajax-submit
                                    @if($question -> active == 0)
                                    btn-outline-info text-info
                                    @else
                                    bg-gradient-info text-white
                                    @endif
                                    ">@if($question -> active == 0)
                                        تفعيل
                                        @else
                                        الغاء تفعيل
                                    @endif
                                    </button>
                                </form>
                                
                                <button type="button" action="{{route('QuestionLibrary-dashboard.destroy-question',$question -> id)}}"
                                    class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-danger delete notification-active fs-6"
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

        {!! $questions ->onEachSide(2)-> links() !!}
    </div>

@else
        <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة اسئلة بعد</div>

@endif


<!-- 
    
<div class="card px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">مكتبة الأسئلة</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
        <thead>
            <tr>
                <th class="border-dark text-center text-uppercase font-weight-bolder">عنوان السؤال</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الحالة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">المشاهدات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الاعجابات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">اخر تعديل</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        @isset($questions)
        @foreach($questions as $question)
            <tr id="item-{{$question->id}}">
                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$question -> title}}</h6>
                    </div>
                </td>
                
                <td  class=" text-center">
                    <div class="m-3 ">
                        <h6 class="">{{$question -> getActive()}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$question -> views}}</h6>
                    </div>
                </td>

                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$question -> likes}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$question -> created_at->diffForHumans()}}</h6>
                    </div>
                </td>
               

                <td  class=" text-center" >
                    <div class="m-3">
                        <a  href="#" class=" btn text-light btn-success border-2 font-weight-bolder mx-1"><h6 class="text-white mb-0">عرض السؤال</h6></a>
                           
                        <form class="d-inline" action="{{route('QuestionLibrary-dashboard.question-status',$question -> id)}}" method="POST">
                            @csrf
                            <button class="fs-6 btn border-2 font-weight-bolder mx-1 ajax-submit
                            @if($question -> active == 0)
                            btn-outline-info text-info
                            @else
                                btn-info text-white
                            @endif
                            ">@if($question -> active == 0)
                                تفعيل
                                @else
                                الغاء تفعيل
                            @endif
                            </button>
                        </form>
                        
                        <button type="button" action="{{route('QuestionLibrary-dashboard.destroy-question',$question -> id)}}"
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
    {!! $questions ->onEachSide(2)-> links() !!}

</div>

-->

@endsection

@section('script')
<script>
     scroll_to_right();
    delete_buttons();
    ajax_function();
    let questions_filter_btn = document.getElementById("{{Session::get('questions-filter')}}");
    if(questions_filter_btn){
        $(questions_filter_btn).addClass('bg-gradient-dark');
    }
</script>
@endsection