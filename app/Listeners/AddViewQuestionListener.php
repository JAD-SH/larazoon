<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddViewQuestionEvent;

class AddViewQuestionListener
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
    public function handle(AddViewQuestionEvent $request)
    {
        if(! session()->has('question'.$request-> question->id.'IsVisited'))//جديد
            $this -> updateviews($request -> question);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateviews($question){
        $question -> views = $question -> views +1;
        $question ->save();
        session()->put('question'.$question->id.'IsVisited', $question->id);//جديد
    }
}
