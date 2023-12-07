@extends('layouts.admin.dashboard')

@section('title','Downloader')

@section('css')
<style>

</style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">Downloader</li>

@endsection

@section('content')

 

    <div class="m-3 ">
        <a class="btn rounded-3 bg-gradient-primary mx-1" target="_blank" href="{{route('Downloader-dashboard.create')}}">أضافة Downloader جديدة</a>
    </div>

    
@isset($downloaders)
    @if($downloaders->count() > 0)
     
    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">Downloader</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">العنوان</th>
                        <th class=" text-center fw-bolder">slug</th>
                        <th class=" text-center fw-bolder">الوصف</th>
                        <th class=" text-center fw-bolder">downloader</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    
                    @foreach($downloaders as $downloader)
                    <tr id="item-{{$downloader->id}}">
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder fs-6 text-dark">{{$downloader -> title}}</span>
                            </div>
                        </td> 
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder fs-6 text-dark">{{$downloader -> slug}}</span>
                            </div>
                        </td> 
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$downloader -> description}} </span>
                            </div>
                        </td>

                        <td class="text-center">
                            <div class="m-3">
                                <a href="{{route('file.download',$downloader -> slug)}}">
                                    <button data-sos="sos-top" class="btn bg-gradient-light m-1 py-2 px-4 border-2 rounded-4 fw-bolder sos-top">
                                        تحميل الملف  <i class="fs-5 fa-solid fa-download"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    {!! $downloaders ->onEachSide(2)-> links() !!}
 
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة Downloader بعد</div>

    @endif
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة Downloader بعد</div>

@endisset

@endsection

@section('script')
<script>
    scroll_to_right();
     delete_buttons();
    ajax_function();
 
</script>
@endsection
