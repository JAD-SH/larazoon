<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\LogoutController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\SiteController;
use App\Http\Controllers\Front\ArticleController;
use App\Http\Controllers\Front\QuestionController;
use App\Http\Controllers\Front\BookController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\UserProfileController;
use App\Http\Controllers\Front\ExamController;
use App\Http\Controllers\Front\SubCategoryController;
use App\Http\Controllers\Front\NotificationController;
use App\Http\Controllers\Front\AutoSiteMapGenerate;
use App\Http\Controllers\Front\TryitController;
use App\Http\Controllers\Front\UserExperienceController;
use App\Http\Controllers\Front\SupporterController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify'=>true]);

    Route::get('/', [SiteController::class, 'index'])->name('Course.index');
    
    
    Route::get('/tryit/{slug}', [TryitController::class, 'tryIt_page'])->name('tryit-page');
    Route::get('/error', function(){
        return view('front.error');
    });
    Route::get('/user_experience', [UserExperienceController::class, 'user_experience_page'])->name('user_experience_page');
    Route::get('/supporters', [SupporterController::class, 'supporters_page'])->name('supporters_page');
    Route::get('/all-supporters', [SupporterController::class, 'all_supporters_page'])->name('all_supporters_page');
    Route::get('/faq', [SiteController::class, 'faq'])->name('faq');
    Route::get('/privacy-policy', [SiteController::class, 'privacy_policy'])->name('privacy-policy');
    Route::get('/about', [SiteController::class, 'about'])->name('about');
    Route::get('/support-us', [SupporterController::class, 'support_us'])->name('support-us');
    Route::get('User/supporter-archive/{username}',[SupporterController::class, 'supporter_archive'])-> name('User.supporter-archive');
    
    Route::get('file/download/{slug}', [SiteController::class, 'file_download'])->name('file.download');
     
    ########################### begin Subcategory ########################################

        Route::get('/Subcategories', [SubCategoryController::class, 'Subcategories'])->name('show-Subcategories');
        Route::get('/Subcategories/{subcategory_slug}', [SubCategoryController::class, 'subcategory'])->name('show-Subcategory');
        Route::get('/Subcategories/{subcategory_slug}/{category_slug}',[SubCategoryController::class, 'category'])-> name('show-category');
        Route::post('Category/{id}',[SubCategoryController::class, 'AddLike'])-> name('Category.AddLike');
    
    ########################### end Subcategory ########################################
     ########################### begin Course ########################################
        
        Route::get('/courses', [SiteController::class, 'index']);
        Route::get('courses/{course_slug}', [SiteController::class, 'course'])->name('show-course');
        Route::get('courses/{course_slug}/{lesson_slug}', [SiteController::class, 'lesson'])->name('show-lesson');
        Route::post('Lesson/{id}',[SiteController::class, 'AddLike'])-> name('Lesson.AddLike');
        
    ########################### end Course ########################################

    ########################### begin Profile ########################################
        
        Route::get('users/{username}', [UserProfileController::class, 'showprofile'])->name('show-profile');
        
        Route::post('User/{user_id}',[UserProfileController::class, 'AddLike'])-> name('User.AddLike');
    
    ########################### end Profile ########################################
        
    ########################### begin Article ########################################

        Route::resource('Article',ArticleController::class)->except([
            'create', 'store', 'edit',  'update', 'destroy'
        ]);
        Route::post('Article/{id}',[ArticleController::class, 'AddLike'])-> name('Article.AddLike');
        
        Route::get('Article//top-likes',[ArticleController::class, 'top_likes'])-> name('article-top-likes');
        Route::get('Article//top-views',[ArticleController::class, 'top_views'])-> name('article-top-views');

        //Route::get('Article-search/{library-slug}', [ArticleController::class, 'article_ajax_search'])->name('article-search');
        Route::get('Article//{slug}', [ArticleController::class, 'article_search'])->name('article-search');
        
    ########################### end Article ########################################
    
    ########################### begin Question ########################################

        Route::resource('Question',QuestionController::class)->except([
            'create', 'store', 'edit',  'update', 'destroy'
        ]);
        Route::post('Question/{id}',[QuestionController::class, 'AddLike'])-> name('Question.AddLike');
        
        Route::get('Question//top-likes',[QuestionController::class, 'top_likes'])-> name('question-top-likes');
        Route::get('Question//top-views',[QuestionController::class, 'top_views'])-> name('question-top-views');
        
        Route::get('Question//{slug}', [QuestionController::class, 'question_search'])->name('question-search');
        //Route::get('Question_search/{id}', [QuestionController::class, 'question_ajax_search'])->name('question-search');
        
        Route::post('Comment/like/{question_id}',[CommentController::class, 'AddLike'])-> name('Comment.AddLike');
        Route::post('Comment/dislike/{question_id}',[CommentController::class, 'AddDisLike'])-> name('Comment.AddDisLike');

    
    ########################### end Question ########################################

    ########################### begin Exam ########################################
    
        Route::post('Exam/check-lesson-answers',[ExamController::class, 'CheckLessonAnswers'])-> name('Exam.check-lesson-answers');
        Route::post('studied-lesson/{lesson_id}',[ProfileController::class, 'studied_lesson'])-> name('studied-lesson');
    
    ########################### end Exam ########################################
    
    ########################### begin Book ########################################
        
        Route::resource('Book',BookController::class)->except([
            'create', 'store', 'edit',  'update', 'destroy'
        ]);
        Route::post('Book/{id}',[BookController::class, 'AddLike'])-> name('Book.AddLike');
        
        Route::get('Book//top-likes',[BookController::class, 'top_likes'])-> name('book-top-likes');
        Route::get('Book//top-downloads',[BookController::class, 'top_downloads'])-> name('book-top-downloads');
        
        Route::get('Book//{slug}', [BookController::class, 'book_search'])->name('book-search');
        Route::get('Book/download/{id}', [BookController::class, 'book_download'])->name('book.download');
        //Route::get('Book_search/{id}', [BookController::class, 'book_ajax_search'])->name('book-search');
        
        ########################### end Book ########################################
        
    Route::group(['middleware'=>'auth'], function(){
        
        Route::post('create-message',[NotificationController::class, 'createMessage'])-> name('create.message');
        Route::post('user_experience_stor', [UserExperienceController::class, 'createExperience'])->name('user_experience_stor');
        Route::post('user_experience_delete', [UserExperienceController::class, 'deleteExperience'])->name('user_experience_delete');
        Route::get('/score-support', [SupporterController::class, 'score_support'])->name('score-support');
        Route::post('/save-score-support', [SupporterController::class, 'save_score_support'])->name('save-score-support');
    ########################### begin User ########################################

        Route::get('User.site-media-page',[ProfileController::class, 'site_media_page'])-> name('User.site-media-page');
        Route::get('User.site-inform-page',[ProfileController::class, 'site_inform_page'])-> name('User.site-inform-page');
        
        Route::get('User.archive-lessons',[ProfileController::class, 'archive_lessons'])-> name('User.archive-lessons');
        Route::get('User.archive-articles',[ProfileController::class, 'archive_articles'])-> name('User.archive-articles');
        Route::get('User.archive-books',[ProfileController::class, 'archive_books'])-> name('User.archive-books');
        Route::get('User.archive-questions',[ProfileController::class, 'archive_questions'])-> name('User.archive-questions');
        Route::get('User.archive-categories',[ProfileController::class, 'archive_categories'])-> name('User.archive-categories');
        Route::post('User.archive-remove/{item_id}',[ProfileController::class, 'remove_from_archive'])-> name('User.archive-remove');

        Route::post('User.visible',[ProfileController::class, 'change_visible'])-> name('User.visible');
        
        Route::post('User.update',[ProfileController::class, 'update'])-> name('User.update');
        
        Route::post('User.site-notification',[ProfileController::class, 'site_notification'])-> name('User.site-notification');
        
        Route::post('User.follow-course/{course_id}',[ProfileController::class, 'follow_course'])-> name('User.follow-course');
        
        Route::post('User.un-follow-course/{course_id}',[ProfileController::class, 'un_follow_course'])-> name('User.un-follow-course');
        
        Route::post('User.follow-plan/{plan_id}',[ProfileController::class, 'follow_plan'])-> name('User.follow-plan');
        
        Route::post('User.un-follow-plan',[ProfileController::class, 'un_follow_plan'])-> name('User.un-follow-plan');
        
        Route::post('save-article/{article_id}',[ProfileController::class, 'save_article'])-> name('save-article');
        Route::post('save-lesson/{lesson_id}',[ProfileController::class, 'save_lesson'])-> name('save-lesson');
        Route::post('save-question/{question_id}',[ProfileController::class, 'save_question'])-> name('save-question');
        Route::post('save-book/{book_id}',[ProfileController::class, 'save_book'])-> name('save-book');
        Route::post('save-category/{category_id}',[ProfileController::class, 'save_category'])-> name('save-category');
        
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('how-lock-your-profile', [ProfileController::class, 'showmyprofile'])->name('show-my-profile');
        
        Route::get('Logout', [LogoutController::class, 'perform'])->name('user.logout');

    ########################### end User ########################################
    
    ########################### begin Questio ########################################

       // Route::post('create-question',[QuestionController::class, 'createQuestion'])-> name('create.question');
        Route::post('delete-question/{question_id}',[QuestionController::class, 'deleteQuestion'])-> name('delete.question');
        
        Route::post('create-question',[QuestionController::class, 'createQuestion'])-> name('create.question');
        
        //Route::get('show-program-question-page',[QuestionController::class, 'showProgramQuestionPage'])-> name('show.program.question.page');
        
        Route::post('add-comment/{question_id}',[CommentController::class, 'addComment'])-> name('add.comment');
        Route::post('delete-comment/{comment_id}',[CommentController::class, 'deleteComment'])-> name('delete.comment');

        Route::post('add-comment-reply/{comment_id}',[CommentController::class, 'addCommentReply'])-> name('add.comment-reply');
    
    ########################### end Questio ########################################
    
    ########################### begin Exams ########################################

        Route::get('Course-Exams/{slug}', [ExamController::class, 'course_exams'])->name('course.exams');
        
        Route::post('Exam/check-course-answers',[ExamController::class, 'CheckCourseAnswers'])-> name('Exam.check-course-answers');
        
    ########################### end Exams ########################################

    
});
Route::get('/sitemap', [AutoSiteMapGenerate::class, 'generate_site_map']);
/*
Route::fallback(function () {
    return view('errors.404');
});
*/