<div class="modal fade" id="replyModalMessage" tabindex="-1" role="dialog" aria-labelledby="replyModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header p-0 pb-3">
                <div class="modal-title fs-6  fw-bolder text-danger" id="replyModalLabel">برجاء احترام سياسة مجتمعنا في التواصل</div>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="create-reply-message-form" method="POST"  action="{{route('reply.message')}}">
                    @csrf    
                    <input name="notification_id" type="hidden">
                    <label for="message" class="fw-bolder fs-6 my-1 pb-2 text-dark">الرد</label>
                    <div class="input-group input-group-dynamic mb-3">
                        <textarea id="message" class="multisteps-form__textarea form-control" name="message" rows="2" placeholder="ادخل الرد هنا." spellcheck="false"></textarea>
                        <div id="message_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    <label for="code" class="fw-bolder fs-6 my-1 pb-2 text-dark">(كود برمجي )اختياري</label>
                    <div class="input-group input-group-dynamic mb-3">
                        <textarea id="code" class="multisteps-form__textarea form-control" name="code" rows="2" placeholder="ادخل الكود البرمجي هنا." spellcheck="false"></textarea>
                        <div id="code_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    
                    <button type="button" class="btn rounded-3 bg-gradient-primary fs-6 ajax-submit"  data-bs-dismiss="modal">أرسل الرد</button>
                    <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>
                </form>
            </div>
        </div>
    </div>
</div>