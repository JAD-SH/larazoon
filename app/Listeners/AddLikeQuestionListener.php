<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddLikeQuestionEvent;

class AddLikeQuestionListener
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
    public function handle(AddLikeQuestionEvent $request)
    {
        if(! session()->has('question'.$request-> question->id.'IsLiked'))//جديد
            $this -> updateLikes($request -> question);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateLikes($question){
        $question -> likes = $question -> likes +1;
        $question ->save();
        session()->put('question'.$question->id.'IsLiked', $question->id);//جديد
    }
}
