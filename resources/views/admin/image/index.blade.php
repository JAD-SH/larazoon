@extends('layouts.admin.dashboard')

@section('title','الصور')

@section('css')
<style>

</style>
@endsection

@section('path')
    <li class="breadcrumb-item fw-bolder active " aria-current="page">الصور</li>

@endsection

@section('content')

 

<div class="m-3 ">
        <a class="btn rounded-3 bg-gradient-primary mx-1" target="_blank" href="{{route('Image-dashboard.create',[$imageable_id,$imageable_type])}}">أضافة صورة جديدة</a>
    </div>
@isset($images)
    @if($images->count() >0)
     
    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">الصور</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">الصورة</th>
                        <th class=" text-center fw-bolder">slug</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                    
                    @foreach($images as $image)
                    <tr id="item-{{$image->id}}">
                        
                        <td class="text-center">
                            <div class="m-3">
                                <img src="{{$image -> image}}" class="w-100" alt="team4" style="width: 100px !important;">
                            </div>
                        </td>

                       <td class=" text-center">
                           <div class="m-3">
                               
                               <span class=" fw-bolder fs-6 text-dark">{{$image -> slug}}</span>
                           </div>
                       </td> 
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

 
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة صور بعد</div>

    @endif
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة صور بعد</div>

@endisset

@endsection

@section('script')
<script>
    scroll_to_right();
     delete_buttons();
    ajax_function();
 
</script>
@endsection
