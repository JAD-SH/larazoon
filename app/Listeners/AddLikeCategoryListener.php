<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use App\Events\AddLikeCategoryEvent;

class AddLikeCategoryListener
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
    public function handle(AddLikeCategoryEvent $request)
    {
        if(! session()->has('category'.$request-> category->id.'IsLiked')){
            
            $this -> updateLikes($request -> category);/* هذه المتغير القادم من ال Events*/
        }
        else return false;
    }
    public function updateLikes($category){
        $category -> likes = $category -> likes +1;
        $category ->save();
        session()->put('category'.$category->id.'IsLiked', $category->id);
    }
}
