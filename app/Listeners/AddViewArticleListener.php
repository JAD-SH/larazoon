<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use App\Events\AddViewArticleEvent;

class AddViewArticleListener
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
    public function handle(AddViewArticleEvent $request)
    {
        if(! session()->has('article'.$request-> article->id.'IsVisited'))//جديد
            $this -> updateviews($request -> article);/* هذه المتغير القادم من ال Events*/
        else return false;//جديد
    }
    public function updateviews($article){
        $article -> views = $article -> views +1;
        $article ->save();
        if (Auth::user()) {   
                Auth::user() -> read_article = Auth::user() -> read_article +1;
                Auth::user() -> save();
        }
        session()->put('article'.$article->id.'IsVisited', $article->id);//جديد
    }
}
