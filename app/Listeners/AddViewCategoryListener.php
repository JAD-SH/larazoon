<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddViewCategoryEvent;

class AddViewCategoryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AddViewCategoryEvent $request)
    {
        if(! session()->has('category'.$request-> category->id.'IsVisited'))//جديد
            $this -> updateviews($request -> category);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateviews($category){
        $category -> views = $category -> views +1;
        $category ->save();
        session()->put('category'.$category->id.'IsVisited', $category->id);//جديد
    }
}
