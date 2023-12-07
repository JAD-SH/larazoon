
@extends('layouts.front.site')

@section('title',$lesson->title)
@section('description',$lesson->description)
@section('og:url',route('show-lesson',[$group_lessons[0]->course->slug,$lesson->slug]))
@section('og:image',asset($group_lessons[0]->course->photo))
@section('og:image:url',asset($group_lessons[0]->course->photo))


@section('css')
    <link href="{{asset('public/assets/css/lesson.css')}}" rel="stylesheet" />
    
    
    <style>
        .example{
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        .example td, .example th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        color:#000;
        }

        .example tr{
        background-color: #ffffff;
        }
        .example tr:nth-child(even) {
        background-color: #d7d7d7;
        }
    </style>
    <link href="{{asset('public/assets/css/lesson.css')}}" rel="stylesheet" />
    {!!$lesson->style!!}
    {!!$schemajspnscript!!}
@endsection


@section('path')
    <li class="breadcrumb-item fw-bolder"><a class="nav-link d-inline" href="{{route('show-course',$group_lessons[0]->course->slug)}}">{{$group_lessons[0]->course->title}}</a></li>
    <li class="breadcrumb-item fw-bolder active " aria-current="page">{{$lesson->title}}</li>
@endsection

@section('content')




@include('front.includes.alerts.title-page-save', 
    ['color' => $group_lessons[0]->course->color ,
    'title' => $lesson->title,'librarytitle' => $group_lessons[0]->course->title,
    'createdat' => $lesson->created_at->diffForHumans(),
    'saveroute' => route('save-lesson',$lesson->id)])



<!-- 
-->

    <div class="card shadow-sm">
   
    {!!$lesson->content!!}
    
        <div class="p-3">
            <div class="fw-bolder fs-5">سنتعلم في هذا الدرس الامور التالية :</div>
            <ul class=" navbar-nav list-path">
                <li><a href="#myid">إضافة الروابط والتحكم بها</a></li>
                <li><a href="#">إضافة قواعد البانات والتحكم بها</a></li>
                <li><a href="#">إضافة اكواد css والتحكم بها</a></li>
                <li><a href="#">إضافة الكيبورد والتحكم بها</a></li>
                <li><a href="#">إضافة الروابط والتحكم بها</a></li>
            </ul>
        </div>

        <!-- بداية عناصر الالوان -->
        <div class="p-3 row text-center">
            <span class="col-4 col-md-2 py-3" style="background-color:tomato; border: 4px solid #ffffff36;">tomato</span>
            <span class="col-4 col-md-2 py-3" style="background-color:aqua; border: 4px solid #ffffff36;">aqua</span>
            <span class="col-4 col-md-2 py-3" style="background-color:chartreuse; border: 4px solid #ffffff36;">chartreuse</span>
            <span class="col-4 col-md-2 py-3 text-light" style="background-color:teal; border: 4px solid #ffffff36;">teal</span>
        </div>
        <!-- نهاية عناصر الالوان -->


        <!-- بداية عنصر المثال المباشر (الظاهر) -->
        <div class="p-3">
            <h2 class="header-2">مثال</h2>
            <div>
                <table class="example">
                    <tr>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Country</th>
                    </tr>
                    <tr>
                        <td>Alfreds Futterkiste</td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                    </tr>
                    <tr>
                        <td>Centro comercial Moctezuma</td>
                        <td>Francisco Chang</td>
                        <td>Mexico</td>
                    </tr>
                    <tr>
                        <td>Ernst Handel</td>
                        <td>Roland Mendel</td>
                        <td>Austria</td>
                    </tr>
                    <tr>
                        <td>Island Trading</td>
                        <td>Helen Bennett</td>
                        <td>UK</td>
                    </tr>
                    <tr>
                        <td>Laughing Bacchus Winecellars</td>
                        <td>Yoshi Tannamuri</td>
                        <td>Canada</td>
                    </tr>
                    <tr>
                        <td>Magazzini Alimentari Riuniti</td>
                        <td>Giovanni Rovelli</td>
                        <td>Italy</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- نهاية عنصر المثال المباشر (الظاهر) -->


        
 
        <!-- بداية عرض كود TryIt  -->
        <!-- بدل محل النوع css بنوع الكود -->
        <div class="my-3 display-code">

            <pre class="language-css my-3">
                
                <code class="language-css"> /**this is just a comment */
