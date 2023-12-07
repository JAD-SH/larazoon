@extends('layouts.admin.dashboard')

@section('title','مكتبة الأسئلة')

@section('css')
<style>
   
</style>
@endsection

@section('path')

    <li class="breadcrumb-item fw-bolder active " aria-current="page">قسم مكتبة الاسئلة</li>
@endsection

@section('content')

    <div class="m-3  mb-0">

        <a class="btn rounded-3 bg-gradient-primary mx-1" target="_blank"  href="{{route('QuestionLibrary-dashboard.create')}}">أضافة مكتبة اسئلة جديدة</a>
        <a class="btn rounded-3 bg-gradient-warning mx-1" href="{{route('QuestionLibrary-dashboard.trashed')}}">سلة المهملات <i class="fa-solid fa-trash-can text-danger text-gradient  "></i></a>

    </div>



    @if($questionlibraries->count() > 0)

      <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
          <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">مكتبة الأسئلة</h5>
          <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
              <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
          </div>
          <div class="table-responsive row">
              <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                  <thead>
                      <tr>
                          <th class=" text-center fw-bolder">العنوان</th>
                          <th class=" text-center fw-bolder">الأسئلة</th>
                          <th class=" text-center fw-bolder">المشاهدات</th>
                          <th class=" text-center fw-bolder">الاعجابات</th>
                          <th class=" text-center fw-bolder">الحالة</th>
                          <th class=" text-center fw-bolder">slug</th>
                          <th class=" text-center fw-bolder">الوصف</th>
                          <th class=" text-center fw-bolder">تاريخ الأنشاء</th>
                          <th class=" text-center fw-bolder">العمليات</th>
                      </tr>
                  </thead>
                  <tbody class="table-group-divider text-nowrap align-middle">
                      @isset($questionlibraries)
                      @foreach($questionlibraries as $library)
                      <tr id="item-{{$library->id}}">
                          <td class=" text-center">
                              <div class="m-3">
                                  <span class="mb-0 fw-bolder fs-6 text-dark">{{$library->title}}</span>
                              </div>
                          </td>
                          
                          <td class=" text-center">
                              <div class="m-3">
                                  
                                  <span class=" fw-bolder">{{$library -> questions->count()}}</span>
                              </div>
                          </td>
                          
                          <td class=" text-center">
                              <div class="m-3">
                                  
                                  <span class=" fw-bolder">{{$library -> questions()->sum('views')}}</span>
                              </div>
                          </td>
                          
                          <td class=" text-center">
                              <div class="m-3">
                                  
                                  <span class=" fw-bolder">{{$library -> questions()->sum('likes')}}</span>
                              </div>
                          </td>

                          <td class=" text-center">
                              <div class="m-3">
                                  
                                  <span class=" fw-bolder">{{$library -> getActive()}}</span>
                              </div>
                          </td>
                          
                          <td class=" text-center">
                              <div class="m-3">
                                  
                                  <span class=" fw-bolder">{{$library -> slug}}</span>
                              </div>
                          </td>
                          
                          <td class=" text-center text-wrap">
                              <div class="m-3 ">
                                  <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$library -> description}} </span>
                              </div>
                          </td>
                          
                          
                          
                          <td class=" text-center">
                              <div class="m-3">
                                  <span class="mb-0 fw-bolder">{{$library -> created_at->diffForHumans()}}</span>
                              </div>
                          </td>
                          
                          <td class=" text-center">
                            <div class="m-3">
                                

                              @if($library->questions()->count() !== 0)
                                <a  href="{{route('QuestionLibrary-dashboard.show',$library -> id)}}" class=" btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1">جميع الأسئلة</a>
                              @else
                                <span class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">لا اسئلة</span>
                              @endif

                                                      

                              <a href="{{route('QuestionLibrary-dashboard.edit',$library -> id)}}" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1">تعديل</a>
                              
                              <form class="d-inline" action="{{route('QuestionLibrary-dashboard.status',$library -> id)}}" method="POST">
                                  @csrf
                                  <button class="btn rounded-3 border-2 fw-bolder mx-1 ajax-submit
                                  @if($library -> active == 0)
                                  btn-outline-info text-info
                                  @else
                                  bg-gradient-info text-white
                                  @endif
                                  ">@if($library -> active == 0)
                                      تفعيل
                                      @else
                                      الغاء تفعيل
                                  @endif
                                  </button>
                              </form>
                              
                              <button type="button" action="{{route('QuestionLibrary-dashboard.destroy',$library -> id)}}"
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
          {!! $questionlibraries ->onEachSide(2)-> links() !!}
      </div>





