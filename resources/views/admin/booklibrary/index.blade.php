@extends('layouts.admin.dashboard')

@section('title','مكتبة الكتب')

@section('css')
<style>

</style>
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">قسم مكتبة الكتب</li>

@endsection

@section('content')


    <div class="m-3  mb-0">
    <a class=" btn rounded-3 bg-gradient-primary mx-1" target="_blank"  href="{{route('BookLibrary-dashboard.create')}}">أضافة مكتبة جديدة</a>
    <a class="btn rounded-3 bg-gradient-warning mx-1" href="{{route('BookLibrary-dashboard.trashed')}}">سلة المهملات <i class="fa-solid fa-trash-can text-danger text-gradient  "></i></a>
    </div>





    @if($booklibraries->count() > 0)
    
        <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
            <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">المكتبة الرئيسية للكتب</h5>
            <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
                <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
            </div>
            <div class="table-responsive row">
                <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                    <thead>
                        <tr>
                            <th class=" text-center fw-bolder text-nowrap">عنوان المكتبة</th>
                            <th class=" text-center fw-bolder">الكتب</th>
                            <th class=" text-center fw-bolder">المشاهدات</th>
                            <th class=" text-center fw-bolder">الاعجابات</th>
                            <th class=" text-center fw-bolder">الحالة</th>
                            <th class=" text-center fw-bolder">slug</th>
                            <th class=" text-center fw-bolder">الوصف</th>
                            <th class=" text-center fw-bolder text-nowrap">تاريخ الأنشاء</th>
                            <th class=" text-center fw-bolder">العمليات</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-nowrap align-middle">
                        @isset($booklibraries)
                        @foreach($booklibraries as $booklibrary)
                        <tr id="item-{{$booklibrary->id}}">
                            <td class=" text-center">
                                <div class="m-3">
                                    <span class="mb-0 fw-bolder fs-6 text-dark">{{$booklibrary->title}}</span>
                                </div>
                            </td>
                            
                            <td class=" text-center">
                                <div class="m-3">
                                    
                                    <span class=" fw-bolder">{{$booklibrary -> books->count()}}</span>
                                </div>
                            </td>
                            
                            <td class=" text-center">
                                <div class="m-3">
                                    
                                    <span class=" fw-bolder">{{$booklibrary -> books()->sum('views')}}</span>
                                </div>
                            </td>
                            
                            <td class=" text-center">
                                <div class="m-3">
                                    
                                    <span class=" fw-bolder">{{$booklibrary -> books()->sum('likes')}}</span>
                                </div>
                            </td>

                            <td class=" text-center">
                                <div class="m-3">
                                    
                                    <span class=" fw-bolder">{{$booklibrary -> getActive()}}</span>
                                </div>
                            </td>
                            
                            <td class=" text-center">
                                <div class="m-3">
                                    
                                    <span class=" fw-bolder">{{$booklibrary -> slug}}</span>
                                </div>
                            </td>
                            
                            <td class=" text-center text-wrap">
                                <div class="m-3 ">
                                    <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$booklibrary -> description}} </span>
                                </div>
                            </td>
                            
                            
                            
                            <td class=" text-center">
                                <div class="m-3">
                                    <span class="mb-0 fw-bolder">{{$booklibrary -> created_at->diffForHumans()}}</span>
                                </div>
                            </td>
                            
                            <td class=" text-center">
                              <div class="m-3">
                                  
                              @if($booklibrary->books()->count() !== 0)
                                <a href="{{route('BookLibrary-dashboard.show',$booklibrary -> id)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">جميع الكتب</a>
                              @else
                                <span class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">لا كتب</span>
                              @endif
                                <a href="{{route('Book-dashboard.create',$booklibrary -> id)}}" target="_blank" class="btn rounded-3  bg-gradient-primary  border-2 fw-bolder mx-1 ">أضافة كتاب جديد</a>
                                <a href="{{route('BookLibrary-dashboard.edit',$booklibrary -> id)}}" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1 ">تعديل</a>
                                
                                <form class="d-inline" action="{{route('BookLibrary-dashboard.status',$booklibrary -> id)}}" method="POST">
                                    @csrf
                                    <button class="btn rounded-3 border-2 font-weight-bolder mx-1 ajax-submit
                                    @if($booklibrary -> active == 0)
                                    btn-outline-info text-info
                                    @else
                                    bg-gradient-info text-white
                                    @endif
                                    ">@if($booklibrary -> active == 0)
                                        تفعيل
                                        @else
                                        الغاء تفعيل
                                    @endif
                                    </button>
                                </form>
                                
                                <button type="button" action="{{route('BookLibrary-dashboard.destroy',$booklibrary -> id)}}"
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
            {!! $booklibraries ->onEachSide(2)-> links() !!}
        </div>


      @if($book_top_downloads->count() > 0)
        <div class="mx-3 mx-md-4  my-5">
          <div class="row ">
            <div class=" px-0">
              <div class="card  border-0 rounded-5  shadow-sm">
                <div class=" p-0 position-relative mt-n4 mx-3 z-index-2 ">
                  <div class="bg-gradient-primary shadow-primary p-3 rounded-5 text-center mx-5">
                    <span class="text-white fw-bolder text-capitalize ps-3 text-center fs-5">الكتب الاكثر تحميلا</span>
                  </div>
                </div>
                <div class="card-body px-0 pb-0">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0  text-center">
                      <thead>
                        <tr class="">
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">عنوان الكتاب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">التحميلات</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">مكتبة الكتاب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">ID</span></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($book_top_downloads as $index=>$book)
                        <tr class="align-middle">
                            <td class="px-1 py-3">
                              <div class="d-flex flex-column justify-content-center">
                                  <span class="mb-0   fw-bolder">  #{{$index+1}}</span>
                              </div>
                            </td>
                        
                          <td class="px-1 py-3">
                            <div class="">
                              <div class="d-inline">
                                <img src="{{$book->photo}}" class="avatar avatar-sm mx-1" alt="xd" style="height: 25px !important;">
                              </div>
                              <div class="d-inline ">
                                <span class="mb-0  text-sm text-uppercase  fw-bolder"> {{$book->title}}</span>
                              </div>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder">{{$book->downloads}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0 text-uppercase  fw-bolder"> {{$book->booklibrary->title}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder"> {{$book->id}}</span>
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
      @if($book_top_views->count() > 0)
        <div class="mx-3 mx-md-4  my-5">
          <div class="row ">
            <div class=" px-0">
              <div class="card  border-0 rounded-5  shadow-sm">
                <div class=" p-0 position-relative mt-n4 mx-3 z-index-2 ">
                  <div class="bg-gradient-primary shadow-primary p-3 rounded-5 text-center mx-5">
                    <span class="text-white fw-bolder text-capitalize ps-3 text-center fs-5">الكتب الاكثر مشاهدة</span>
                  </div>
                </div>
                <div class="card-body px-0 pb-0">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0  text-center">
                      <thead>
                        <tr class="">
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">عنوان الكتاب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">المشاهدات</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">مكتبة الكتاب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">ID</span></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($book_top_views as $index=>$book)
                        <tr class="align-middle">
                            <td class="px-1 py-3">
                              <div class="d-flex flex-column justify-content-center">
                                  <span class="mb-0   fw-bolder">  #{{$index+1}}</span>
                              </div>
                            </td>
                        
                          <td class="px-1 py-3">
                            <div class="">
                              <div class="d-inline">
                                <img src="{{$book->photo}}" class="avatar avatar-sm mx-1" alt="xd" style="height: 25px !important;">
                              </div>
                              <div class="d-inline ">
                                <span class="mb-0  text-sm text-uppercase  fw-bolder"> {{$book->title}}</span>
                              </div>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder">{{$book->views}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0 text-uppercase  fw-bolder"> {{$book->booklibrary->title}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder"> {{$book->id}}</span>
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
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة مكتبة كتب بعد</div>

    @endif


















<!-- 
  
<div class="card  px-0 my-5 overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">المكتبة</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
    <thead>
            <tr >
                <th class="border-dark text-center text-uppercase font-weight-bolder">العنوان</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الحالة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">عدد الكتب</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">المشاهدات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الاعجابات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الوصف</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">اخر تعديل</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>

            </tr>
        </thead>
        <tbody class="table-group-divider">
        @isset($booklibraries)
        @foreach($booklibraries as $booklibrary)
            <tr id="item-{{$booklibrary->id}}">
                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$booklibrary -> title}}</h6>
                    </div>
                </td>
                
                
                
                <td  class=" text-center">
                    <div class="m-3 ">
                        
                        <h6 class="">{{$booklibrary -> getActive()}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$booklibrary -> books->count()}}</h6>
                    </div>
                </td>
               
                
                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$booklibrary-> books()->sum('views')}}</h6>
                    </div>
                </td>
             
                
                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$booklibrary-> books()->sum('likes')}}</h6>
                    </div>
                </td>

                <td   class=" text-center  text-wrap">
                    <div class="m-3">
                        <h6 class="mb-0"  style="width: 400px !important; ">{{$booklibrary -> description}}</h6>
                    </div>
                </td>
               
               
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$booklibrary -> created_at->diffForHumans()}}</h6>
                    </div>
                </td>
               



                <td  class=" text-center" >
                    <div class="m-3">
                        <a  href="{{route('BookLibrary-dashboard.show',$booklibrary -> id)}}" class=" btn text-light btn-success border-2 font-weight-bolder mx-1"><h6 class="text-white mb-0">جميع الكتب</h6></a>
                        
                        <a  href="{{route('Book-dashboard.create',$booklibrary -> id)}}" target="_blank"  class=" btn text-light btn-primary border-2 font-weight-bolder mx-1"><h6 class="text-white mb-0">أضافة كتاب جديد</h6></a>
                        

                        <a href="{{route('BookLibrary-dashboard.edit',$booklibrary -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">تعديل</h6></a>
                        
                        <form class="d-inline" action="{{route('BookLibrary-dashboard.status',$booklibrary -> id)}}" method="POST">
                            @csrf
                            <button class="fs-6 btn border-2 font-weight-bolder mx-1 ajax-submit
                            @if($booklibrary -> active == 0)
                            btn-outline-info text-info
                            @else
                                btn-info text-white
                            @endif
                            ">@if($booklibrary -> active == 0)
                                تفعيل
                                @else
                                الغاء تفعيل
                            @endif
                            </button>
                        </form>
                        
                        <button type="button" action="{{route('BookLibrary-dashboard.destroy',$booklibrary -> id)}}"
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
    {!! $booklibraries ->onEachSide(2)-> links() !!}

