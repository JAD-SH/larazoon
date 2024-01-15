<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Http\Requests\admin\SiteRequest;

class SiteController extends Controller
{
    
    

    public function edit()
    {
        return view('admin.site_edit'); 
    }

    public function update(SiteRequest $request)
    {
       try{
        $site = Site::first();
            if(!$site){
                return redirect()->route('dashboard')
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل لم يتم إضافة بيانات للموقع بعد لتتمكن من التعديل عليها'
                ]);
            }

            if($request->has('site_photo')){
                $SitePhotoPath=uploadFile($request->site_photo,'images/site');
                $site ->update([
                    'site_photo'=>$SitePhotoPath,
                ]);
            }
            if($request->has('site_logo')){
                $SitelogoPath=uploadFile($request->site_logo,'images/site');
                $site ->update([
                    'site_logo'=>$SitelogoPath,
                ]);
            }
            /*if($request->has('site_sm_logo')){
                $SiteSmLogoPath=uploadFile($request->site_sm_logo,'images/site');
                $site ->update([
                    'site_sm_logo'=>$SiteSmLogoPath,
                ]);
            }*/
            if($request->has('user_profile_background')){
                $UserProfileBackgroundPath=uploadFile($request->user_profile_background,'images/site');
                $site ->update([
                    'user_profile_background'=>$UserProfileBackgroundPath,
                ]);
            }

            $site ->update([
                'site_name'=>$request->site_name,
                'ar_site_name'=>$request->ar_site_name,
                'site_description'=>$request->site_description,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'instagram'=>$request->instagram,
                'github'=>$request->github,
            ]);
            return redirect()-> route('dashboard')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث القسم ','notifyMsg' => 'تم تحديث بيانات الموقع بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('dashboard')
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث بيانات الموقع لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }



}
