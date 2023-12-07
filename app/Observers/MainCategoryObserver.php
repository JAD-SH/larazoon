<?php

namespace App\Observers;

use App\Models\MainCategory;

class MainCategoryObserver
{
    /**
     * Handle the MainCategory "created" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function created(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the MainCategory "updated" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function updated(MainCategory $mainCategory)
    {
        if($mainCategory ->route == 'Course'){
            $mainCategory ->courses() -> update(['active' => $mainCategory -> active]);
            
        }elseif($mainCategory ->route == 'Article'){
            $mainCategory ->articlelibraries() -> update(['active' => $mainCategory -> active]);
            
        }elseif($mainCategory ->route == 'Book'){
            $mainCategory ->booklibraries() -> update(['active' => $mainCategory -> active]);
            
        }elseif($mainCategory ->route == 'Question'){
            $mainCategory ->questionlibraries() -> update(['active' => $mainCategory -> active]);

        }
    }

    /**
     * Handle the MainCategory "deleted" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function deleted(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the MainCategory "restored" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function restored(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the MainCategory "force deleted" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function forceDeleted(MainCategory $mainCategory)
    {
        //
    }
}