</div>

-->
<!--
  
<div class="mx-3 mx-md-4  mt-5">
  <div class="row ">
    <div class=" ">
      <div class="card px-3">
        <div class="card-header pb-0">
          <div class="row text-center">
            <span class="font-weight-bold fs-5 text-info">الكتب الاكثر تحميلا</span> 
          </div>
        </div>
        <div class="card-body px-0 pb-0">
          <div class="table-responsive">
            <table class="table align-items-center mb-0  ">
              <thead>
                <tr  class="">
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">عنوان الكتاب</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">التحميلات</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">مكتبة الكتاب</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">id</span></th>
                </tr>
              </thead>
              <tbody>
                @foreach($book_top_downloads as $index=>$book)
                <tr>
                    <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-uppercase  font-weight-bolder"> __{{$index+1}}__</h6>
                    </div>
                </td>
                <td class="px-1 py-3">
                  <div class="">
                    <div class="d-inline">
                      <img src="{{$book->photo}}" class="avatar avatar-sm mx-1" alt="xd" style="height: 25px !important;">
                    </div>
                    <div class="d-inline ">
                      <span class="mb-0  text-sm text-uppercase  font-weight-bolder"> {{$book->title}}</span>
                    </div>
                  </div>
                </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$book->downloads}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$book->booklibrary->title}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$book->id}}#</h6>
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
<!--
  
