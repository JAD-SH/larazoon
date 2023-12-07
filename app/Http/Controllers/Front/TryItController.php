<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryItCode;

class TryItController extends Controller
{
    public function tryit_page($slug)
    {
        $tryit = TryItCode::where('slug',$slug)->selection()->first();
        if(!$tryit){
            return redirect()->back() -> with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الكود  غير موجود او ربما يكون محذوف  '
            ]);
        }
        return view('front.tryit',compact('tryit'));
    } 
}
