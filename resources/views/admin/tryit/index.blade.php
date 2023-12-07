@extends('layouts.admin.dashboard')

@section('title','قسم TryIt')

@section('css')
<style>

</style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">TryIt</li>

@endsection

@section('content')

 

    <div class="m-3 ">
        @isset($tryitable_type)
            <a class="btn rounded-3 bg-gradient-primary mx-1" target="_blank" href="{{route('Tryit-dashboard.create',[$tryitable_id,$tryitable_type])}}">أضافة TryIt جديد</a>
        @else
            <a class="btn rounded-3 bg-gradient-primary mx-1" target="_blank" href="{{route('Tryit-dashboard.create')}}">أضافة TryIt جديد</a>
        @endisset
    </div>
@isset($tryitcodes)
    @isset($tryitable_type)
    @else
    <div class="card border-0 text-center mx-1 mx-md-3 bg-none  rounded-5 py-4 d-block shadow-sm">

        <a id='index' href="{{route('Course-dashboard.tryit-page')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> الكل  </a>

        <a id='css' href="{{route('Course-dashboard.tryit-page','css')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> css  </a>

        <a id='html' href="{{route('Course-dashboard.tryit-page','html')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> html  </a>

        <a id='javascript' href="{{route('Course-dashboard.tryit-page','javascript')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> javascript  </a>

        <a id='htmlmixed' href="{{route('Course-dashboard.tryit-page','htmlmixed')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> htmlmixed  </a>

        <a id='php' href="{{route('Course-dashboard.tryit-page','php')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> php  </a>

        <a id='python' href="{{route('Course-dashboard.tryit-page','python')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> python   </a>

        <a id='sass' href="{{route('Course-dashboard.tryit-page','sass')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> sass  </a>

        <a id='sql' href="{{route('Course-dashboard.tryit-page','sql')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> sql  </a>

    </div>
    @endisset
    @if($tryitcodes->count() >0)

    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">Tryit</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">slug</th>
                        <th class=" text-center fw-bolder">النوع</th>
                        <th class=" text-center fw-bolder">الكود</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    
                    @foreach($tryitcodes as $tryit)
                    <tr id="item-{{$tryit->id}}">
                        
                       <td class=" text-center">
                           <div class="m-3">
                               
                               <span class=" fw-bolder fs-6 text-dark">{{$tryit -> slug}}</span>
                           </div>
                       </td>

                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$tryit->type}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$tryit -> code}} </span>
                            </div>
                        </td>
                         
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <a href="{{route('tryit-page',$tryit->slug);}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">عرض TryIt</a>
                                <a href="{{route('Tryit-dashboard.edit',$tryit -> id)}}" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1 ">تعديل</a>
                                                      
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

    @isset($tryitable_type)
    @else
        {!! $tryitcodes ->onEachSide(2)-> links() !!}
    @endisset
    

 
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة اكواد TryIt بعد</div>

    @endif
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة اكواد TryIt بعد</div>

@endisset

@endsection

@section('script')
<script>
    scroll_to_right();
     delete_buttons();
    ajax_function();
 
    @isset($tryitable_type)
    @else
        $("#{{$search_type}}").addClass('bg-gradient-dark');
    @endisset
</script>
@endsection
