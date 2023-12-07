
<!-- Modal -->
<div class="modal fade " id="EditProfileModal" tabindex="-1" role="dialog" aria-labelledby="EditProfileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card  m-1 m-md-4 px-1 px-md-2  border-0 rounded-5  shadow-sm mb-3">
            <div class="modal-header">
                <h6 class="modal-title fw-bolder text-danger" id="exampleModalLabel">انت الان في طور تعديل ملفك الشخصي</h6>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{route('User.update',Auth::user()->id)}}">
                    @csrf    
                    <label for="user-name" class="fw-bolder fs-6 my-1 text-dark">الأسم</label>
                    <div class="input-group input-group-outline mb-3 mt-1">
                      <input id="user-name" type="text" name="name" class="form-control rounded-3" value="{{ Auth::user()->name }}">
                      <div id="name_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    
                    <label for="user-img" class="fw-bolder fs-6 my-1 text-dark">الصورة (إختياري)</label>
                    <div class=" my-3">
                        <div class=" border border-secondary rounded-2 border-1 my-2">
                            <input id="user-img" type="file" name="photo" class="form-control form-control-lg  rounded-3" aria-label="مثال على إدخال ملف كبير">
                        </div>
                        <div id="photo_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                  
                    <label for="birth_date" class="fw-bolder fs-6 my-1 text-dark">تاريخ ميلادك (اختياري)</label>
                    <div class="input-group input-group-static my-3">
                      <input id="birth_date" type="date" name="birth_date" class="form-control  rounded-3" value="{{ Auth::user()->birth_date }}">
                      <div id="birth_date_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    
                    <label class="fw-bolder fs-6 my-1 text-dark">الجنس</label>
                    <div class=" my-3">
                      <div class="nav-wrapper position-relative start-0">
                        <ul class="nav nav-pills nav-fill p-1 gender" role="tablist">
                          <li type="button" class="nav-item fw-bolder  rounded-3" onclick="checkFunction('gender')">
                            <div class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" role="tab" aria-controls="dashboard" aria-selected="true"  >
                            ذكر
                            <input id="male"  type="checkbox"  value="0" class="hidden " name="gender" @if(Auth::user()->gender == 0) checked @endif >
                            </div>
                          </li>
                          <li type="button" class="nav-item fw-bolder  rounded-3" onclick="checkFunction('gender')">
                            <div class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="false" >
                            انثى
                            <input id="female"  type="checkbox" value="1" class="hidden" name="gender"  @if(Auth::user()->gender == 1) checked @endif >
                            </div>
                          </li>
                        </ul>
                        <div id="gender_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                      </div>
                    </div>

                    <label for="description" class="fw-bolder fs-6 my-1 text-dark">الوصف</label>
                    <div class="input-group input-group-dynamic">
                        <textarea id="description" class="multisteps-form__textarea form-control  rounded-3" name="description" rows="2" placeholder="وصف حولك وطبيعة اهتماماتك." spellcheck="false">{{ Auth::user()->description }}</textarea>
                        <div id="description_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>

                    <div class="input-group input-group-outline mb-3 mb-1 mt-3">
                      <label class="p-2 ps-0" for="facebook"> <i class="fab fa-facebook fa-lg text-info fs-4"></i></label>
                      <input type="text" id="facebook" name="facebook" class="form-control  rounded-3" value="{{ Auth::user()->facebook }}">
                        <div id="facebook_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    
                    <div class="input-group input-group-outline mb-3 mt-1">
                      <label class="p-2 ps-0" for="twitter"> <i class="fab fa-twitter fa-lg text-info fs-4"></i></label>
                      <input type="text" id="twitter" name="twitter" class="form-control  rounded-3" value="{{ Auth::user()->twitter }}">
                        <div id="twitter_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>

                    <div class="input-group input-group-outline mb-3 mt-1">
                      <label class="p-2 ps-0" for="instagram"> <i class="fab fa-instagram fa-lg text-warning fs-4"></i></label>
                      <input type="text" id="instagram" name="instagram" class="form-control  rounded-3" value="{{ Auth::user()->instagram }}">
                        <div id="instagram_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    <div class="input-group input-group-outline mb-3 mt-1">
                      <label class="p-2 ps-0" for="github"> <i class="fab fa-github fa-lg text-dark fs-4"></i></label>
                      <input type="text" id="github" name="github" class="form-control  rounded-3" value="{{ Auth::user()->github }}">
                        <div id="github_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>

                    <div class="mt-4">
                      <button type="button"  class="btn rounded-3 bg-gradient-info fs-6 ajax-submit">حفظ التعديلات</button>
                      <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>