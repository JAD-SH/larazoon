@extends('layouts.admin.dashboard')

@section('title','الأقسام الفرعية')

@section('css')
<style>
   
</style>
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">الأقسام الفرعية</li>
@endsection

@section('content')

    <div class="m-3 mb-0">
        <a class=" btn rounded-3 bg-gradient-primary mx-1"  target="_blank" href="{{route('SubCategory-dashboard.create')}}">أضافة قسم جديد</a>
        <a class="btn rounded-3 bg-gradient-warning mx-1" href="{{route('SubCategory-dashboard.trashed')}}">سلة المهملات <i class="fa-solid fa-trash-can text-danger text-gradient  "></i></a>
    </div>






    @if($subcategories->count() > 0)
      <div class="card m-1 m-md-3 border-0 rounded-5 mb-5 overflow-hidden shadow-sm">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">الأقسام الفرعية</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr class="text-nowrap">
                        <th class=" text-center fw-bolder">العنوان</th>
                        <th class=" text-center fw-bolder">الفقرات</th>
                        <th class=" text-center fw-bolder">الأيقونة</th>
                        <th class=" text-center fw-bolder">اللون</th>
                        <th class=" text-center fw-bolder">المشاهدات</th>
                        <th class=" text-center fw-bolder">الاعجابات</th>
                        <th class=" text-center fw-bolder">الحالة</th>
                        <th class=" text-center fw-bolder">slug</th>
                        <th class=" text-center fw-bolder">الوصف</th>
                        <th class=" text-center fw-bolder">اخر تعديل</th>
                        <th class=" text-center fw-bolder">العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-nowrap align-middle">
                  @isset($subcategories)
                  @foreach($subcategories as $subcategory)
                  <tr id="item-{{$subcategory->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$subcategory -> title}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$subcategory -> categories()->count()}}</span>
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <div class="m-3">
                              <i class="{{$subcategory -> icon}} fs-5"></i>
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <div class="m-3">
                                <label class="btn text-light btn-{{$subcategory ->color}}  border-2 fw-bolder">{{$subcategory ->color}}</label>
                            </div>
                        </td>
                        
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$subcategory -> categories()->sum('views')}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$subcategory -> categories()->sum('likes')}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$subcategory -> getActive()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$subcategory -> slug}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$subcategory -> description}} </span>
                            </div>
                        </td>
                        
                        
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$subcategory -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">

                              @if($subcategory->categories()->count() !== 0)
                                <a href="{{route('SubCategory-dashboard.show',$subcategory -> id)}}" class="btn  bg-gradient-success  border-2 fw-bolder mx-1">الفقرات</a>
                              @else
                                <span class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">لا فقرات</span>
                              @endif

                            

                              <a href="{{route('Category-dashboard.create',$subcategory -> id)}}" target="_blank" class="btn  bg-gradient-primary  border-2 fw-bolder mx-1">إضافة فقرة جديدة</a>

                              <a href="{{route('SubCategory-dashboard.edit',$subcategory -> id)}}" class="btn  bg-gradient-warning  border-2 fw-bolder mx-1">تعديل</a>
                                                      
                              <form class="d-inline" action="{{route('SubCategory-dashboard.status',$subcategory -> id)}}" method="POST">
                                  @csrf
                                  <button class="btn  border-2 fw-bolder mx-1 ajax-submit
                                  @if($subcategory -> active == 0)
                                  btn-outline-info text-info
                                  @else
                                  bg-gradient-info text-white
                                  @endif
                                  ">@if($subcategory -> active == 0)
                                      تفعيل
                                      @else
                                      الغاء تفعيل
                                  @endif
                                  </button>
                              </form>

                              <button type="button" action="{{route('SubCategory-dashboard.destroy',$subcategory -> id)}}"
                                  class="btn  bg-gradient-danger  border-2 fw-bolder mx-1 delete notification-active"
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
        {!! $subcategories ->onEachSide(2)-> links() !!}
      </div>


<!-- 
  
