<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\AddViewQuestionEvent;
use App\Listeners\AddViewQuestionListener;
use App\Events\AddLikeQuestionEvent;
use App\Listeners\AddLikeQuestionListener;
use App\Events\AddViewArticleEvent;
use App\Listeners\AddViewArticleListener;
use App\Events\AddLikeArticleEvent;
use App\Listeners\AddLikeArticleListener;
use App\Events\AddViewBookEvent;
use App\Listeners\AddViewBookListener;
use App\Events\AddLikeBookEvent;
use App\Listeners\AddLikeBookListener;
use App\Events\AddViewLessonEvent;
use App\Listeners\AddViewLessonListener;
use App\Events\AddLikeLessonEvent;
use App\Listeners\AddLikeLessonListener;
use App\Events\AddLikeCommentEvent;
use App\Listeners\AddLikeCommentListener;
use App\Events\AddDisLikeCommentEvent;
use App\Listeners\AddDisLikeCommentListener;
use App\Events\AddLikeUserEvent;
use App\Listeners\AddLikeUserListener;
use App\Events\AddViewUserEvent;
use App\Listeners\AddViewUserListener;
use App\Events\AddLikeCategoryEvent;
use App\Listeners\AddLikeCategoryListener;
use App\Events\AddViewCategoryEvent;
use App\Listeners\AddViewCategoryListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AddViewQuestionEvent::class => [
            AddViewQuestionListener::class,
        ],
        AddLikeQuestionEvent::class => [
            AddLikeQuestionListener::class,
        ],
        AddViewArticleEvent::class => [
            AddViewArticleListener::class,
        ],
        AddLikeArticleEvent::class => [
            AddLikeArticleListener::class,
        ],
        AddViewBookEvent::class => [
            AddViewBookListener::class,
        ],
        AddLikeBookEvent::class => [
            AddLikeBookListener::class,
        ],
        AddViewLessonEvent::class => [
            AddViewLessonListener::class,
        ],
        AddLikeLessonEvent::class => [
            AddLikeLessonListener::class,
        ],
        AddLikeCommentEvent::class => [
            AddLikeCommentListener::class,
        ],
        AddDisLikeCommentEvent::class => [
            AddDisLikeCommentListener::class,
        ],
        AddLikeUserEvent::class => [
            AddLikeUserListener::class,
        ],
        AddViewUserEvent::class => [
            AddViewUserListener::class,
        ],
        AddLikeCategoryEvent::class => [
            AddLikeCategoryListener::class,
        ],
        AddViewCategoryEvent::class => [
            AddViewCategoryListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
