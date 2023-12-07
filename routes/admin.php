<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\BookLibraryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ArticleLibraryController;
use App\Http\Controllers\Admin\QuestionLibraryController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\TryItController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\SupporterController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\LessonGroupController;
use App\Http\Controllers\Admin\LessonAccessorController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\DownloaderController;


  
define('PAGINATION_COUNT',10);

Route::group(['middleware'=>'auth:admin'], function(){

        Route::get('/', [DashboardController::class, 'index']) -> name('dashboard');
        
        Route::get('Notification-dashboard',[NotificationController::class, 'index'])-> name('Notification-dashboard');   
        Route::get('Notification-dashboard/old',[NotificationController::class, 'NotificationOld'])-> name('Notification-dashboard.old');   
        Route::get('Notification-dashboard/reply',[NotificationController::class, 'NotificationReply'])-> name('Notification-dashboard.reply');   
        Route::get('Notification-dashboard/not-reply',[NotificationController::class, 'NotificationNotReply'])-> name('Notification-dashboard.not-reply');   
        Route::post('Notification-dashboard/reply.message',[NotificationController::class, 'reply_message'])-> name('reply.message');        
        
        Route::get('Site-dashboard/edit',[SiteController::class, 'edit'])-> name('Site-dashboard.edit');   
        Route::post('Site-dashboard/update',[SiteController::class, 'update'])-> name('Site-dashboard.update');        
        
        ########################### begin Supporter ########################################
            
            Route::post('Supporter-dashboard.edit-value/{id}',[SupporterController::class, 'edit_value'])-> name('Supporter-dashboard.edit-value');
            Route::get('Supporter-dashboard',[SupporterController::class, 'index'])-> name('Supporter-dashboard.index');
 
            Route::post('Supporter-dashboard/verification/{id}',[SupporterController::class, 'verification'])-> name('Supporter-dashboard.verification');
            Route::get('Supporter-dashboard/supporter-archive/{id}',[SupporterController::class, 'supporter_archive'])-> name('Supporter-dashboard.supporter-archive');
        
        ########################### end Supporter ########################################
        
        ########################### begin MainCategory ########################################
            
            Route::resource('MainCategory-dashboard',MainCategoryController::class)->except([
                'create', 'store', 'show', 'destroy'
            ]);
            Route::post('MainCategory-dashboard/status/{id}',[MainCategoryController::class, 'changeStatus'])-> name('MainCategory-dashboard.status');
        
        ########################### end MainCategory ########################################


        ########################### begin SubCategory ########################################
            
            Route::get('SubCategory-dashboard/trashed',[SubCategoryController::class, 'trashed'])-> name('SubCategory-dashboard.trashed');
            Route::post('SubCategory-dashboard/restore/{id}',[SubCategoryController::class, 'restore'])-> name('SubCategory-dashboard.restore');

            
            Route::resource('SubCategory-dashboard',SubCategoryController::class);
            Route::post('SubCategory-dashboard/status/{id}',[SubCategoryController::class, 'changeStatus'])-> name('SubCategory-dashboard.status');

            Route::post('Category-dashboard/move/{id}',[CategoryController::class, 'move'])-> name('Category-dashboard.move');

            Route::get('Category-dashboard/create/{id}', ['as' => 'Category-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\CategoryController@create']);
            
            Route::get('SubCategory-dashboard/older/{id}',[CategoryController::class, 'older'])-> name('SubCategory-dashboard.older');
            Route::get('SubCategory-dashboard/un-active/{id}',[CategoryController::class, 'un_active'])-> name('SubCategory-dashboard.un-active');
            Route::get('SubCategory-dashboard/top-views/{id}',[CategoryController::class, 'top_views'])-> name('SubCategory-dashboard.top-views');
            Route::get('SubCategory-dashboard/top-likes/{id}',[CategoryController::class, 'top_likes'])-> name('SubCategory-dashboard.top-likes');

            Route::resource('Category-dashboard',CategoryController::class)->except([
                'index', 'create'
            ]);
            
            Route::post('Category-dashboard/status/{id}',[CategoryController::class, 'changeStatus'])-> name('Category-dashboard.status');
            Route::get('Category-dashboard/tryit-page/{id}',[CategoryController::class, 'tryit_page'])-> name('Category-dashboard.tryit-page');
            Route::get('Category-dashboard/image-page/{id}',[CategoryController::class, 'image_page'])-> name('Category-dashboard.image-page');
        ########################### end SubCategory ########################################
        
        ########################### begin Course ########################################
        
            Route::resource('Course-dashboard',CourseController::class);
            Route::post('Course-dashboard/status/{id}',[CourseController::class, 'changeStatus'])-> name('Course-dashboard.status');
            Route::get('Course-dashboard/followers/{id}',[CourseController::class, 'followers'])-> name('Course-dashboard.followers');
            Route::get('Course-dashboard.tryit-page/{type?}',[CourseController::class, 'tryit_page'])-> name('Course-dashboard.tryit-page');
            Route::get('Course-dashboard.media-page/{type?}',[CourseController::class, 'media_page'])-> name('Course-dashboard.media-page');
            Route::get('Course-dashboard.downloader-page',[CourseController::class, 'downloader_page'])-> name('Course-dashboard.downloader-page');
        ########################### end Course ########################################

        ########################### begin Plan ########################################
        
            Route::resource('Plan-dashboard',PlanController::class);
            Route::post('Plan-dashboard/status/{id}',[PlanController::class, 'changeStatus'])-> name('Plan-dashboard.status');
            Route::get('Plan-dashboard/create.plan.course/{id}',[PlanController::class, 'create_plan_course'])-> name('Plan-dashboard.create-plan-course');
            Route::post('Plan-dashboard/store.plan.course',[PlanController::class, 'store_plan_course'])-> name('Plan-dashboard.store-plan-course');
            
        ########################### end Plan ########################################
        
       
        ########################### begin User ########################################
            Route::post('User-dashboard/status/{id}',[UserController::class, 'changeStatus'])-> name('User-dashboard.status');

            Route::get('User-dashboard/female',[UserController::class, 'female'])-> name('User-dashboard.female');
            Route::get('User-dashboard/male',[UserController::class, 'male'])-> name('User-dashboard.male');
            Route::get('User-dashboard/top-views',[UserController::class, 'top_views'])-> name('User-dashboard.top-views');
            Route::get('User-dashboard/top-likes',[UserController::class, 'top_likes'])-> name('User-dashboard.top-likes');
            Route::get('User-dashboard/blocked',[UserController::class, 'blocked'])-> name('User-dashboard.blocked');
            Route::get('User-dashboard/front-end',[UserController::class, 'front_end'])-> name('User-dashboard.front-end');
            Route::get('User-dashboard/back-end',[UserController::class, 'back_end'])-> name('User-dashboard.back-end');
            Route::get('User-dashboard/full-stuck',[UserController::class, 'full_stuck'])-> name('User-dashboard.full-stuck');
            Route::get('User-dashboard/programming',[UserController::class, 'programming'])-> name('User-dashboard.programming');

            Route::resource('User-dashboard',UserController::class)->except([
                'edit', 'create', 'store', 'update'
            ]);

        ########################### end User ########################################
        

        ########################### begin Question ########################################
                
            Route::get('QuestionLibrary-dashboard/trashed',[QuestionLibraryController::class, 'trashed'])-> name('QuestionLibrary-dashboard.trashed');
            Route::post('QuestionLibrary-dashboard/restore/{id}',[QuestionLibraryController::class, 'restore'])-> name('QuestionLibrary-dashboard.restore');

            Route::resource('QuestionLibrary-dashboard',QuestionLibraryController::class);
            Route::post('QuestionLibrary-dashboard/status/{id}',[QuestionLibraryController::class, 'changeStatus'])-> name('QuestionLibrary-dashboard.status');
            
            Route::post('QuestionLibrary-dashboard/question-status/{id}',[QuestionLibraryController::class, 'question_status'])-> name('QuestionLibrary-dashboard.question-status');
            Route::DELETE('QuestionLibrary-dashboard/destroy-question/{id}',[QuestionLibraryController::class, 'destroy_question'])-> name('QuestionLibrary-dashboard.destroy-question');

            Route::get('QuestionLibrary-dashboard/older/{id}',[QuestionLibraryController::class, 'older'])-> name('QuestionLibrary-dashboard.older');
            Route::get('QuestionLibrary-dashboard/un-active/{id}',[QuestionLibraryController::class, 'un_active'])-> name('QuestionLibrary-dashboard.un-active');
            Route::get('QuestionLibrary-dashboard/top-views/{id}',[QuestionLibraryController::class, 'top_views'])-> name('QuestionLibrary-dashboard.top-views');
            Route::get('QuestionLibrary-dashboard/top-likes/{id}',[QuestionLibraryController::class, 'top_likes'])-> name('QuestionLibrary-dashboard.top-likes');
            Route::get('QuestionLibrary-dashboard/top-comments/{id}',[QuestionLibraryController::class, 'top_comments'])-> name('QuestionLibrary-dashboard.top-comments');

        ########################### end Question ########################################
        
        ########################### begin Article ########################################

            Route::get('ArticleLibrary-dashboard/trashed',[ArticleLibraryController::class, 'trashed'])-> name('ArticleLibrary-dashboard.trashed');
            Route::post('ArticleLibrary-dashboard/restore/{id}',[ArticleLibraryController::class, 'restore'])-> name('ArticleLibrary-dashboard.restore');
            
            Route::resource('ArticleLibrary-dashboard',ArticleLibraryController::class);
            Route::post('ArticleLibrary-dashboard/status/{id}',[ArticleLibraryController::class, 'changeStatus'])-> name('ArticleLibrary-dashboard.status');
            
            Route::post('Article-dashboard/move/{id}',[ArticleController::class, 'move'])-> name('Article-dashboard.move');

            Route::get('Article-dashboard/create/{id}', ['as' => 'Article-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\ArticleController@create']);
            
            Route::get('ArticleLibrary-dashboard/older/{id}',[ArticleController::class, 'older'])-> name('ArticleLibrary-dashboard.older');
            Route::get('ArticleLibrary-dashboard/un-active/{id}',[ArticleController::class, 'un_active'])-> name('ArticleLibrary-dashboard.un-active');
            Route::get('ArticleLibrary-dashboard/top-views/{id}',[ArticleController::class, 'top_views'])-> name('ArticleLibrary-dashboard.top-views');
            Route::get('ArticleLibrary-dashboard/top-likes/{id}',[ArticleController::class, 'top_likes'])-> name('ArticleLibrary-dashboard.top-likes');

            Route::resource('Article-dashboard',ArticleController::class)->except([
                'index', 'create'
            ]);
            
            Route::post('Article-dashboard/status/{id}',[ArticleController::class, 'changeStatus'])-> name('Article-dashboard.status');
            Route::get('Article-dashboard/tryit-page/{id}',[ArticleController::class, 'tryit_page'])-> name('Article-dashboard.tryit-page');
            Route::get('Article-dashboard/image-page/{id}',[ArticleController::class, 'image_page'])-> name('Article-dashboard.image-page');
            ########################### end Article ########################################
            
            
            ########################### begin Book ########################################
            
            Route::get('BookLibrary-dashboard/trashed',[BookLibraryController::class, 'trashed'])-> name('BookLibrary-dashboard.trashed');
            Route::post('BookLibrary-dashboard/restore/{id}',[BookLibraryController::class, 'restore'])-> name('BookLibrary-dashboard.restore');

            Route::resource('BookLibrary-dashboard',BookLibraryController::class);
            Route::post('BookLibrary-dashboard/status/{id}',[BookLibraryController::class, 'changeStatus'])-> name('BookLibrary-dashboard.status');
            
            Route::post('Book-dashboard/move/{id}',[BookController::class, 'move'])-> name('Book-dashboard.move');

            Route::get('Book-dashboard/create/{id}', ['as' => 'Book-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\BookController@create']);
            
            Route::get('BookLibrary-dashboard/older/{id}',[BookController::class, 'older'])-> name('BookLibrary-dashboard.older');
            Route::get('BookLibrary-dashboard/un-active/{id}',[BookController::class, 'un_active'])-> name('BookLibrary-dashboard.un-active');
            Route::get('BookLibrary-dashboard/top-downloads/{id}',[BookController::class, 'top_downloads'])-> name('BookLibrary-dashboard.top-downloads');
            Route::get('BookLibrary-dashboard/top-likes/{id}',[BookController::class, 'top_likes'])-> name('BookLibrary-dashboard.top-likes');

            Route::resource('Book-dashboard',BookController::class)->except([
                'index', 'create'
            ]);
            
            Route::post('Book-dashboard/status/{id}',[BookController::class, 'changeStatus'])-> name('Book-dashboard.status');

        ########################### end Book ########################################

        ########################### begin Lesson ########################################



        Route::get('Lesson-dashboard/accessors/{id}',[LessonController::class, 'accessors'])-> name('Lesson-dashboard.accessors');
        Route::get('Lesson-dashboard/trashed/{id}',[LessonController::class, 'trashed'])-> name('Lesson-dashboard.trashed');
        Route::post('Lesson-dashboard/restore/{id}',[LessonController::class, 'restore'])-> name('Lesson-dashboard.restore');
        Route::post('Lesson-dashboard/move/{id}',[LessonController::class, 'move'])-> name('Lesson-dashboard.move');
        Route::get('Lesson-dashboard/create/{id}', ['as' => 'Lesson-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\LessonController@create']);
        Route::post('Lesson-dashboard/status/{id}',[LessonController::class, 'changeStatus'])-> name('Lesson-dashboard.status');
        Route::get('Lesson-dashboard/tryit-page/{id}',[LessonController::class, 'tryit_page'])-> name('Lesson-dashboard.tryit-page');
        Route::get('Lesson-dashboard/image-page/{id}',[LessonController::class, 'image_page'])-> name('Lesson-dashboard.image-page');
        Route::resource('Lesson-dashboard',LessonController::class)->except([
            'index', 'create'
        ]);
        
        
        Route::get('LessonGroup-dashboard/older/{id}',[LessonController::class, 'older'])-> name('LessonGroup-dashboard.older');
        Route::get('LessonGroup-dashboard/un-active/{id}',[LessonController::class, 'un_active'])-> name('LessonGroup-dashboard.un-active');
        Route::get('LessonGroup-dashboard/top-views/{id}',[LessonController::class, 'top_views'])-> name('LessonGroup-dashboard.top-views');
        Route::get('LessonGroup-dashboard/top-likes/{id}',[LessonController::class, 'top_likes'])-> name('LessonGroup-dashboard.top-likes');
        
        
        Route::get('LessonAccessor-dashboard/create/{id}', ['as' => 'LessonAccessor-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\LessonAccessorController@create']);
        Route::post('LessonAccessor-dashboard/status/{id}',[LessonAccessorController::class, 'changeStatus'])-> name('LessonAccessor-dashboard.status');
        Route::get('LessonAccessor-dashboard/trashed/{id}',[LessonAccessorController::class, 'trashed'])-> name('LessonAccessor-dashboard.trashed');
        Route::get('Lesson-dashboard/older/{id}',[LessonAccessorController::class, 'older'])-> name('Lesson-dashboard.older');
        Route::get('Lesson-dashboard/un-active/{id}',[LessonAccessorController::class, 'un_active'])-> name('Lesson-dashboard.un-active');
        Route::get('Lesson-dashboard/top-views/{id}',[LessonAccessorController::class, 'top_views'])-> name('Lesson-dashboard.top-views');
        Route::get('Lesson-dashboard/top-likes/{id}',[LessonAccessorController::class, 'top_likes'])-> name('Lesson-dashboard.top-likes');
        Route::resource('LessonAccessor-dashboard',LessonAccessorController::class)->except([
            'index', 'create', 'destroy', 'show'
        ]);


        Route::get('LessonGroup-dashboard/create/{id}', ['as' => 'LessonGroup-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\LessonGroupController@create']);
        Route::resource('LessonGroup-dashboard',LessonGroupController::class)->except([
            'index', 'create'
        ]);
        Route::post('LessonGroup-dashboard/status/{id}',[LessonGroupController::class, 'changeStatus'])-> name('LessonGroup-dashboard.status');



        /*
        اذا واجهت مشكلة في تداخل الراوتات اتبع الترتيب التالي
            Route::get('Lesson-dashboard/trashed/{id}',[LessonController::class, 'trashed'])-> name('Lesson-dashboard.trashed');
            Route::post('Lesson-dashboard/restore/{id}',[LessonController::class, 'restore'])-> name('Lesson-dashboard.restore');

            Route::post('Lesson-dashboard/move/{id}',[LessonController::class, 'move'])-> name('Lesson-dashboard.move');

            Route::get('Lesson-dashboard/create/{id}', ['as' => 'Lesson-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\LessonController@create']);
            
            Route::get('LessonGroup-dashboard/older/{id}',[LessonController::class, 'older'])-> name('LessonGroup-dashboard.older');
            Route::get('LessonGroup-dashboard/un-active/{id}',[LessonController::class, 'un_active'])-> name('LessonGroup-dashboard.un-active');
            Route::get('LessonGroup-dashboard/top-views/{id}',[LessonController::class, 'top_views'])-> name('LessonGroup-dashboard.top-views');
            Route::get('LessonGroup-dashboard/top-likes/{id}',[LessonController::class, 'top_likes'])-> name('LessonGroup-dashboard.top-likes');

            Route::resource('Lesson-dashboard',LessonController::class)->except([
                'index', 'create'
            ]);
            
            
            Route::get('LessonGroup-dashboard/create/{id}', ['as' => 'LessonGroup-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\LessonGroupController@create']);
            Route::resource('LessonGroup-dashboard',LessonGroupController::class)->except([
                'index', 'create'
            ]);
            
            Route::post('Lesson-dashboard/status/{id}',[LessonController::class, 'changeStatus'])-> name('Lesson-dashboard.status');
            Route::post('LessonGroup-dashboard/status/{id}',[LessonGroupController::class, 'changeStatus'])-> name('LessonGroup-dashboard.status');
             

            
            Route::get('Lesson-dashboard/tryit-page/{id}',[LessonController::class, 'tryit_page'])-> name('Lesson-dashboard.tryit-page');
            Route::get('Lesson-dashboard/image-page/{id}',[LessonController::class, 'image_page'])-> name('Lesson-dashboard.image-page');
*/
        ########################### end Lesson ########################################
        
        ########################### begin Tryit ########################################
            Route::get('Tryit-dashboard/create/{id?}/{type?}', ['as' => 'Tryit-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\TryItController@create']);

            Route::resource('Tryit-dashboard',TryItController::class)->except([
                'index','show', 'create'
            ]);
        ########################### end Tryit ########################################
        
        ########################### begin Media ########################################
            Route::get('Media-dashboard/create', ['as' => 'Media-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\MediaController@create']);

            Route::resource('Media-dashboard',MediaController::class)->except([
                'index','show', 'create'
            ]);
        ########################### end Media ########################################
        
        ########################### begin Downloader ########################################
            Route::get('Downloader-dashboard/create', ['as' => 'Downloader-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\DownloaderController@create']);

            Route::resource('Downloader-dashboard',DownloaderController::class)->except([
                'index','show', 'create'
            ]);
        ########################### end Downloader ########################################
        
        ########################### begin Image ########################################
            Route::get('Image-dashboard/create/{id}/{type}', ['as' => 'Image-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\ImageController@create']);

            Route::resource('Image-dashboard',ImageController::class)->except([
                'index','show', 'create'
            ]);
        ########################### end Image ########################################
        ########################### begin Exam ########################################

            Route::get('Exam-dashboard/create/{lesson_id}', ['as' => 'Exam-dashboard.create', 'uses' => 'App\Http\Controllers\Admin\ExamController@create']);
            
            Route::resource('Exam-dashboard',ExamController::class)->except([
                'index', 'create'
            ]);

            Route::post('Exam-dashboard/store-question/{lesson_id}',[ExamController::class, 'store_question'])-> name('Exam-dashboard.store-question');

            Route::post('Exam-dashboard/status-exam/{lesson_id}',[ExamController::class, 'changeStatus_exam'])-> name('Exam-dashboard.status-exam');
            
            Route::DELETE('Exam-dashboard/destroy-exam/{lesson_id}',[ExamController::class, 'destroy_exam'])-> name('Exam-dashboard.destroy-exam');

        ########################### end Exam ########################################
        
        Route::get('Logout', [LogoutController::class, 'perform'])->name('admin.logout');
});
Route::group(['middleware'=>'guest:admin'], function(){

    Route::get('login',[LoginController::class,'showAdminLogin'])->name('get.admin.login');
    Route::post('login',[LoginController::class,'login'])->name('admin.login');

});
    