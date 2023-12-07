<?php

namespace App\Observers;

use App\Models\BookLibrary;

class BookLibraryObserver
{
    /**
     * Handle the BookLibrary "created" event.
     *
     * @param  \App\Models\BookLibrary  $bookLibrary
     * @return void
     */
    public function created(BookLibrary $bookLibrary)
    {
        //
    }

    /**
     * Handle the BookLibrary "updated" event.
     *
     * @param  \App\Models\BookLibrary  $bookLibrary
     * @return void
     */
    public function updated(BookLibrary $bookLibrary)
    {
        $bookLibrary -> books() -> update(['active' => $bookLibrary -> active]);
    }

    /**
     * Handle the BookLibrary "deleted" event.
     *
     * @param  \App\Models\BookLibrary  $bookLibrary
     * @return void
     */
    public function deleted(BookLibrary $bookLibrary)
    {
        //
    }

    /**
     * Handle the BookLibrary "restored" event.
     *
     * @param  \App\Models\BookLibrary  $bookLibrary
     * @return void
     */
    public function restored(BookLibrary $bookLibrary)
    {
        //
    }

    /**
     * Handle the BookLibrary "force deleted" event.
     *
     * @param  \App\Models\BookLibrary  $bookLibrary
     * @return void
     */
    public function forceDeleted(BookLibrary $bookLibrary)
    {
        //
    }
}
