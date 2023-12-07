
<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="warningToast" class="toast rounded-4 overflow-hidden border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header  bg-warning">
      <i class="fa-solid fa-triangle-exclamation mx-2 text-white"></i>
      <strong class="me-auto text-white">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-black bg-white fw-bolder shadow-lg py-4">
        {{Session::get('notifyMsg')}}
    </div>
  </div>
</div>
<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="dangerToast" class="toast rounded-4 overflow-hidden border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header  bg-danger">
      <i class="fa-solid fa-radiation mx-2 text-white"></i>
      <strong class="me-auto text-white">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-black bg-white fw-bolder shadow-lg py-4">
        {{Session::get('notifyMsg')}}
    </div>
  </div>
</div>
<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="successToast" class="toast rounded-4 overflow-hidden border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="8000">
    <div class="toast-header  bg-success">
      <i class="fa-solid fa-check-double mx-2 text-white"></i>
      <strong class="me-auto text-white">{{Session::get('notifyTitle')}}</strong>
      <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-black bg-white fw-bolder shadow-lg py-4">
        {{Session::get('notifyMsg')}}
    </div>
  </div>
</div>

