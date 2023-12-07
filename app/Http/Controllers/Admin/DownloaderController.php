<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\DownloaderRequest;
use App\Models\Downloader;

class DownloaderController extends Controller
{
    
    
    
     
    public function create()
    {
        return view('admin.downloader.create');
    }
    public function store(DownloaderRequest $request)
    {
        try{
             
            $downloaderPath = uploadFile($request->file,'downloader');
            $title = $request->file->getClientOriginalName();

            Downloader::create([
                'title' => $title,
                'slug' => $request->slug,
                'description' => $request->description,
                'file' => $downloaderPath,
            ]);
           
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء Downloader جديد',
                'notifyMsg' => 'تم انشاء Downloader بنجاح '
            ]);
           
        }catch (\Exception $ex){
            return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء Downloader  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
            
    }

}
