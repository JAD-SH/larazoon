<?php

namespace App\Observers;

use App\Models\QuestionLibrary;

class QuestionLibraryObserver
{
    /**
     * Handle the QuestionLibrary "created" event.
     *
     * @param  \App\Models\QuestionLibrary  $questionLibrary
     * @return void
     */
    public function created(QuestionLibrary $questionLibrary)
    {
        //
    }

    /**
     * Handle the QuestionLibrary "updated" event.
     *
     * @param  \App\Models\QuestionLibrary  $questionLibrary
     * @return void
     */
    public function updated(QuestionLibrary $questionLibrary)
    {
        $questionLibrary -> questions() -> update(['active' => $questionLibrary -> active]);
    }

    /**
     * Handle the QuestionLibrary "deleted" event.
     *
     * @param  \App\Models\QuestionLibrary  $questionLibrary
     * @return void
     */
    public function deleted(QuestionLibrary $questionLibrary)
    {
        //
    }

    /**
     * Handle the QuestionLibrary "restored" event.
     *
     * @param  \App\Models\QuestionLibrary  $questionLibrary
     * @return void
     */
    public function restored(QuestionLibrary $questionLibrary)
    {
        //
    }

    /**
     * Handle the QuestionLibrary "force deleted" event.
     *
     * @param  \App\Models\QuestionLibrary  $questionLibrary
     * @return void
     */
    public function forceDeleted(QuestionLibrary $questionLibrary)
    {
        //
    }
}
