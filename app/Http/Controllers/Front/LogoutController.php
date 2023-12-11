<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified'])->except('wrongEmail');
         
    }

    public function perform()
    {
        Session::flush();

        Auth::logout();

        return redirect()-> route('Course.index');
    }

    public function wrongEmail()
    {
       $data = Auth::user();
       
        Session::flush();

        Auth::logout();

        return redirect()-> route('register')->withInput(['name' => $data->name,'email' => $data->email,'description' => $data->description]);
    }
}
