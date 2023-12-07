<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalTitle" aria-hidden="true"  style="z-index: 11111;">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content card border-0 justify-content-center mx-1 mx-md-4 mb-4 rounded-5 shadow-sm  p-4 col-10">
            <div class=" ">
                <h5 class="">انضم إلينا <i class="fa-solid fa-right-to-bracket "></i></h5>
                <hr class="horizontal  my-3 dark">
                <p class="mb-0">قم بسجيل الدخول لتتمكن من استخدام جميع مزايا الموقع وبشكل مجاني</p>
            </div>
            <div class=" pt-3">
                <form role="form text-left" action="{{route('login')}}" method="post">
                    @csrf
                    <label class="form-label fw-bolder" for="email">البريد الالكتروني</label>
                    <div class="input-group input-group-outline ">
                        <input id="email" type="email" name="email" class="form-control">
                    </div>
                    <label class="form-label fw-bolder" for="password">كلمة المرور</label>
                    <div class="input-group input-group-outline ">
                        <input id="password" type="password" name="password" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn rounded-4 bg-gradient-primary btn-lg btn-rounded w-100 mt-3 mb-0">الدخول</button>
                    </div>
                </form>
            </div>
            <div class="text-center mt-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="mb-4 text-primary  fw-bolder  fs-6 ">نسيت كلمة المرور</a>
                @endif
                <p class="mx-auto mt-1">
                ليس لديك حساب بعد؟
                <a href="#" class="text-primary text-gradient fw-bolder">إنشاء حساب جديد</a>
                </p>
            </div>
        </div>
    </div>
</div>
