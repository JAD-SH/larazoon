

<div class="modal fade" id="add_plan" tabindex="-1" role="dialog" aria-labelledby="add_planTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header  p-0 pb-3">
                <div class="modal-title fs-6  fw-bolder text-danger" id="exampleModalLabel">برجاء إدخال سؤال مختص بالتقنية والمعلوماتية</div>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="add_edit-form-notification" method="POST" >
                    @csrf    
                    <label for="title" class="fw-bolder fs-6 my-1 pb-2 text-dark">عنوان خطة التعلم</label>
                    <div class="input-group input-group-outline mb-3">
                        <input id="title" type="text" name="title" class="form-control">
                        <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    <label for="description" class="fw-bolder fs-6 my-1 pb-2 text-dark">وصف خطة التعلم</label>
                    <div class="input-group input-group-dynamic mb-3">
                        <textarea id="description" class="multisteps-form__textarea form-control" name="description" rows="2" placeholder="ادخل الوصف هنا." spellcheck="false"></textarea>
                        <div id="description_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    <div class="mt-3">

                        <button class="btn rounded-3 bg-gradient-primary fs-6 ajax-submit" data-bs-dismiss="modal">ارسال</button>
                        <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">رجوع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>