* {
    font-size: .95rem!important;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    color: var(--bs-text-color);
}
/**this is just comment */
* {
    font-size: .95rem!important;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    color: var(--bs-text-color);
}
/**this is just comment */
* {
    font-size: .95rem!important;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    color: var(--bs-text-color);
}
/**this is just comment */
* {
    font-size: .95rem!important;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    color: var(--bs-text-color);
}</code>
            </pre>
            <a class="TI-RM-B" href="{{route('tryit-page','ssssss');}}" type="button">
                جرب
                <i class="fa-solid fa-play "></i>
            </a>
        </div>
        <!-- نهاية عرض كود TryIt  -->        


        <!-- بداية عناوين الفقرات -->
        <h2 class="header-2" id="myid">عنوان رئيسي</h2>
        <h3>عنوان فرعي</h3>
        <h4>عنوان فرعي اقل رتبة</h4>
        <!-- بداية عناوين الفقرات -->




        <!-- بداية كود لسطر واحد -->
        <!-- بدل محل html بنوع الكود -->
        <div class="my-2">
            <pre class="language-html smal-code">
                <code class="language-html">&lt;button onclick="document.location='url'">text&lt;/button></code>
            </pre>
        </div>
        <!-- نهاية كود لسطر واحد -->

   
        <!-- بداية فقرة مع تنسيقات الكلمات -->
        <div class="parag">
            <p>
                ى  يموتون واحدا تلو الأخر، فهذا يعني أنك خسرت الجولة، والخسارة تعني أنك ستعود مجددا إلى نقطة الإنطلاق. لذلك عليك أن تكون حذرا لل
                إلى  . لذلك عليك أن تكون حشذ
                <!-- بدل محل html بنوع الكود -->
                <pre class="language-html smal-code word-code nowr">
                    <code class="language-html">&lt;div> &lt;/div></code>
                </pre>
                 واحدا تلو الأخر، فهذا 
                 <b class="word nowr">Dave Ragget</b> هذه الفقرة ممتازة <kbd class="fw-bolder text-light mx-1 nowr">windows + R</kbd>يعني أنك خسرت 
                ى <samp class="code-box-line code-box nowr">line-height: 1.626</samp>   يموتون واحدا تلو الأخر، فهذا يعني أنك 
                <samp class="code-box code-box-color nowr">&lt;div> &lt;/div></samp>خسرت الجولة، 
            </p>
        </div>
        <!-- نهاية فقرة مع تنسيقات الكلمات -->



        <!-- بداية قائمة تعداد -->
        <ul>
            <li>في هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامهذا القسم سنتعلم بعض الاشياء  .</li>
            <li>في هذا القسم سنتعلم بعض الاشياء الهامة</li>
            <li>في هذا القسم سنتعلم بعهذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامةض الاشياء الهامة</li>
        </ul>
        <!-- نهاية قائمة تعداد -->

        <!-- بداية قائمة تعداد قرص -->
        <ul class="cir">
            <li>في هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامهذا القسم سنتعلم بعض الاشياء  .</li>
            <li>في هذا القسم سنتعلم بعض الاشياء الهامة</li>
            <li>في هذا القسم سنتعلم بعهذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامةض الاشياء الهامة</li>
        </ul>
        <!-- نهاية قائمة تعداد قرص -->

        <!-- بداية قائمة تعداد رقمية -->
        <ul class="dec">
            <li>في هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامهذا القسم سنتعلم بعض الاشياء  .
            <div class="my-3">
            <a class="mx-auto" href="{{Image('zzaa')}}" target="_blank">
                <img src="{{Image('zzaa')}}"  alt="img-blur-shadow" class="image">
            </a>
        </div>
            </li>
            
            <li>في هذا القسم سنتعلم بعض الاشياء الهامة</li>
            <li>في هذا القسم سنتعلم بعهذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامة هذا القسم سنتعلم بعض الاشياء الهامةض الاشياء الهامة</li>
        </ul>
        <!-- نهاية قائمة تعداد رقمية -->



        <!-- بداية الرسائل التوضيحية -->
        <div>
            <div class="alert-title text-info">معلومة <span class=""><i class="fa-solid fa-circle-info fs-5 text-info sign-info"></i></span></div>
            <div class="alert alert-info" role="alert">
                A simple info alert—check it out.
            </div>
        </div>
    
        <div>
            <div class="alert-title text-warning">ملاحظة <span class="fs-4 text-warning sign-warning">📣</span></div>
            <div class="alert alert-warning" role="alert">
                A simple warning alert—check it out!
            </div>
        </div>
    
        <div>
            <div class="alert-title text-danger">تحذير <span class="fs-4 text-danger sign-danger">!</span></div>
            <div class="alert alert-danger" role="alert">
                A simple danger alert—check it out!
            </div>
        </div>
    
        <div>
            <div class="alert-title text-secondary">سؤال <span class="fs-4 text-secondary sign-secondary">?</span></div>
            <div class="alert alert-secondary " role="alert">
                A simple secondary alert—check it out?
            </div>
        </div>
    
        <div>
            <div class="alert-title text-success">جواب <span class="fs-4 text-success sign-success">.</span></div>
            <div class="alert alert-success" role="alert">
                A simple success alert—check it out.
            </div>
        </div>
        <!-- نهاية الرسائل التوضيحية -->


        
        <!-- بداية الصورة-->
        <div class="my-3">
            <a class="mx-auto" href="{{Image('zzaa')}}" target="_blank">
                <img src="{{Image('zzaa')}}"  alt="img-blur-shadow" class="image">
            </a>
        </div>
        <!-- نهاية الصورة-->


        <!-- بداية الفيديو-->
        <div class="my-3">
            <video width="400" controls>
                <source src="{{Media('vvvvvvv')['media']}}" type="{{Media('vvvvvvv')['type']}}">
                المتصفح الخاص بك لا يدعم هذا الفيديو.
            </video>
        </div>
        <!-- نهاية الفيديو-->


        <!-- بداية الصوت-->
        <div class="my-2">
            <audio controls>
                <source src="{{Media('aaaa')['media']}}" type="{{Media('vvvvvvv')['type']}}">
                المتصفح الخاص بك لا يدعم هذا الصوت.
            </audio>
        </div>
        <!-- نهاية الصوت-->


        <!-- بداية تحميل الملف-->
        <div class="m-2">
            <a href="{{route('file.download','wdd')}}">
                <button data-sos="sos-top" class="btn bg-gradient-dark m-1 text-light py-3 px-4 border-2 rounded-4 fw-bolder sos-top">
                    <i class="fs-6 fa-solid fa-download"></i> تحميل الملف 
                </button>
            </a>
        </div>
        <!-- نهاية تحميل الملف-->


        <!-- بداية رابط لصفحة اخرى-->
        <div class="m-2">
            <a data-sos="sos-zoom-in"  href="#" class="btn bg-gradient-dark m-1 text-light py-3 px-4 border-2 rounded-4 fw-bolder sos-top">
                رابط لصفحة اخرى 
            </a>
        </div>
        <!-- نهاية رابط لصفحة اخرى-->


        <!-- بداية جدول الدعم-->            
        <div class="tab-cont">
            <div class="scroll-right d-none d-flex">
                <i class="fa-solid fa-angles-right"></i>
            </div>
            <div class="table-responsive">
                <table class="table table-support-SE">
                    <thead>
                        <tr class="">
                            <th class="">chrome</th>
                            <th class="">edge</th>
                            <th class="">exploler</th>
                            <th class="">opera</th>
                            <th class="">safari</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="" >
                                <span class="text-success">يدعم</span><i class="fa-solid fa-check text-success"></i>
                            </td>
                            <td class="" >
                                <span class="text-danger">لا يدعم</span><i class="fa-solid fa-xmark text-danger"></i>
                            </td>
                            <td class="" >
                                <span class="text-danger">لا يدعم</span><i class="fa-solid fa-xmark text-danger"></i>
                            </td>
                            <td class="" >
                                <span class="text-success">يدعم</span><i class="fa-solid fa-check text-success"></i>
                            </td>
                            <td class="" >
                                <span class="text-success">يدعم</span><i class="fa-solid fa-check text-success"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- نهاية جدول الدعم-->

        <!-- بداية جدول (قيمة - شرح)-->  
        <div class="tab-cont">
            <div class="scroll-right d-none d-flex" >
                <i class="fa-solid fa-angles-right"></i>
            </div>
            <div class="table-responsive">
                <table class="table table-section">
                    <thead>
                        <tr class="">
                            <th class="">الوسم</th>
                            <th class="text-start ps-5">ملخص عنه</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                            <td class="prop" >
                                <samp class="code-box-line code-box"> display:block </samp><hr class="horizontal dark">
                                <samp class="code-box-line code-box"> display:block </samp>
                            </td>
                            <td class="explain">
                                >هذه الخاصية تجعل العنصر يأخذ كلمل السطر 
                                </td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </div>
        <!-- نهاية جدول (قيمة - شرح)-->    

        
        <!-- بداية جدول (قيمة- جرب - شرح)-->  
        <div class="tab-cont">
            
            <div class="scroll-right d-none d-flex" >
                <i class="fa-solid fa-angles-right"></i>
            </div>
            <div class="table-responsive">
                <table class="table table-tryit">
                    <thead>
                        <tr class="">
                            <th class="">الخاصية</th>
                            <th class="">جرب</th>
                            <th class="text-start ps-5">شرح</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="prop" >
                                <samp class="code-box-line code-box">line-height: 1.625</samp>
                            </td>
                            <td class="">
                                
                                <a class="TI-RM-B" href="{{route('tryit-page','paragraph');}}" type="button">
                                    جرب
                                    <i class="fa-solid fa-play "></i>
                                </a>
                            </td>
                            <td class="explain">
                                تبقى Dumb Ways to Die Original لعبة كاجوال عادية ولكنها مسلية جدا. كما أنها تحظى بنفس الرسوم المتحركة والصور التي تميزت بها لعبة الفيديو الأصلية، كما تحظى بطريقة لعبة رائعة تتناسب تماما مع شاشات اللمس.
                                تبقى Dumb Ways to Die Original لعبة كاجوال عادية ولكنها مسلية جدا. كما أنها تحظى بنفس الرسوم المتحركة والصور التي تميزت بها لعبة الفيديو الأصلية، كما تحظى بطريقة لعبة رائعة تتناسب تماما مع شاشات اللمس.
                                    
                            </td>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- نهاية جدول (قيمة- جرب - شرح)--> 
    </div>
    
   
