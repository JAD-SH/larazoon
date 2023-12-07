
<div class="modal fade " id="UnfollowPlanModal" tabindex="-1" role="dialog" aria-labelledby="UnfollowPlanModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
    <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
      <div class="modal-header  p-0 pb-3">
        <div class="modal-title fw-bolder fs-7 text-danger " id="modal-title-notification">تحذير</div>
        <button type="button" class="btn-close p-0 m-0 pb-2 fw-bolder fs-7 text-danger" data-bs-dismiss="modal" aria-label="Close">
        <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="py-3 text-center">
          
          <i class="fa fa-bell fs-1 text-danger"></i>
          <div class="text-gradient fw-bolder fs-5 text-danger mt-4">هل تريد فعلا الغاء متابعة الخطة _front_</div>
          <p class="fw-bolder mt-4">لن تفقد تقدمك في الكورسات</p>
        </div>
      </div>
      <div class="modal-footer text-start p-0 border-0 d-block">
        <form class="d-inline delete-form-notification" action="{{route('User.un-follow-plan')}}" method="POST">
          @csrf
          <button type="submit" class="btn rounded-3 btn-danger  mx-1 fs-7 text-white " data-bs-dismiss="modal">موافق ,  الغي المتابعة</button>
        </form>
        <button type="button" class="btn rounded-3 btn-secondary mx-1 fs-7 mt-0" data-bs-dismiss="modal"> تراجع</button>
      </div>
    </div>
  </div>
</div>