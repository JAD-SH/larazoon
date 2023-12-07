<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddViewLessonEvent;

class AddViewLessonListener
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
    public function handle(AddViewLessonEvent $request)
    {
        if(! session()->has('lesson'.$request-> lesson->id.'IsVisited'))//جديد
            $this -> updateviews($request -> lesson);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateviews($lesson){
        $lesson -> views = $lesson -> views +1;
        $lesson ->save();
        session()->put('lesson'.$lesson->id.'IsVisited', $lesson->id);//جديد
    }
}