<div class="mx-3 mx-md-4  mt-5">
  <div class="row ">
    <div class=" mb-md-5 mb-4">
      <div class="card px-3">
        <div class="card-header pb-0">
          <div class="row text-center">
            <span class="font-weight-bold fs-5 text-info">الكتب الاكثر مشاهدة</span> 
          </div>
        </div>
        <div class="card-body px-0 pb-0">
          <div class="table-responsive">
            <table class="table align-items-center mb-0  ">
              <thead>
                <tr  class="">
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">عنوان الكتاب</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">المشاهدات</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">مكتبة الكتاب</span></th>
                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 p-1"><span class="fs-6 text-dark">id</span></th>
                </tr>
              </thead>
              <tbody>
                @foreach($book_top_views as $index=>$book)
                <tr>
                    <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-uppercase  font-weight-bolder"> __{{$index+1}}__</h6>
                    </div>
                </td>
                <td class="px-1 py-3">
                  <div class="">
                    <div class="d-inline">
                      <img src="{{$book->photo}}" class="avatar avatar-sm mx-1" alt="xd" style="height: 25px !important;">
                    </div>
                    <div class="d-inline ">
                      <span class="mb-0  text-sm text-uppercase  font-weight-bolder"> {{$book->title}}</span>
                    </div>
                  </div>
                </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$book->views}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$book->booklibrary->title}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  font-weight-bolder"> {{$book->id}}#</h6>
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