@if($lesson->accessors()->exists())
<div class="card shadow-sm">
    <h2 class="header-2" id="myid">الدروس الملحقة لهذا الدرس</h2>
    <div class="tab-cont">
        <div class="scroll-right d-none d-flex" >
            <i class="fa-solid fa-angles-right"></i>
        </div>
        <div class="table-responsive">
            <table class="table table-section">
                <thead>
                    <tr class="">
                        <th class="">تابع الدرس</th>
                        <th class="text-start ps-5">مُلخص</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lesson->accessors as $accessor)
                    <tr>
                        <td class="prop" >
                            <a target="_blank" href="{{route('show-lesson',[$lesson->group->course->slug,$accessor->slug])}}">
                                <samp class="  code-box code-box-color"> {{$accessor->about}} </samp>
                            </a>
                        </td>
                        <td class="explain">
                           {{ $accessor->description }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="code-information">
                    <b class="word nowr">style.css</b>
                    <img src="{!!Media('code-info-logo-code-info-logo-css')['media']!!}" alt="" class="code-logo">
                </div>
                <div class="my-3 display-code">
                    <pre class="language-css my-3">
                        <code class="language-css">h1{
    color: goldenrod !important;
}

#demo-id{
    color: deeppink ;
}

.demo-class{
    color: green ;
}

