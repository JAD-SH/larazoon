@extends('layouts.admin.dashboard')

@section('title','قسم الفقرات')

@section('css')
<style>
  
</style>
@endsection

@section('path')

<li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('SubCategory-dashboard.index')}}">الاقسام الفرعية </a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">قسم الفقرات {{$categories[0]->subcategory->title}}</li>

@endsection

@section('content')


    <div class="m-3 ">
    <a class="btn rounded-3 bg-gradient-primary mx-1" target="_blank"  href="{{route('Category-dashboard.create',$subcategory_id)}}">أضافة فقرة جديدة</a>

    </div>



    @if($categories->count() > 0)
    

    
    <div class="card border-0 text-center mx-1 mx-md-3 bg-none  rounded-5 py-4 d-block shadow-sm">

        <a id="filter-index" href="{{route('SubCategory-dashboard.show',$subcategory_id)}}" class="btn bg-gradient-{{$categories[0]->subcategory->color}} m-1 fw-bolder rounded-3 fs-6"> الأحدث  </a>
        <a id="filter-older" href="{{route('SubCategory-dashboard.older',$subcategory_id)}}" class="btn bg-gradient-{{$categories[0]->subcategory->color}} m-1 fw-bolder rounded-3 fs-6"> الاقدم  </a>
        <a id="filter-unactive" href="{{route('SubCategory-dashboard.un-active',$subcategory_id)}}" class="btn bg-gradient-{{$categories[0]->subcategory->color}} m-1 fw-bolder rounded-3 fs-6"> الغير مفعل  </a>
        <a id="filter-top-views" href="{{route('SubCategory-dashboard.top-views',$subcategory_id)}}" class="btn bg-gradient-{{$categories[0]->subcategory->color}} m-1 fw-bolder rounded-3 fs-6">  الأكثر مشاهدة   </a>
        <a id="filter-top-likes" href="{{route('SubCategory-dashboard.top-likes',$subcategory_id)}}" class="btn bg-gradient-{{$categories[0]->subcategory->color}} m-1 fw-bolder rounded-3 fs-6"> الأكثر اعجابا  </a>
 
    </div>


    <div class="card mx-1 mx-md-3  border-0 rounded-5  shadow-sm mt-3 mb-5 overflow-hidden">
        <h5 class="fw-bolder m-2 fs-5 text-dark text-center p-3">الفقرات (<span class="text-{{$categories[0]->subcategory->color}}">{{$categories[0]->subcategory->title}}</span>)</h5>
        <div class="scroll-right position-absolute top-0 start-0  d-none d-flex fs-4 h-100 w-md-10 w-10 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
            <i class="fs-3 text-light fa-sharp fa-solid fa-eye"></i>
        </div>
        <div class="table-responsive row">
            <table width="100%" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-4 border  border-top-0" cellspacing="0">
                <thead>
                    <tr>
                        <th class=" text-center fw-bolder">العنوان</th>
                        <th class=" text-center fw-bolder">الصورة</th>
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
                    @isset($categories)
                    @foreach($categories as $category)
                    <tr id="item-{{$category->id}}">
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder fs-6 text-dark">{{$category->title}}</span>
                            </div>
                        </td>
                        
                        <td class="text-center">
                            <div class="m-3">
                                <img src="{{$category -> photo}}" class="w-100" alt="team4" style="width: 100px !important;">
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$category -> views}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$category -> likes}}</span>
                            </div>
                        </td>

                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$category -> getActive()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <span class=" fw-bolder">{{$category -> slug}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center text-wrap">
                            <div class="m-3 ">
                                <span class="mb-0  fw-bold d-block" style="width: 400px !important;"> {{$category -> description}} </span>
                            </div>
                        </td>
                        
                        
                        
                        <td class=" text-center">
                            <div class="m-3">
                                <span class="mb-0 fw-bolder">{{$category -> created_at->diffForHumans()}}</span>
                            </div>
                        </td>
                        
                        <td class=" text-center">
                            <div class="m-3">
                                
                                <a href="{{route('Category-dashboard.show',$category -> id)}}" class="btn rounded-3  bg-gradient-success  border-2 fw-bolder mx-1 ">عرض المقال</a>
                                <a href="{{route('Category-dashboard.edit',$category -> id)}}" class="btn rounded-3  bg-gradient-warning  border-2 fw-bolder mx-1 ">تعديل</a>
                                
                                <a href="{{route('Category-dashboard.tryit-page',$category -> id)}}" class="btn rounded-3  bg-gradient-dark  border-2 fw-bolder mx-1 text-light">TryIt <i class="fs-6 fa fa-play"></i></a>
                                <a href="{{route('Category-dashboard.image-page',$category -> id)}}" class="btn rounded-3  bg-gradient-light  border-2 fw-bolder mx-1 text-dark">Image <i class="fs-6 fa fa-play"></i></a>

                                <button type="button" action="{{route('Category-dashboard.move',$category -> id)}}"
                                    class="btn rounded-3 border-2 fw-bolder mx-1 bg-gradient-primary move"
                                    data-bs-toggle="modal" data-bs-target="#MoveTo">
                                    نقل
                                </button>

                                <form class="d-inline" action="{{route('Category-dashboard.status',$category -> id)}}" method="POST">
                                    @csrf
                                    <button class="btn rounded-3 border-2 font-weight-bolder mx-1 ajax-submit
                                    @if($category -> active == 0)
                                    btn-outline-info text-info
                                    @else
                                    bg-gradient-info text-white
                                    @endif
                                    ">@if($category -> active == 0)
                                    تفعيل
                                    @else
                                    الغاء تفعيل
                                    @endif
                                    </button>
                                </form>
                                
                                <button type="button" action="{{route('Category-dashboard.destroy',$category -> id)}}"
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

        {!! $categories ->onEachSide(2)-> links() !!}
    </div>

        
    <div class="modal fade" id="MoveTo" tabindex="-1" role="dialog" aria-labelledby="MoveToTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
                <div class="modal-header  p-0 pb-3">
                    <div class="modal-title fs-6  fw-bolder text-danger" id="exampleModalLabel">نقل الفقرة لقسم فرعي اخر</div>
                    <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                    <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="move-form" method="POST" >
                        @csrf    
                        
                        <select class="form-select" aria-label="Default select example"  name="subcategory_id">
                            @if(SubCategories() !== null)
                            @foreach(SubCategories() as $SubCategory)
                                @if($SubCategory->id == $categories[0]->subcategory_id)
                                    @continue
                                @endif
                                <option class="text-dark"  value="{{$SubCategory->id}}">{{$SubCategory->title}}</option>
                            @endforeach
                            @endif
                        </select>
                        <div class="mt-3">

                            <button class="btn rounded-3 bg-gradient-primary fs-6 ajax-submit" data-bs-dismiss="modal">موافق .. قم بالنقل</button>
                            <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">رجوع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="fs-4 text-center p-5 fw-bolder">لم يتم إضافة فقرات بعد</div>

    @endif

<!--
    
<div class="card  px-0 my-5  overflow-hidden">
    <h5 class="font-weight-bolder m-2 text-center p-3">الفقرات</h5>
    <div class="scroll-right position-absolute  d-none d-flex fs-4 h-100 w-md-10 w-20 justify-content-center align-items-center text-white" style="    background-image: linear-gradient(195deg, #49a3f1 0%, #1a73e847 100%); z-index:11;">
        <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
    </div>
    <div class="table-responsive row">
    <table width="100%" id="dtHorizontalVerticalExample" class="table-striped col-12 w-100 table align-items-center mb-0 mx-2 rounded-3 border  border-top-0"  cellspacing="0">
    
    <thead>
            <tr >
                <th class="border-dark text-center text-uppercase font-weight-bolder">العنوان</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الحالة</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">المشاهدات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الاعجابات</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">الوصف</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">اخر تعديل</th>
                <th class="border-dark text-center text-uppercase font-weight-bolder">العمليات</th>

            </tr>
        </thead>
        <tbody class="table-group-divider">
        @isset($categories)
        @foreach($categories as $category)
            <tr id="item-{{$category->id}}">
                <td   class=" text-center">
                    <div class="m-3 ">
                        <h6 class="mb-0">{{$category->title}}</h6>
                    </div>
                </td>
                
                <td  class=" text-center">
                    <div class="m-3 ">
                        
                        <h6 class="">{{$category -> getActive()}}</h6>
                    </div>
                </td>
                
                <td  class=" text-center">
                    <div class="m-3 ">
                        
                        <h6 class="">{{$category -> views}}</h6>
                    </div>
                </td>
                
                <td  class=" text-center">
                    <div class="m-3 ">
                        
                        <h6 class="">{{$category -> likes}}</h6>
                    </div>
                </td>
                
                <td   class=" text-center  text-wrap">
                    <div class="m-3">
                        <h6 class="mb-0"  style="width: 400px !important; ">{{$category -> description}}</h6>
                    </div>
                </td>
               
               
                <td   class=" text-center">
                    <div class="m-3">
                        <h6 class="mb-0">{{$category -> created_at->diffForHumans()}}</h6>
                    </div>
                </td>
               
                <td  class=" text-center" >
                    <div class="m-3">
                        
                        <a href="{{route('Category-dashboard.show',$category -> id)}}" class="btn text-light btn-success  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">عرض الفقرة</h6></a>

                        <a href="{{route('Category-dashboard.edit',$category -> id)}}" class="btn text-light btn-warning  border-2 font-weight-bolder mx-1"><h6 class="text-white m-0">تعديل</h6></a>
                        
                        
                        <form class="d-inline" action="{{route('Category-dashboard.status',$category -> id)}}" method="POST">
                            @csrf
                            <button class="fs-6 btn border-2 font-weight-bolder mx-1 ajax-submit
                            @if($category -> active == 0)
                            btn-outline-info text-info
                            @else
                            btn-info text-white
                            @endif
                            ">@if($category -> active == 0)
                            تفعيل
                            @else
                            الغاء تفعيل
                            @endif
                            </button>
                        </form>
                    
                        <button type="button" action="{{route('Category-dashboard.destroy',$category -> id)}}"
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
    {!! $categories ->onEachSide(2)-> links() !!}

</div>

 -->
@endsection

@section('script')
<script>
     scroll_to_right();
     move_buttons();
 delete_buttons();
    ajax_function();

    let categories_filter_btn = document.getElementById("{{Session::get('categories-filter')}}");
    if(categories_filter_btn){
        $(categories_filter_btn).addClass('bg-gradient-dark');
    }

</script>
@endsection