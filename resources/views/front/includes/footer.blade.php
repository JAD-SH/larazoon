<footer class="text-center footer card  p-2 py-md-4 px-md-3 border-0 rounded-5 mb-3 shadow-sm mb-2"  style="background-color: #0e0e0e !important;">
    <div class="row m-3 shadow justify-content-center align-items-center">
      <div class="col-9 col-md-3 col-xl-2  d-flex justify-content-center align-items-center mb-3 mb-md-0"><img src="{{Site()->site_logo}}" alt="{{Site()->site_name}}-logo" style="width:65%;"></div>
      <div class="col-12 col-md-9 col-xl-10 text-center text-md-start">
        <span class="fs-6  text-light">نقوم بنشر اشياء مهمة جدا لجميع مطوري الويب على مواقع التواصل الاجتماعي لتصل الفائدة لاكبر شريحة ممكنة من المبرمجين العرب</span>
        <div class="p-2 pb-0 fw-bolder text-light d-block mt-2 site-media">
        @if(Site() -> facebook !== null)
          <a class="btn m-1 shadow p-2" target="_blank" href="{{Site() -> facebook}}" aria-label="our facebook">
            <i class="fab fa-facebook fs-4"></i>
          </a>
        @endif
        @if(Site() -> twitter !== null)
          <a class="btn m-1 shadow p-2" target="_blank" href="{{Site() -> twitter}}" aria-label="our twitter">
            <i class="fab fa-twitter fs-4"></i>
          </a>
        @endif
        @if(Site() -> instagram !== null)
          <a class="btn m-1 shadow p-2" target="_blank" href="{{Site() -> instagram}}" aria-label="our instagram">
            <i style="" class="fab fa-instagram fs-4"></i>
          </a>
        @endif
        @if(Site() -> github !== null)
          <a class="btn m-1 shadow p-2" target="_blank" href="{{Site() -> github}}" aria-label="our github">
            <i class="fab fa-github fs-4"></i>
          </a>
        @endif
        </div> 
      </div>
    </div>    
    <div class="d-block footer-maincategories text-initial rounded-5 overflow-hidden float-md-start p-3 shadow" role="group" aria-label="Vertical button group">
      <a href="{{route('supporters_page')}}" class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6 position-relative"  >الداعمين <i class="fa-solid fa-crown fs-4 position-absolute text-warning" style="top:-13px; right:-13px; transform: rotate(33deg);"></i></a>
      <a href="{{route('support-us')}}" class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6"  >ادعم الموقع ❤</a>
      @verify
        <button data-type="message"  class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6 create-message"  data-bs-toggle="modal" data-bs-target="#CreateMessageToAdminModal">ابلغ عن مشكلة</button>
        <button data-type="ask"  class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6 create-message"  data-bs-toggle="modal" data-bs-target="#CreateMessageToAdminModal">اسأل الأدمن</button>
        @include('front.includes.alerts.create-message-to-admin-modal')
      @else 
        <button class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6"  data-bs-toggle="modal" data-bs-target="#LoginModal">ابلغ عن مشكلة</button>
        <button class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6"  data-bs-toggle="modal" data-bs-target="#LoginModal">اسأل الأدمن</button>
      @endverify
        <a href="{{route('user_experience_page')}}" class=" btn rounded-3 btn-dark  my-1 py-2 px-3 fs-6"  >تجاربكم 🔬</a>      
    </div>
    
    <div class="d-block mt-4 inf-links shadow">
      <a href="{{route('about')}}" class="text-light my-1 py-1 px-3 fs-sm d-inline-block"  >استخدامات الموقع</a>
      <a href="{{route('privacy-policy')}}" class="text-light my-1 py-1 px-3 fs-sm d-inline-block"  >سياسة الخصوصية</a>
      <a href="{{route('faq')}}" class="text-light my-1 py-1 px-3 fs-sm d-inline-block"  >الاسئلة الشائعة</a>
    </div>
     
</footer>
