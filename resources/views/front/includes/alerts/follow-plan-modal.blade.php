


<div class="col-md-4"> 
  <div class="modal fade" id="FollowPlanNotification" tabindex="-1" role="dialog" aria-labelledby="FollowPlanNotificationTitle" aria-hidden="true" style="z-index: 11111;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
          <div class="modal-header  p-0 pb-3">
            <div class="modal-title fw-bolder fs-6 text-danger" id="exampleModalLabel">ملاحظة : يمكنك متابعة خطة واحدة فقط</div>
            <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
              <span class="fw-bolder fs-5 text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
            </button>
          </div>
          <div class="modal-body">
            @if(Plans()->count() != 0)
              @foreach(Plans() as $plan)
                <form method="POST" action="{{route('User.follow-plan',$plan->id)}}">
                  @csrf    
                  <div class=" p-0  m-2 mb-3">
                    <div class="mb-2 text-uppercase fw-bolder">
                    _{{$plan->title}}_ 
                    </div>
                    <div class="my-3  m-md-2 ">
                      @foreach($plan->courses as $course)
                        <span class="btn bg-gradient-{{$course->color}} py-0 px-2 m-1 m-md-0  rounded-pill text-xxs" >{{$course->title}} </span>                    
                      @endforeach
                    </div>
                    <div class="m-2 fw-bolder d-flex justify-content-between align-items-baseline">
                    @verify
                      <button type="submit" class="btn bg-gradient-primary fs-6 py-1 px-3 m-0"  data-bs-toggle="tooltip" data-bs-placement="top" title="تابع الخطة واحترف البرمجة">متابعة الخطة</button>
                    @else  
                      <!-- Button trigger modal -->
                      <button type="button" class="btn bg-gradient-primary fs-6 py-1 px-3 m-0"  data-bs-toggle="modal" data-bs-target="#LoginModal">متابعة الخطة</button>
                    @endverify
                      <span class="text-xs"><i class="fa-solid fa-user "></i>  {{$plan->users->count()}} متابعين للخطة</span>
                    </div>
                  </div>
                </form>
              @endforeach
            @else
            <div class="fw-bolder fs-4">لا يوجد خطط تعلم بعد</div>
            @endif
            <button type="button" class="btn rounded-3 bg-gradient-secondary mt-3 fs-6 float-start mb-0" data-bs-dismiss="modal">تراجع</button>
          </div>
        </div>
      </div>
  </div>
</div>