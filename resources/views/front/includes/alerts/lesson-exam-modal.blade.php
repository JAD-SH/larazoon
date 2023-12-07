
<!-- Modal -->
<div class="modal fade" id="LessonExamModal" tabindex="-1" role="dialog" aria-labelledby="LessonExamModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card p-3 shadow-sm border-0 rounded-5">
            <div class="modal-header   p-0 pb-3">
                <div class="modal-title fw-bolder text-danger" id="exampleModalLabel">قم بأختيار الاجوبة التي تعتقد انها صحيحة</div>
                <button type="button" class="btn-close m-0 p-0 d-flex align-items-center"  data-bs-dismiss="modal" aria-label="Close">
                <span class="fw-bolder text-dark" aria-hidden="true"><i class="fa-solid fa-xmark "></i></span>
                </button>
            </div>
            <div class="modal-body px-0">
            @if($lesson->exams()->count() > 0)

                <form method="POST" action="{{route('Exam.check-lesson-answers')}}">
                    @csrf    

                    <input class="form-control" name="lesson_id" value="{{$lesson->id}}" type="hidden">
                    @verify
                    <div class=" fw-bolder fs-6 border p-1 mb-2 text-center">  بالتوفيق   _{{Auth::user()->name}}_</div>
                    @else
                    <div>
                        <span class=" fw-bolder"> يرجى تسجيل الدخول اذا اردت ان يتم حفظ تقدمك البرمجي</span>
                        <a href="{{route('login')}}" class=" fw-bold px-0">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            الدخول 
                        </a>
                    </div>
                    @endverify
                    @foreach($lesson->exams as $index=> $exam)
                    <div class="p-2 all-questions">
                        <label class="text-dark fw-bolder fs-5">{{$exam->question}} <span class=" fs-5" style="float: right;">{{$index+1}} - </span></label>
                        <div class=" d-grid">
                            <div class="option my-1">
                                <input class="form-check-input" type="radio" name="{{$exam->id}}" value="{{$exam->right_answer}}">
                                <label class="form-check-label fw-bolder fs-6"> {{$exam->right_answer}} </label>
                            </div>
                            <div class="option my-1">
                                <input class="form-check-input" type="radio" name="{{$exam->id}}" value="{{$exam->wrong_answer_1}}">
                                <label class="form-check-label fw-bolder fs-6"> {{$exam->wrong_answer_1}} </label>
                            </div>
                            <div class="option my-1">
                                <input class="form-check-input" type="radio" name="{{$exam->id}}" value="{{$exam->wrong_answer_2}}">
                                <label class="form-check-label fw-bolder fs-6"> {{$exam->wrong_answer_2}} </label>
                            </div>
                            <div class="option my-1">
                                <input class="form-check-input" type="radio" name="{{$exam->id}}" value="{{$exam->wrong_answer_3}}">
                                <label class="form-check-label fw-bolder fs-6"> {{$exam->wrong_answer_3}} </label>
                            </div>
                        </div>
                        <hr class="horizontal mt-3 mb-0 dark">
                    </div>
                    @endforeach
                    
                    <button class="btn bg-gradient-{{$group_lessons[0]->course->color}} fs-6 ajax-submit mt-3">أرسل الإجابات</button>
                    <button type="button" class="btn bg-gradient-secondary fs-6 mt-3" data-bs-dismiss="modal">انسحاب</button>
                </form>
                @else
                <p class=" fw-bolder">لا يوجد اختبار لهذا الدرس بعد الرجاء العودة في وقت لاحق</p>
                <button type="button" class="btn rounded-3 bg-gradient-secondary fs-6 mb-0 mt-3" data-bs-dismiss="modal">عودة</button>
            @endif

            </div>
        </div>
    </div>
</div>