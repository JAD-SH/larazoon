<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddDisLikeCommentEvent;

class AddDisLikeCommentListener 
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
    public function handle(AddDisLikeCommentEvent $request)
    {
        if(! session()->has('comment'.$request-> comment->id.'IsDisLiked')){//جديد
            $this -> updateLikes($request -> comment);/* هذه المتغير القادم من ال Events*/
            session()->forget('comment'.$request-> comment->id.'IsLiked');
        }else return false;//جديد
    }
    public function updateLikes($comment){
        $comment -> likes = $comment -> likes -1;
        $comment ->save();
        session()->put('comment'.$comment->id.'IsDisLiked', $comment->id);//جديد
    }
}
