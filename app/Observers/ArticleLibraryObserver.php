<?php

namespace App\Observers;

use App\Models\ArticleLibrary;

class ArticleLibraryObserver
{
    /**
     * Handle the ArticleLibrary "created" event.
     *
     * @param  \App\Models\ArticleLibrary  $articleLibrary
     * @return void
     */
    public function created(ArticleLibrary $articleLibrary)
    {
        //
    }

    /**
     * Handle the ArticleLibrary "updated" event.
     *
     * @param  \App\Models\ArticleLibrary  $articleLibrary
     * @return void
     */
    public function updated(ArticleLibrary $articleLibrary)
    {
        $articleLibrary -> articles() -> update(['active' => $articleLibrary -> active]);
    }

    /**
     * Handle the ArticleLibrary "deleted" event.
     *
     * @param  \App\Models\ArticleLibrary  $articleLibrary
     * @return void
     */
    public function deleted(ArticleLibrary $articleLibrary)
    {
        //
    }

    /**
     * Handle the ArticleLibrary "restored" event.
     *
     * @param  \App\Models\ArticleLibrary  $articleLibrary
     * @return void
     */
    public function restored(ArticleLibrary $articleLibrary)
    {
        //
    }

    /**
     * Handle the ArticleLibrary "force deleted" event.
     *
     * @param  \App\Models\ArticleLibrary  $articleLibrary
     * @return void
     */
    public function forceDeleted(ArticleLibrary $articleLibrary)
    {
        //
    }
}
