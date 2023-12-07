@extends('layouts.admin.dashboard')

@section('title','Media')

@section('css')
<style>

</style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">Media</li>

@endsection

@section('content')

 

    <div class="m-3 ">
        <a class="btn rounded-3 bg-gradient-primary mx-1" target="_blank" href="{{route('Media-dashboard.create')}}">أضافة Media جديدة</a>
    </div>

    <div class="card border-0 text-center mx-1 mx-md-3 bg-none  rounded-5 py-4 d-block shadow-sm">

        <a id='index' href="{{route('Course-dashboard.media-page')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> الكل  </a>

        <a id='audio' href="{{route('Course-dashboard.media-page','audio')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> الصوت  </a>

        <a id='video' href="{{route('Course-dashboard.media-page','video')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> الفيديو  </a>

        <a id='image' href="{{route('Course-dashboard.media-page','image')}}" class="btn bg-gradient-primary m-1 fw-bolder rounded-3 fs-6"> الصور  </a>

    </div>

@isset($media)
    @if($media->count() >0)
     
    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">Media</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">slug</th>
                        <th class=" text-center fw-bolder">النوع</th>
                        <th class=" text-center fw-bolder">media</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    
                    @foreach($media as $medy)
                    <tr id="item-{{$medy->id}}">
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder fs-6 text-dark">{{$medy -> slug}}</span>
                            </div>
                        </td> 
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder fs-6 text-dark">{{$medy -> gettype()}}</span>
                            </div>
                        </td> 
                        
                        <td class="text-center">
                            <div class="m-3">
                                @if($medy -> gettype() == 'صور')
                                    <img src="{{$medy -> media}}" class="w-100" alt="team4" style="width: 100px !important;">
                                @elseif($medy -> gettype() == 'فيديو')
                                    <a class="btn rounded-3 bg-gradient-light mx-1 " target="_blank" href="{{$medy -> media}}">شاهد الفيديو</a>
                                @elseif($medy -> gettype() == 'صوت')
                                    <audio controls>
                                        <source src="{{$medy -> media}}" type="{{$medy -> type}}">
                                        المتصفح لا يدعم الصوت
                                    </audio>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    {!! $media ->onEachSide(2)-> links() !!}
 
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة Media بعد</div>

    @endif
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة Media بعد</div>

@endisset

@endsection

@section('script')
<script>
    scroll_to_right();
     delete_buttons();
    ajax_function();
 
</script>
@endsection
