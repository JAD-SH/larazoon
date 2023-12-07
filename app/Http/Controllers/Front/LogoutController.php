<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
         
    }

    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect()-> route('Course.index');
    }
}
