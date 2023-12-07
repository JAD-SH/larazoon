<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\MediaRequest;
use App\Models\Media;

class MediaController extends Controller
{
    
    
    
     
    public function create()
    {
        return view('admin.media.create');
    }
    public function store(MediaRequest $request)
    {
        try{
            $mediaType = explode('/',$request->media->getClientMimeType())[1] ;
            $filename = $request->media->storeAs('', $request->slug.'.'.$mediaType,'media');

            //$mediaPath = uploadFile($request->media,'media');
            $type = $request->media->getClientMimeType();

            Media::create([
                'slug' => $request->slug,
                'type' => $type,
                'media' => 'media/'.$filename,
            ]);
           
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء Media جديد',
                'notifyMsg' => 'تم انشاء Media بنجاح '
            ]);
           
        }catch (\Exception $ex){
            return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء Media  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
            
    }

}