<div class="card px-0 my-5  overflow-hidden">
        <h5 class="font-weight-bolder m-2 text-center p-3">الأقسام الفرعية</h5>
        <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
          <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
        </div>
          <div class="table-responsive row">
              <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
          <thead>
              <tr >
                  <th class="border-dark text-center text-uppercase font-weight-bolder">العنوان</th>
                  <th class="border-dark text-center text-uppercase font-weight-bolder">الأيقونة</th>
                  <th class="border-dark text-center text-uppercase font-weight-bolder">اللون</th>
                  <th class="border-dark text-center text-uppercase font-weight-bolder">الحالة</th>
                  <th class="border-dark text-center text-uppercase font-weight-bolder">الفقرات</th>
                  <th class="border-dark text-center text-uppercase font-weight-bolder">الوصف</th>
                  <th class="border-dark text-center text-uppercase font-weight-bolder">اخر تعديل</th>
                  <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>
              </tr>
          </thead>
          <tbody class="table-group-divider">
          @isset($subcategories)
          @foreach($subcategories as $subcategory)
              <tr id="item-{{$subcategory->id}}">
                  <td class="text-center  text-wrap">
                      <div class="m-3 ">
                          <h6 class="mb-0">{{$subcategory -> title}}</h6>
                      </div>
                  </td>
                  
                  <td class="text-center  text-wrap">
                      <div class="m-3 ">
                          <i class="{{$subcategory -> icon}}"></i>
                      </div>
                  </td>
                  
                  <td class="text-center  text-wrap">
                      <div class="m-3 ">
                          <label class="btn text-light btn-{{$subcategory ->color}}  border-2 font-weight-bolder">{{$subcategory ->color}}</label>
                      </div>
                  </td>
                
                  <td  class=" text-center  text-wrap">
                      <div class="m-3 ">
                          
                          <h6 class="">{{$subcategory -> getActive()}}</h6>
                      </div>
                  </td>
                  
                
                  <td  class=" text-center  text-wrap">
                      <div class="m-3 ">
                          
                          <h6 class="">{{$subcategory -> categories()->count()}}</h6>
                      </div>
                  </td>
                  
                  <td   class=" text-center text-wrap">
                      <div class="m-3 ">
                          <h6 class="mb-0" >{{$subcategory -> description}}</h6>
                      </div>
                  </td>
                
                  
                  <td   class=" text-center">
                      <div class="m-3">
                          <h6 class="mb-0">{{$subcategory -> created_at->diffForHumans()}}</h6>
                      </div>
                  </td>
                
                  <td  class=" text-center" >
                      <div class="m-3">

                          <a href="{{route('SubCategory-dashboard.show',$subcategory -> id)}}" class="btn text-light btn-success  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">الفقرات</h6></a>

                          <a href="{{route('Category-dashboard.create',$subcategory -> id)}}" target="_blank" class="btn text-light btn-success  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">إضافة فقرة جديدة</h6></a>
                          
                          <a href="{{route('SubCategory-dashboard.edit',$subcategory -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">تعديل</h6></a>
                                                  
                          <form class="d-inline" action="{{route('SubCategory-dashboard.status',$subcategory -> id)}}" method="POST">
                              @csrf
                              <button class="fs-6 btn border-2 font-weight-bolder mx-1 ajax-submit
                              @if($subcategory -> active == 0)
                              btn-outline-info text-info
                              @else
                                  btn-info text-white
                              @endif
                              ">@if($subcategory -> active == 0)
                                  تفعيل
                                  @else
                                  الغاء تفعيل
                              @endif
                              </button>
                          </form>
                          
                          <button type="button" action="{{route('SubCategory-dashboard.destroy',$subcategory -> id)}}"
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
  {!! $subcategories ->onEachSide(2)-> links() !!}
</div>
 
