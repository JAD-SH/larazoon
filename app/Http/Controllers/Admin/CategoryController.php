<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use Session;
use App\Http\Requests\admin\CategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    

    public function older($subcategory_id)
    {
        $categories = Category::where('subcategory_id',$subcategory_id)->paginate(PAGINATION_COUNT);
        Session::put('categories-filter','filter-older');
        return view('admin.category.index',compact('categories','subcategory_id'));
    }
    public function un_active($subcategory_id)
    {
        $categories = Category::where('subcategory_id',$subcategory_id)->where('active','0')->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        if(!$categories->count() > 0){
            return redirect()-> route('SubCategory-dashboard.show',$subcategory_id)
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد فقرات غير مفعلة '
            ]);        
        }
        Session::put('categories-filter','filter-unactive');
        return view('admin.category.index',compact('categories','subcategory_id'));
    }
    public function top_views($subcategory_id)
    {
        $categories = Category::where('subcategory_id',$subcategory_id)->orderBy('views', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('categories-filter','filter-top-views');
        return view('admin.category.index',compact('categories','subcategory_id'));
    }
    public function top_likes($subcategory_id)
    {
        $categories = Category::where('subcategory_id',$subcategory_id)->orderBy('likes', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('categories-filter','filter-top-likes');
        return view('admin.category.index',compact('categories','subcategory_id'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function create()
    {
        return view('admin.category.create');
    }*/
    public function create($subcategory_id)
    {
       // $subcategory_id = $id;
        return view('admin.category.create',compact('subcategory_id'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //return $request->subcategory_id;

        $photoPath='default_photo.PNG';
        try{
            if($request->has('photo'))
            $photoPath=uploadFile($request->photo,'images/categories');


            $sub_category=  SubCategory::find($request->subcategory_id);
            Category::create([
                'title' => $request->title,
                'active' => $sub_category->active,
                'photo' => $photoPath,
                'slug' => $request->slug,
                'description' => $request->description,
                'content' => $request->content,
                'style' => $request->style,
                'script' => $request->script,
                'subcategory_id' => $request->subcategory_id,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'انشاء فقرة جديدة',
                'notifyMsg' => 'تم انشاء الفقرة  '.$request->title.'  بنجاح '
            ]);
           
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل انشاء الفقرة    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
        
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content =  Category:: find($id);

        if(!$content){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا العنصر غير موجود '
            ]);        
        }
        return view('admin.item',compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $category = Category::selection()->find($id);
        //$subcategory_id = $category->library->id;
        if(!$category){
            return redirect()->back()
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الفقرة غير موجود    '
            ]);
        }
        return view('admin.category.edit', compact('category')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
         //return $request;

       try{
        $category = Category::find($id);
            if(!$category){
                return redirect()-> route('SubCategory-dashboard.show',$request->subcategory_id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الفقرة غير موجود    '
                ]);
            }

            if($request->has('photo')){
                $photoPath=uploadFile($request->photo,'images/categories');
                $category ->update([
                    'photo'=>$photoPath,
                ]);
            }

            $category ->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'style' => $request->style,
                'script' => $request->script,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('SubCategory-dashboard.show',$request->subcategory_id)
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث الفقرة ','notifyMsg' => 'تم تحديث الفقرة  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('SubCategory-dashboard.show',$request->subcategory_id)
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث الفقرة    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $category = Category::find($id);
            if(!$category){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الفقرة غير موجود    '
                ]);
            }

            $category ->delete();            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف الفقرة ','notifyMsg' => 'تم حذف الفقرة  '.$category->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف الفقرة    '. $category->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function changeStatus($id)
    {
        try{
            $category = Category::find($id);
            if(!$category){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا الفقرة غير موجود    '
                ]);
            }
                
            if($category->subcategory->first()->active == 0){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'القسم الفرعي الخاص بالفقرة هذا غير مفعل بالتالي لا يمكنك تعديل حالة الفقرة    '
                ]);
            }

            $status=$category->active == 0 ? '1' : '0';
            
            //return $category;
            $category->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة الفقرة  ','notifyMsg' => 'تم بنجاح... الفقرة    '.$category->title.'  '.$category->getActive().'  الأن  ',
                'active'=>$category->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة الفقرة    '. $category->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    public function move(Request $Request ,$id)
    {
        try{
            $category = Category::find($id);
            $subcategory = SubCategory::find($Request->subcategory_id);

            if(!$category){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'هذه الفقرة غير موجودة    '
                ]);
            }
            if(!$subcategory){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'القسم الفرعي هذا غير موجود  '
                ]);
            }
                
            $category->update([
                'subcategory_id'=>$Request->subcategory_id,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'نقل الفقرة  ',
                'notifyMsg' => ' تم نقل الفقرة الى القسم الفرعي  '.$subcategory->title.'  بنجاح  ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل نقل الفقرة    '. $category->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function tryit_page($tryitable_id)
    {
        try{
            $category = Category::find($tryitable_id);
            if(!$category){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه الفقرة غير موجودة    '
                ]);
            }
             $tryitcodes = $category->tryitCodes()->get();
             $tryitable_type = "Category";
            return view('admin.tryit.index',compact('tryitable_id','tryitable_type','tryitcodes'));

        }catch (\Exception $ex){
            return $ex;
            return redirect()->back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' حدث خطأ ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function image_page($imageable_id)
    {
        try{
            $category = Category::find($imageable_id);
            if(!$category){
                return redirect()->back()
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذه الفقرة غير موجودة    '
                ]);
            }
             $images = $category->images()->get();
             $imageable_type = "Category";
            return view('admin.image.index',compact('imageable_id','imageable_type','images'));

        }catch (\Exception $ex){
            return $ex;
            return redirect()->back()
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => ' حدث خطأ ما يرجى المحاولة لاحقا '
            ]);
        }
    }

}
