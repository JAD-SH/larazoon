

<!-- Modal -->
<div class="modal fade" id="CreateMessageToAdminModal" tabindex="-1" role="dialog" aria-labelledby="CreateMessageToAdminModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header p-0 pb-3">
                <h6 class="modal-title fw-bolder fs-6 text-danger" id="exampleModalLabel">برجاء احترام سياسة مجتمعنا في التواصل</h6>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="font-weight-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="create-message-form text-start" method="POST"  action="{{route('create.message')}}">
                    @csrf    
                    
                    <input name="type" type="hidden">

                    <label for="message-title" class="fw-bolder fs-6 my-1 pb-2 text-dark">عنوان الموضوع</label>
                    <div class="input-group input-group-outline mb-3">
                        <input id="message-title" type="text" name="title" class="form-control">
                        <div id="title_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg my-2'></div>
                    </div>
                    
                    <label for="message" class="fw-bolder fs-6 my-1 pb-2 text-dark">الموضوع</label>
                    <div class="input-group input-group-dynamic mb-3">
                        <textarea id="message" class="multisteps-form__textarea form-control" name="message" rows="2" placeholder="ادخل الموضوع هنا." spellcheck="false"></textarea>
                        <div id="message_error" style="display:none;" class='bg-danger text-white m-0 p-2 font-weight-bolder w-100 error_msg my-2'></div>
                    </div>
                    
                    <button type="button" class="btn rounded-3 bg-gradient-primary fs-6 ajax-submit">أرسل الموضوع</button>
                    <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>
                </form>
            </div>
        </div>
    </div>
</div>