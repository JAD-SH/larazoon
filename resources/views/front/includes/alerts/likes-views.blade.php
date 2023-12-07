<div class="my-3 mx-3 mx-md-4">
   <div class=" mb-3">
       <div class=" text-center">
           <div data-sos="sos-zoom-out" class="">
                @if(! session()->has($isliked))
                    <form  action="{{$likedroute}}" method="POST">
                        @csrf
                        <button class="btn rounded-4 bg-gradient-{{$color}} my-0 py-2 px-4 fs-6 border-2 font-weight-bolder mx-1 ajax-submit">
                            اعط {{$name}}  <i class="fs-5 fa-solid fa-heart"></i>
                        </button>
                    </form>
                @else 
                    <button class="btn  rounded-4 bg-gradient-{{$color}} my-0 py-2 px-4 fs-6 border-2 font-weight-bolder mx-1">
                        قمت بالاعجاب  <i class="fs-5 fa-solid fa-heart"></i>
                    </button>
                @endif
            </div>
       </div>
      <div class=" mx-4 p-3 text-center">
          <div class="d-inline-block bg-gradient-{{$color}}  mx-1 m-0 py-3 rounded-5 position-relative  overflow-hidden" style="width: 112px;">
          <div class=" glossy"></div>
              <div class="icon d-flex align-items-center justify-content-center text-white icon-lg  text-center mx-auto">
                  <i class="fs-3 fa-solid fa-heart"></i>
              </div>
              <span data-cos="{{$likes}}" class="fs-4  d-block text-light"></span>
              <span class="fs-5 fw-bolder d-block text-light">الاعجابات</span>
          </div>
          <div class="d-inline-block bg-gradient-{{$color}} mx-1  m-0 py-3 rounded-5 position-relative  overflow-hidden" style="width: 112px;">
          <div class=" glossy"></div>
              <div class="icon d-flex align-items-center justify-content-center text-white icon-lg  text-center mx-auto">
                  <i class="fs-3 fa-sharp fa-solid fa-eye"></i>
              </div>
              <span data-cos="{{$views}}" class="fs-4  d-block text-light"></span>
              <span class="fs-5 fw-bolder d-block text-light">المشاهدات</span>
          </div>
      </div>
    </div>
</div>