*{
    color: blue ;
}</code>
                    </pre>
                </div>
                <div class="code-information">
                    <b class="word nowr">index.html</b>
                    <img src="{{Media('code-info-logo-code-info-logo-html')['media']}}" alt="" class="code-logo">
                </div>
                <div class="my-3 display-code">
                    <pre class="language-html my-3">
                        <code class="language-html">&lt;!DOCTYPE html>
&lt;html lang="en">
    &lt;head>
        &lt;link rel="stylesheet" href="style.css">
        &lt;style>
            h1{
                color: blueviolet ;
            }
        &lt;/style>
    &lt;/head>
    &lt;body>
        &lt;h1 class="demo-class" id="demo-id" style="color: red ;">Hello World&lt;/h1>
    &lt;/body>
&lt;/html></code>
                    </pre>
                    <a class="TI-RM-B" href="{{route('tryit-page','css-firstly-run-css-code-example');}}" type="button">
                        جرب
                        <i class="fa-solid fa-play "></i>
                    </a>
                </div>
</div>
@endif

<!--هذا من اجل الاختبار -->
@if($lesson->exams()->exists())
    <div class="card shadow-sm pb-3">
        <!-- Button trigger modal -->
        @verify
            @if(Auth::user()->lessons->where('lesson_id',$lesson->id)->first() !== null)
                @if(Auth::user()->lessons->where('lesson_id',$lesson->id)->first()->result === null)
                    
                    <button  data-sos="sos-zoom-in" type="button" class="TI-RM-B py-3 " 
                        data-bs-toggle="modal" data-bs-target="#LessonExamModal">
                        خوض أختبار وقيم فهمك للدرس
                    </button>
                    
                    @include('front.includes.alerts.lesson-exam-modal')
                @else
                    <span  data-sos="sos-zoom-in" type="button" class="TI-RM-B py-3 " >
                        نتيجتك في هذا الاختبار <strong class="text-white fs-6 border-bottom border-2">{{Auth::user()->lessons->where('lesson_id',$lesson->id)->first()->result}}</strong>
                    </span>
                @endif
            @else
                <button  data-sos="sos-zoom-in" type="button" class="TI-RM-B py-3 " 
                    data-bs-toggle="modal" data-bs-target="#LessonExamModal">
                    خوض أختبار وقيم فهمك للدرس
                </button>
                @include('front.includes.alerts.lesson-exam-modal')
            @endif
        @else
            
            @if(! session()->has('lessonExam'.$lesson->id.'IsExamine'))
                
                <button  data-sos="sos-zoom-in" type="button" class=" TI-RM-B py-3" 
                    data-bs-toggle="modal" data-bs-target="#LessonExamModal">
                    خوض أختبار وقيم فهمك للدرس
                </button>
                
                @include('front.includes.alerts.lesson-exam-modal')

            @else
                <span type="button" class="TI-RM-B py-3" >
                    بالفعل قمت بالاختبار
                </span>
            @endif
        @endverify
    </div>
