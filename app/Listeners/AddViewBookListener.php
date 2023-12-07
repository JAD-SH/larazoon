<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddViewBookEvent;

class AddViewBookListener
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
    public function handle(AddViewBookEvent $request)
    {
        if(! session()->has('book'.$request-> book->id.'IsVisited'))//جديد
            $this -> updateviews($request -> book);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateviews($book){
        $book -> views = $book -> views +1;
        $book ->save();
        session()->put('book'.$book->id.'IsVisited', $book->id);//جديد
    }
}
