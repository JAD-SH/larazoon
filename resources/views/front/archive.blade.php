
@extends('layouts.front.site')

@section('title',$className.' المحفوظة ')

@section('meta_tags')
<meta name="robots" content="noindex">
@endsection

@section('css')

<style>
  .accordion-button::after {
    color:white !important;
  }
</style>
@endsection



@section('path')

    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('profile')}}"> <i class="fa-solid fa-address-card "></i></a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">جميع {{$className}} المحفوظة</li>
@endsection

@section('content')


@include('front.includes.alerts.delete-modal', ['title_warning' => 'حذف الحفظ','description_warning' => 'هل تريد حذف هذا العنصر من قائمة '.$className.' المحفوظة'])

   
  <div class="card  m-1 m-md-4 p-2 p-md-4  border-0 rounded-5  shadow-sm mb-3 text-center">
      
  
    <div class="card m-1 m-md-2 page-title p-3 p-md-3  border-0 rounded-5 shadow-sm bg-gradient-primary">
        <h1 class="text-center text-light fs-4 mb-0">{{$className}} المحفوظة</h1>
    </div>


  @if($archiveItems !== null)
    <div class="list-group col-12  col-lg-10 mx-auto my-4 rounded-5">
   
  
      @foreach($archiveItems as $index=>$item)
        
      <div data-sos-once="true" data-sos="sos-zoom-out" id="item-{{$item->pivot->id}}"  class="list-group-item list-group-item-action d-flex justify-content-around align-items-center p-0 pe-2">
          <a href="@switch($className)
            @case('الدروس') {{route('show-lesson',[$item->group->course->slug,$item->slug])}} @break
            @case('المقالات') {{route('Article.show',$item->slug)}} @break
            @case('الكتب') {{route('Book.show',$item->slug)}} @break
            @case('الاسئلة') {{route('Question.show',$item->slug)}} @break
            @case('الفقرات') {{route('show-category',[$item->subcategory->slug,$item->slug])}} @break
            @default
          @endswitch"
          class="w-85 d-inline-block h-100  py-2">
          <div class="me-auto ms-2">
            <span class="float-start fw-bolder fs-5">
              {{$item->title}}
            </span>
            
          </div>
        </a>
        
        <div class="float-end d-inline-block py-2">
          <button type="button"  action="{{route('User.archive-remove', $item->pivot->id)}}"  class="btn rounded-3 bg-gradient-danger delete" data-bs-toggle="modal" data-bs-target="#DeleteModal">
            <i class="fa-solid fa-trash-can text-gradient fs-5"></i>
          </button>
        </div>
      </div>
    
      @endforeach
    </div>
    <div class="text-center my-3">
      {!! $archiveItems ->onEachSide(2)-> links() !!}
    </div>
  @else
    <div class="fs-4 text-center p-5 fw-bolder pt-1">لم تقوم بحفظ اي عنصر </div>
  @endif 

  </div>
   
@endsection


@section('script')

<script>
delete_buttons();
</script>

@endsection

