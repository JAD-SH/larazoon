<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddLikeCommentEvent;

class AddLikeCommentListener
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
    public function handle(AddLikeCommentEvent $request)
    {
        if(! session()->has('comment'.$request-> comment->id.'IsLiked')){//جديد
            $this -> updateLikes($request -> comment);/* هذه المتغير القادم من ال Events*/
            session()->forget('comment'.$request-> comment->id.'IsDisLiked');
        }else return false;//جديد
    }
    public function updateLikes($comment){
        $comment -> likes = $comment -> likes +1;
        $comment ->save();
        session()->put('comment'.$comment->id.'IsLiked', $comment->id);//جديد
    }
}