-->



      @if($cat_top_likes->count() > 0)
        <div class="mx-3 mx-md-4  my-5">
          <div class="row ">
            <div class=" px-0">
              <div class="card  border-0 rounded-5  shadow-sm">
                <div class=" p-0 position-relative mt-n4 mx-3 z-index-2 ">
                  <div class="bg-gradient-primary shadow-primary p-3 rounded-5 text-center mx-5">
                    <span class="text-white fw-bolder text-capitalize ps-3 text-center fs-5">الفقرات الاكثر اعجابا</span>
                  </div>
                </div>
                <div class="card-body px-0 pb-0">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0  text-center">
                      <thead>
                        <tr class="">
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">عنوان الفقرة</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">الاعجابات</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">القسم الفرعي التابع له</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">ID</span></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($cat_top_likes as $index=>$category)
                        <tr class="align-middle">
                            <td class="px-1 py-3">
                              <div class="d-flex flex-column justify-content-center">
                                  <span class="mb-0   fw-bolder">  #{{$index+1}}</span>
                              </div>
                            </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder">{{$category->title}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder">{{$category->likes}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                              <span class="mb-0 text-sm text-uppercase  fw-bolder">{{$category->subcategory->title}} </span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder"> {{$category->id}}</span>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
<!-- 
  
  <div class="mx-3 mx-md-4  mt-5">
    <div class="row ">
      <div class=" ">
        <div class="card px-3">
          <div class="card-header pb-0">
            <div class="row text-center">
              <span class="font-weight-bold fs-5 text-info">الفقرات الاكثر اعجابا</span> 
            </div>
          </div>
          <div class="card-body px-0 pb-0">
            <div class="table-responsive">
              <table class="table align-items-center mb-0  ">
                <thead>
                  <tr  class="">
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">عنوان الفقرة</span></th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">الاعجابات</span></th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">القسم الفرعي التابع له</span></th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">id</span></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($cat_top_likes as $index=>$category)
                  <tr>
                      <td class="px-1 py-3">
                      <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-uppercase  font-weight-bolder"> __{{$index+1}}__</h6>
                      </div>
                  </td>
                  
                    <td class="px-1 py-3">
                      <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$category->title}}</h6>
                      </div>
                    </td>
                    <td class="px-1 py-3">
                      <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$category->likes}}</h6>
                      </div>
                    </td>
                    <td class="px-1 py-3">
                      <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$category->subcategory->title}}</h6>
                      </div>
                    </td>
                    <td class="px-1 py-3">
                      <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$category->id}}#</h6>
                      </div>
                    </td>
                  </tr>
                  
                  @endforeach
                </tbody>
              </table>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
-->
 




      @if($cat_top_views->count() > 0)
        <div class="mx-3 mx-md-4  my-5">
          <div class="row ">
            <div class=" px-0">
              <div class="card  border-0 rounded-5  shadow-sm">
                <div class=" p-0 position-relative mt-n4 mx-3 z-index-2 ">
                  <div class="bg-gradient-primary shadow-primary p-3 rounded-5 text-center mx-5">
                    <span class="text-white fw-bolder text-capitalize ps-3 text-center fs-5">الفقرات الاكثر مشاهدة</span>
                  </div>
                </div>
                <div class="card-body px-0 pb-0">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0  text-center">
                      <thead>
                        <tr class="">
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">عنوان الفقرة</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">المشاهدات</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">القسم الفرعي التابع له</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">ID</span></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($cat_top_views as $index=>$category)
                        <tr class="align-middle">
                            <td class="px-1 py-3">
                              <div class="d-flex flex-column justify-content-center">
                                  <span class="mb-0   fw-bolder">  #{{$index+1}}</span>
                              </div>
                            </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder">{{$category->title}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder">{{$category->views}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                              <span class="mb-0 text-sm text-uppercase  fw-bolder">{{$category->subcategory->title}} </span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder"> {{$category->id}}</span>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
      @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة اقسام فرعية بعد</div>

    @endif
<!-- 
  
<div class="mx-3 mx-md-4  mt-5">
  <div class="row ">
    <div class=" mb-md-5 mb-4">
      <div class="card px-3">
        <div class="card-header pb-0">
          <div class="row text-center">
            <span class="font-weight-bold fs-5 text-info">الفقرات الاكثر مشاهدة</span> 
          </div>
        </div>
        <div class="card-body px-0 pb-0">
          <div class="table-responsive">
            <table class="table align-items-center mb-0  ">
              <thead>
                <tr  class="">
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">عنوان الفقرة</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">المشاهدات</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">القسم الفرعي التابع له</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">id</span></th>
                </tr>
              </thead>
              <tbody>
                @foreach($cat_top_views as $index=>$category)
                <tr>
                    <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-uppercase  font-weight-bolder"> __{{$index+1}}__</h6>
                    </div>
                </td>
                
                <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$category->title}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$category->views}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$category->subcategory->title}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$category->id}}#</h6>
                    </div>
                  </td>
                </tr>
                
                @endforeach
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

-->

@endsection

@section('script')
<script>
   scroll_to_right();
 delete_buttons();
    ajax_function();
</script>
@endsection