<!-- 
    
    <div class="card px-0 my-5  overflow-hidden">
        <h5 class="fw-bolder m-2 text-center p-3">مكتبة الأسئلة</h5>
        <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
        <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
        
            <thead>
                <tr >
                    <th class="border-dark text-center text-uppercase fw-bolder">العنوان</th>
                    <th class="border-dark text-center text-uppercase fw-bolder">الحالة</th>
                    <th class="border-dark text-center text-uppercase fw-bolder">عدد الأسئلة</th>
                    <th class="border-dark text-center text-uppercase fw-bolder">الوصف</th>
                    <th class="border-dark text-center text-uppercase fw-bolder">اخر تعديل</th>
                    <th class="border-dark text-center text-uppercase fw-bolder">العمليات</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            @isset($questionlibraries)
            @foreach($questionlibraries as $library)
                <tr id="item-{{$library->id}}">
                    <td   class=" text-center">
                        <div class="m-3 ">
                            <h6 class="mb-0">{{$library -> title}}</h6>
                        </div>
                    </td>
                    
                    
                    <td  class=" text-center">
                        <div class="m-3 ">
                            
                            <h6 class="">{{$library -> getActive()}}</h6>
                        </div>
                    </td>
                    
                    <td   class=" text-center">
                        <div class="m-3 ">
                            <h6 class="mb-0">{{$library -> questions->count()}}</h6>
                        </div>
                    </td>
                
                
                    <td   class=" text-center  text-wrap">
                        <div class="m-3">
                            <h6 class="mb-0"  style="width: 400px !important; ">{{$library -> description}}</h6>
                        </div>
                    </td>
                
                
                    <td   class=" text-center">
                        <div class="m-3">
                            <h6 class="mb-0">{{$library -> created_at->diffForHumans()}}</h6>
                        </div>
                    </td>
                

                    <td  class=" text-center" >
                        <div class="m-3">
                            <a  href="{{route('QuestionLibrary-dashboard.show',$library -> id)}}" class=" btn text-light btn-success border-2 fw-bolder mx-1"><h6 class="text-white mb-0">جميع الأسئلة</h6></a>
                                                    

                            <a href="{{route('QuestionLibrary-dashboard.edit',$library -> id)}}" class="btn text-light btn-warning  border-2 fw-bolder mx-1"><h6 class="text-white m-0">تعديل</h6></a>
                            
                            <form class="d-inline" action="{{route('QuestionLibrary-dashboard.status',$library -> id)}}" method="POST">
                                @csrf
                                <button class="fs-6 btn border-2 fw-bolder mx-1 ajax-submit
                                @if($library -> active == 0)
                                btn-outline-info text-info
                                @else
                                    btn-info text-white
                                @endif
                                ">@if($library -> active == 0)
                                    تفعيل
                                    @else
                                    الغاء تفعيل
                                @endif
                                </button>
                            </form>
                            
                            <button type="button" action="{{route('QuestionLibrary-dashboard.destroy',$library -> id)}}"
                                class="btn text-light btn-danger  border-2 fw-bolder mx-1 delete notification-active fs-6"
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
        {!! $questionlibraries ->onEachSide(2)-> links() !!}

    </div>


-->









      @if($ques_top_views->count() > 0)
        <div class="mx-3 mx-md-4  my-5">
          <div class="row ">
            <div class=" px-0">
              <div class="card  border-0 rounded-5  shadow-sm">
                <div class=" p-0 position-relative mt-n4 mx-3 z-index-2 ">
                  <div class="bg-gradient-primary shadow-primary p-3 rounded-5 text-center mx-5">
                    <span class="text-white fw-bolder text-capitalize ps-3 text-center fs-5">الاسئلة الاكثر مشاهدة</span>
                  </div>
                </div>
                <div class="card-body px-0 pb-0">
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0  text-center">
                      <thead>
                        <tr class="">
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">عنوان السؤال</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">المشاهدات</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">مكتبة السؤال</span></th>
                            <th class=" fw-bolder  p-1"><span class="fs-6 text-dark">ID</span></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($ques_top_views as $index=>$question)
                        <tr class="align-middle">
                            <td class="px-1 py-3">
                              <div class="d-flex flex-column justify-content-center">
                                  <span class="mb-0   fw-bolder">  #{{$index+1}}</span>
                              </div>
                            </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder">{{$question->title}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder">{{$question->views}}</span>
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                            @foreach($question->questionlibraries as $questionlibrary)
                            <span class="mb-0 text-sm text-uppercase  fw-bolder">- {{$questionlibrary->title}} </span>
                            @endforeach
                            </div>
                          </td>
                          <td class="px-1 py-3">
                            <div class="d-flex flex-column justify-content-center">
                                <span class="mb-0  fw-bolder"> {{$question->id}}</span>
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
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة مكتبة اسئلة بعد</div>

    @endif

<!-- 
    
<div class="mx-3 mx-md-4  mt-5">
  <div class="row ">
    <div class=" mb-md-5 mb-4">
      <div class="card px-3">
        <div class="card-header pb-0">
          <div class="row text-center">
            <span class="fw-bold fs-5 text-info">الاسئلة الاكثر مشاهدة</span> 
          </div>
        </div>
        <div class="card-body px-0 pb-0">
          <div class="table-responsive">
            <table class="table align-items-center mb-0  ">
              <thead>
                <tr  class="">
                    <th class="text-uppercase text-xxs fw-bolder opacity-7 p-1"><span class="fs-6 text-dark">الترتيب</span></th>
                    <th class="text-uppercase text-xxs fw-bolder opacity-7 p-1"><span class="fs-6 text-dark">عنوان السؤال</span></th>
                    <th class="text-uppercase text-xxs fw-bolder opacity-7 p-1"><span class="fs-6 text-dark">المشاهدات</span></th>
                    <th class="text-uppercase text-xxs fw-bolder opacity-7 p-1"><span class="fs-6 text-dark">مكتبة السؤال</span></th>
                    <th class="text-uppercase text-xxs fw-bolder opacity-7 p-1"><span class="fs-6 text-dark">id</span></th>
                </tr>
              </thead>
              <tbody>
                @foreach($ques_top_views as $index=>$question)
                <tr>
                    <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-uppercase  fw-bolder"> __{{$index+1}}__</h6>
                    </div>
                </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  fw-bolder"> {{$question->title}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  fw-bolder"> {{$question->views}}</h6>
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        @foreach($question->questionlibraries as $questionlibrary)
                        <h6 class="mb-0 text-sm text-uppercase  fw-bolder">- {{$questionlibrary->title}} </h6>
                        @endforeach
                    </div>
                  </td>
                  <td class="px-1 py-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm text-uppercase  fw-bolder"> {{$question->id}}#</h6>
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