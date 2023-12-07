<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AddLikeArticleEvent;

class AddLikeArticleListener
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
    public function handle(AddLikeArticleEvent $request)
    {
        if(! session()->has('article'.$request-> article->id.'IsLiked'))//جديد
            $this -> updateLikes($request -> article);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateLikes($article){
        $article -> likes = $article -> likes +1;
        $article ->save();
        session()->put('article'.$article->id.'IsLiked', $article->id);//جديد
    }
}
