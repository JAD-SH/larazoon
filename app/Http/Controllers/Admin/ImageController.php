<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Requests\admin\ImageRequest;
use App\Models\Imageable;

class ImageController extends Controller
{
     
    public function create($imageable_id,$imageable_type)
    {
        return view('admin.image.create',compact('imageable_id','imageable_type'));
    }
    public function store(ImageRequest $request)
    {
        try{
 
            $mediaType = explode('/',$request->image->getClientMimeType())[1] ;
            $filename = $request->image->storeAs('', $request->slug.'.'.$mediaType, 'images/images');
             
            $image = Image::create([
                'slug' => $request->slug,
                'image' => 'images/images/'. $filename,
            ]);
            
            Imageable::create([
                'image_id' => $image->id,
                'imageable_type' => "App\\Models\\".$request->imageable_type,
                'imageable_id' => $request->imageable_id,
            ]);

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء صورة جديدة',
                'notifyMsg' => 'تم انشاء صورة بنجاح '
            ]);
           
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء الصورة لسبب ما يرجى المحاولة لاحقا '
             ]);
        }
     }  
}
