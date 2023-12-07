<div class="modal fade" id="addEditExamQuestion" tabindex="-1" role="dialog" aria-labelledby="addEditExamQuestionTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content  card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header  p-0 pb-3">
                <div class="modal-title fs-6  fw-bolder text-danger" id="exampleModalLabel">برجاء إدخال سؤال متخصص بشرح الدرس او ما شابه ذلك</div>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="edit-create-form-notification">
                @csrf    
                
                    <div class="mb-5">
                        <label for="question" class="fw-bolder fs-6 my-1 pb-2 text-dark"> السؤال </label>
                        <div class="input-group input-group-outline  m-0">
                            <input id="question" type="text" required name="question" class="fw-bolder form-control question">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="right_answer" class="fw-bolder fs-6 my-1 pb-2 text-dark"> الأجابة الصحيحة </label>
                        <div class="input-group input-group-outline  m-0">
                            <input id="right_answer" type="text" required name="right_answer" class="fw-bolder form-control question">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="wrong_answer_1" class="fw-bolder fs-6 my-1 pb-2 text-dark"> الأجابة الخاطئة 1 </label>
                        <div class="input-group input-group-outline  m-0">
                            <input id="wrong_answer_1" type="text" required name="wrong_answer_1" class="fw-bolder form-control question">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="wrong_answer_2" class="fw-bolder fs-6 my-1 pb-2 text-dark"> الأجابة الخاطئة 2 </label>
                        <div class="input-group input-group-outline  m-0">
                            <input id="wrong_answer_2" type="text" required name="wrong_answer_2" class="fw-bolder form-control question">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="wrong_answer_3" class="fw-bolder fs-6 my-1 pb-2 text-dark"> الأجابة الخاطئة 3 </label>
                        <div class="input-group input-group-outline  m-0">
                            <input id="wrong_answer_3" type="text" required name="wrong_answer_3" class="fw-bolder form-control question">
                        </div>
                    </div>
                    <button type="submit"  class="btn rounded-3 bg-gradient-primary fs-6 ">ادخال الاختبار</button>
                    <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6" data-bs-dismiss="modal">الغاء</button>
                </form>
            </div>
        </div>
    </div>
</div>