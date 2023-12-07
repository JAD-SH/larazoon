

<!-- Modal -->

<!-- Modal  هذه القديمة بدون تعقيد الاجابة حفظتها فقط من اجل العودة اليها ان احتاج الامر-->
<!-- 
    
<div class="modal fade" id="CreateCommentModal" tabindex="-1" role="dialog" aria-labelledby="CreateCommentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header p-0 pb-3">
                <div class="modal-title fw-bolder text-danger" id="exampleModalLabel">برجاء اتباع سياسة احترام الاخرين</div>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('add.comment',$question->id)}}">
                    @csrf    
                    <label class="fw-bolder fs-6 my-1 pb-2 text-dark" for="textarea">الجواب</label>
                    <div class="input-group input-group-dynamic mb-3">
                        <textarea id="textarea" class="multisteps-form__textarea form-control" name="comment" rows="2" placeholder="ادخل الجواب هنا." spellcheck="false"></textarea>
                        <div id="comment_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>

                    <!-  يجب متابعة بقية العمل في الكونتروللير ->
                    <label class="fw-bolder fs-6 my-1 pb-2 text-dark" for="codearea">كود برمجي (اختياري)</label>
                    <div class="input-group input-group-dynamic mb-3">
                        <textarea id="codearea" class="multisteps-form__textarea form-control" name="code" rows="2" placeholder="ادخل الاكواد البرمجية التي تشرح الحل هنا." spellcheck="false"></textarea>
                        <div id="code_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    <button  class="btn rounded-3 bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} fs-6  ajax-submit">أرسل الإجابة</button>
                    <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>
                </form>
            </div>
        </div>
    </div>
</div>

-->



<!-- Modal 
<div class="modal fade" id="CreateCommentReplyModal" tabindex="-1" role="dialog" aria-labelledby="CreateCommentReplyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header p-0 pb-3">
                <div class="modal-title fw-bolder text-danger" id="exampleModalLabel">برجاء اتباع سياسة احترام الاخرين</div>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body">
            <div class="modal-title fw-bolder text-danger" id="exampleModalLabel">انت الان تقوم بالتعليق على احد الاجوبة</div>
                <form  class="create-comment-reply-form"  method="POST">
                    @csrf    
                    <label class="fw-bolder fs-6 my-1 pb-2 text-dark" for="textarea">التعليق</label>
                    <div class="input-group input-group-dynamic mb-3">
                        <textarea id="textarea" class="multisteps-form__textarea form-control" name="comment" rows="2" placeholder="ادخل التعليق هنا." spellcheck="false"></textarea>
                        <div id="comment_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>

                    <!-  يجب متابعة بقية العمل في الكونتروللير ->
                    <label class="fw-bolder fs-6 my-1 pb-2 text-dark" for="codearea">كود برمجي (اختياري)</label>
                    <div class="input-group input-group-dynamic mb-3">
                        <textarea id="codearea" class="multisteps-form__textarea form-control" name="code" rows="2" placeholder="ادخل الاكواد البرمجية التي تشرح ." spellcheck="false"></textarea>
                        <div id="code_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div>
                    </div>
                    <!-  يجب متابعة بقية العمل في الكونتروللير ->
                    <button  class="btn rounded-3 bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} fs-6  ajax-submit">أرسل الإجابة</button>
                    <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>
                </form>
            </div>
        </div>
    </div>
</div>
-->


<!-- Modal -->
<div class="modal fade" id="CreateCommentReplyModal" tabindex="-1" role="dialog" aria-labelledby="CreateCommentReplyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mx-1 mx-md-3" role="document" style="max-width:unset;">
        <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header p-0 pb-3">
                <div class="modal-title fw-bolder text-danger" >برجاء اتباع سياسة احترام الاخرين</div>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body">
            <div class="modal-title fw-bolder text-{{$question->questionlibraries->first()->maincategory->first()->color}} mb-3">انت الان تقوم بالتعليق على احد الاجوبة</div>
            <form class="create-comment-reply-form"  method="POST">
                @csrf   
                <div class=" mb-3">
                    <div class="">
                        <div id="reply-ckeditor"  ></div>
                    </div>
                </div>
                <div class=" mb-3">
                    <div id="comment_error" style="display:none;" class='bg-danger text-white m-0 p-2 fw-bolder w-100 error_msg my-2'></div> 
                </div>
                <!--  يجب متابعة بقية العمل في الكونتروللير -->
                <button  class="btn rounded-3 bg-gradient-{{$question->questionlibraries->first()->maincategory->first()->color}} fs-6  ckeditor-ajax-submit" data-editor-id="reply-ckeditor"  data-editor-name="comment">أرسل التعليق</button>
                    <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>
            </form>
                
            </div>
        </div>
    </div>
</div>



