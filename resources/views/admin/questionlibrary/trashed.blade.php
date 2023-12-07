@extends('layouts.admin.dashboard')

@section('title','قسم الاسئلة')

@section('css')
<style>

</style>
@endsection

@section('path')
<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('QuestionLibrary-dashboard.index')}}">قسم مكتبة الاسئلة</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">سلة الاسئلة المحذوفة </li>

@endsection

@section('content')


    @if($trashed->count() >0)


    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">سلة الاسئلة المحذوفة</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
        <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
            <thead>
                <tr>
                    <th class=" text-center fw-bolder">العنوان</th>
                    <th class=" text-center fw-bolder">تابع ل</th>
                    <th class=" text-center fw-bolder">المشاهدات</th>
                    <th class=" text-center fw-bolder">الاعجابات</th>
                    <th class=" text-center fw-bolder">الحالة</th>
                    <th class=" text-center fw-bolder">الوصف</th>
                    <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                    <th class=" text-center fw-bolder">تاريخ الحذف</th>
                    <th class=" text-center fw-bolder">العمليات</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-nowrap align-middle">
                @isset($trashed)
                @foreach($trashed as $question)
                <tr id="item-{{$question->id}}">
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder fs-6 text-dark">{{$question->title}}</span>
                        </div>
                    </td>
                    
                    <td class=" text-center">
                        <div class="m-3">
                            @foreach($question->questionlibraries as $questionlibrary)
                                <span class="mb-0 fw-bolder text-uppercase  fs-6 text-dark">- {{$questionlibrary->title}} </span>
                            @endforeach
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
                    
                    <td class=" text-center text-wrap">
                        <div class="m-3 ">
                            <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$question -> description}} </span>
                        </div>
                    </td>
                    
                    
                    
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder">{{$question -> created_at->diffForHumans()}}</span>
                        </div>
                    </td>
                    <td class=" text-center">
                        <div class="m-3">
                            <span class="mb-0 fw-bolder">{{$question -> deleted_at->diffForHumans()}}</span>
                        </div>
                    </td>
                    
                    <td class=" text-center">
                        <div class="m-3">
                            
                                  
                        <form class="d-inline delete-form-notification" action="{{route('QuestionLibrary-dashboard.restore',$question -> id)}}" method="POST">
                                    @csrf
                                    <button type="button" 
                                        class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-info ajax-submit">
                                        استعادة
                                    </button>
                                </form>


                        </div>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
        </div>

        {!! $trashed ->onEachSide(2)-> links() !!}
    </div>

    @else
    <div class="fs-4 text-center p-5 font-weight-bolder">لا يوجد اسئلة في سلة المهملات</div>

    @endif


@endsection

@section('script')
<script>
    scroll_to_right();
    ajax_function();
</script>
@endsection
