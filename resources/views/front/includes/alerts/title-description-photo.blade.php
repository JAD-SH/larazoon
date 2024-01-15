<div>
    <div data-sos-once="true" data-sos="sos-blur" class="page-header-photo rounded-5 page-header border-radius-xl" dark-photo-data="@if($category->dark_photo != null) {{asset($category->dark_photo)}} @endif" light-photo-data="{{asset($category->light_photo)}}" style="background-image: url(
        @if($category->dark_photo != null)
            @isset($_COOKIE['DarkMode']) {{asset($category->dark_photo)}} @else {{asset($category->light_photo)}} @endisset
        @else {{asset($category->light_photo)}} @endif
    ); height:175px;"> 
        <div class="container-items h-100"></div>    
    </div>
    <div data-sos-once="true" data-sos="sos-left"  class="card border-0 justify-content-center mx-1 mx-md-4 mt-n6 bg-none mb-4 rounded-5 shadow-sm py-4">
        <div  class="text-center">
            <h1 class="text-dark fw-bolder fs-5">{{$category->title}}</h1>
            <p class=" mb-0">
                <span class="fw-bold  fs-6">{{$category->description}}</span> 
            </p>
        </div>
    </div>
</div>