@endif

    <div class="m-3" data-sos="sos-zoom-out" style="display: flow-root; ">
        @if($previous !== null)
            <a href="{{route('show-lesson',[$group_lessons[0]->course->slug,$previous['slug']])}}" class="TI-RM-B float-start">
                <i class="fa-solid fa-angle-right"></i> الدرس السابق 
            </a>
        @endif
        @if($next !== null)
            <a href="{{route('show-lesson',[$group_lessons[0]->course->slug,$next['slug']])}}" class="TI-RM-B float-end">
                الدرس التالي <i class="fa-solid fa-angle-left"></i>
            </a>
        @endif
    </div>

    @include('front.includes.alerts.likes-views', 
       ['isliked' => 'lesson'.$lesson->id.'IsLiked' ,
        'likedroute' => route('Lesson.AddLike',$lesson->id) ,
        'color' => $group_lessons[0]->course->color ,
        'name' => 'الدرس',
        'likes' => $lesson->likes,'views' => $lesson->views])



@endsection


  
@section('script')

<script>
    let page_color = "{{$group_lessons[0]->course->color}}";
    style_function(page_color);


    let all_questions = [...document.querySelectorAll(".all-questions")];
    let options_question;
    all_questions.forEach(question => {
        
        options_question = [...$(question).find('div .option')];
        options_question.forEach(option => {
            y=Math.floor(Math.random() *20);
            option.style.order=y;
        });
        
    });
    
    //ajax_function();

    create_save_btn(page_color,"{{route('save-lesson',$lesson->id)}}");
    
</script>
<script>
    
    scroll_to_right();
    
</script>
{!!$lesson->script!!}

@endsection

