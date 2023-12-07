<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Http\Requests\admin\MainCategoryRequest;
use Illuminate\Support\Str;
use Session;

class MainCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-maincategories-section');
            return $next($request);
        });
    }



    protected function categories(){
        return $array=[
            [
                'light_photo'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
                'dark_photo'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
                'icon'=>'fa-solid fa-chalkboard-user','slug'=>'Course',
                'color'=>'primary','active'=>'1','title'=>'كورسات','route'=>'Course',
                'description'=>'هنا وصف عن القسم'
            ],
            [
                'light_photo'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
                'dark_photo'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
                'icon'=>'fa-solid fa-newspaper','slug'=>'Article',
                'color'=>'warning','active'=>'1','title'=>'مقالات','route'=>'Article',
                'description'=>'هنا وصف عن القسم'
            ],
            [
                'light_photo'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
                'dark_photo'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
                'icon'=>'fa-sharp fa-solid fa-book','slug'=>'Book',
                'color'=>'success','active'=>'1','title'=>'الكتب','route'=>'Book',
                'description'=>'هنا وصف عن القسم'
            ],
            [
                'light_photo'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
                'dark_photo'=>'images/site/yoGHvAu4k1wYpyZ5uUG0zTTK6VWeq14x2dd3ZuyB.jpg',
                'icon'=>'fa-solid fa-clipboard-question','slug'=>'Question',
                'color'=>'info','active'=>'1','title'=>'اسئلة','route'=>'Question',
                'description'=>'هنا وصف عن القسم'
            ],
        ];
    }

    public function index()
    {
        /*
        $zxzx =MainCategory::first();
         return $zxzx->courses;
*/

        if(MainCategory::count() == 0){
            foreach($this->categories() as $category){
                MainCategory::create([
                    'title'=> $category['title'],
                    'route'=> $category['route'],
                    'color'=> $category['color'],
                    'active'=> $category['active'],
                    'description'=> $category['description'],
                    'light_photo' => $category['light_photo'],
                    'dark_photo' => $category['dark_photo'],
                    'icon' => $category['icon'],
                    'slug' => $category['slug'],
                ]);
            }
        }
        $maincategories = MainCategory::selection()->paginate(PAGINATION_COUNT);
        return view('admin.maincategory.index',compact('maincategories'));
    }

    public function edit($id)
    {
        //return 'amjad';
        $maincategory = MainCategory::selection()->find($id);
        if(!$maincategory){
            return redirect()->route('MainCategory-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا القسم غير موجود    '
            ]);
        }
        return view('admin.maincategory.edit', compact('maincategory')); 
    }

    public function update(MainCategoryRequest $request, $id)
    {
        
        //return $request;
       try{
        $maincategory = MainCategory::find($id);
            if(!$maincategory){
                return redirect()->route('MainCategory-dashboard.index',$id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا القسم غير موجود    '
                ]);
            }

            if($request->has('light_photo')){
                $photoPath=uploadFile($request->light_photo,'images/maincategories');
                $maincategory ->update([
                    'light_photo'=>$photoPath,
                ]);
            }
            if($request->has('dark_photo')){
                $photoPath=uploadFile($request->dark_photo,'images/maincategories');
                $maincategory ->update([
                    'dark_photo'=>$photoPath,
                ]);
            }

            $maincategory ->update([
                'title'=>$request->title,
                'icon'=>$request->icon,
                'description'=>$request->description,
                'color'=>$request->color,
                'slug'=>$request->slug,
            ]);
            return redirect()-> route('MainCategory-dashboard.index')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث القسم ','notifyMsg' => 'تم تحديث القسم  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return redirect()-> route('MainCategory-dashboard.index')
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث القسم    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function changeStatus($id)
    {
        try{
            $MainCategory = MainCategory::find($id);
            if(!$MainCategory){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا القسم غير موجود    '
                ]);
            }
                
            $status=$MainCategory->active == 0 ? '1' : '0';
            
            //ther is Observer
            $MainCategory->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة القسم  ','notifyMsg' => 'تم بنجاح... القسم    '.$MainCategory->getActive().'  الأن  ',
                'active'=>$MainCategory->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة القسم    '. $MainCategory->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
       
    }
}
