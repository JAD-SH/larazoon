<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryItCode;
use App\Http\Requests\admin\TryitRequest;
use App\Models\Tryitable;

class TryItController extends Controller
{

    
     
    public function create($tryitable_id=null,$tryitable_type=null)
    {
        return view('admin.tryit.create',compact('tryitable_id','tryitable_type'));
    }
    public function store(TryitRequest $request)
    {
        try{
             
             $tryitcode = TryItCode::create([
                'slug' => $request->slug,
                'code' => $request->code,
                'type' => $request->type,
                'code1' => $request->code1,
                'type1' => $request->type1,
                'code2' => $request->code2,
                'type2' => $request->type2,
            ]);
            if($request->tryitable_id !== null && $request->tryitable_type !== null){
                Tryitable::create([
                    'try_it_code_id' => $tryitcode->id,
                    'tryitable_type' => "App\\Models\\".$request->tryitable_type,
                    'tryitable_id' => $request->tryitable_id,
                ]);
            }

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء TryIt جديد',
                'notifyMsg' => 'تم انشاء TryIt بنجاح '
            ]);
           
        }catch (\Exception $ex){
            return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء TryIt  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
            
            
        
    }
    public function edit($id)
    {
        $tryit = TryItCode::selection()->find($id);
        if(!$tryit){
            return redirect()->back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'TryIt هذه غير موجودة '
            ]);
        }
        return view('admin.tryit.edit', compact('tryit')); 
    }
 
    public function update(TryitRequest $request, $id)
    {
        //return $request;
        try{
            $tryit = TryItCode::find($id);
            if(!$tryit){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'TryIt هذه غير موجودة '
                ]);
                
            }
 
            $tryit ->update([
                'code' => $request->code,
                'type' => $request->type,
                'code1' => $request->code1,
                'type1' => $request->type1,
                'code2' => $request->code2,
                'type2' => $request->type2,
            ]);
            return redirect()->back()
            ->with([
                'notifyType' => 'successToast','notifyTitle' => ' التعديل على TryIt ','notifyMsg' => 'تم التعديل على TryIt بنجاح '
            ]);
        }catch (\Exception $ex){
            return $ex;
            return redirect()-> back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث TryIt لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
 
}
