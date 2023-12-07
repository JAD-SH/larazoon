<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddLikeUserEvent;

class AddLikeUserListener
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
    public function handle(AddLikeUserEvent $request)
    {
        if(! session()->has('user'.$request-> user->id.'IsLiked'))//جديد
            $this -> updateLikes($request -> user);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateLikes($user){
        $user -> likes = $user -> likes +1;
        $user ->save();
        session()->put('user'.$user->id.'IsLiked', $user->id);//جديد
    }
}
