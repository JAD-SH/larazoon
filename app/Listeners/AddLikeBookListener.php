<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddLikeBookEvent;

class AddLikeBookListener
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
    public function handle(AddLikeBookEvent $request)
    {
        if(! session()->has('book'.$request-> book->id.'IsLiked'))//جديد
            $this -> updateLikes($request -> book);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateLikes($book){
        $book -> likes = $book -> likes +1;
        $book ->save();
        session()->put('book'.$book->id.'IsLiked', $book->id);//جديد
    }
}
