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
                    <button type="button" class="btn rounded-3 fw-bolder fs-5" data-bs-dismiss="modal">الغاء</button>
            </form>
                
            </div>
        </div>
    </div>
</div>



