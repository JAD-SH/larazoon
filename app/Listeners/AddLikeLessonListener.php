<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use App\Events\AddLikeLessonEvent;

class AddLikeLessonListener
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
    public function handle(AddLikeLessonEvent $request)
    {
        if(! session()->has('lesson'.$request-> lesson->id.'IsLiked')){
            
            $this -> updateLikes($request -> lesson);/* هذه المتغير القادم من ال Events*/
        }
        else return false;
    }
    public function updateLikes($lesson){
        $lesson -> likes = $lesson -> likes +1;
        $lesson ->save();
        if (Auth::user()) {   
            //هذا يجب تطويره في Event منفصل
                Auth::user() -> lesson_assessment = Auth::user() -> lesson_assessment +1;
                Auth::user() -> save();
        }
        session()->put('lesson'.$lesson->id.'IsLiked', $lesson->id);
    }
}
