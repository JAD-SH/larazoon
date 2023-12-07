<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddViewUserEvent;

class AddViewUserListener
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
    public function handle(AddViewUserEvent $request)
    {
        if(! session()->has('user'.$request-> user->id.'IsVisited'))//جديد
            $this -> updateviews($request -> user);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateviews($user){
        $user -> views = $user -> views +1;
        $user ->save();
        session()->put('user'.$user->id.'IsVisited', $user->id);//جديد
    }
}
