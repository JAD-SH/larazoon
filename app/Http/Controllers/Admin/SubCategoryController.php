<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use App\Http\Requests\admin\SubCategoryRequest;
use Session; 

class SubCategoryController extends Controller
{
 
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::put('sidebar-section-id','sidebar-Subcategories-section');
            return $next($request);
        });
    }

    public function index()
    {
       
        $subcategories = SubCategory::selection()->paginate(PAGINATION_COUNT);
        
        $cat_top_likes = Category::with('subcategory')->active()->selection()->orderBy('likes', 'desc')->limit(10)->get();
        $cat_top_views = Category::with('subcategory')->active()->selection()->orderBy('views', 'desc')->limit(10)->get();

        return view('admin.subcategory.index',compact('cat_top_likes','cat_top_views','subcategories'));
    }

    public function create()
    {
        return view('admin.subcategory.create');
    }
    

    public function store(SubCategoryRequest $request)
    {


        try{
            
            SubCategory::create([
                'title'=> $request->title,
                'color'=> $request->color,
                'description'=> $request->description,
                'icon' => $request->icon,
                'slug' => $request->slug,
            ]);
            
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'انشاء قسم فرعي جديد',
                    'notifyMsg' => 'تم انشاء القسم الفرعي  '.$request->title.'  بنجاح '
                ]);
           
            }catch (\Exception $ex){
                //return $ex;
                return response() -> json([
                    'notifyType' => 'dangerToast',
                    'notifyTitle' => 'فشل  ',
                    'notifyMsg' => 'فشل انشاء القسم الفرعي    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            
                ]);
            }
        
    
    }

    public function show($subcategory_id)
    {
        $subcategory =  SubCategory::with('categories') -> find($subcategory_id);

        if(!$subcategory){
            return redirect()-> route('SubCategory-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذا القسم الفرعي غير موجود '
            ]);        
        }
        if(!$subcategory->categories->count() > 0){
            return redirect()-> route('SubCategory-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' لا يوجد عناصر لهذه القسم الفرعي '
            ]);        
        }
        $categories =$subcategory->categories()->selection()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        Session::put('categories-filter','filter-index');
        return view('admin.category.index',compact('categories','subcategory_id'));
    }

    public function edit($id)
    {
        
        $subcategory = SubCategory::selection()->find($id);
        if(!$subcategory){
            return redirect()->route('SubCategory-dashboard.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا القسم الفرعي غير موجود    '
            ]);
        }
        return view('admin.subcategory.edit', compact('subcategory')); 
    }

    public function update(SubCategoryRequest $request, $id)
    {
       // return $request;
       try{
        $subcategory = SubCategory::find($id);
            if(!$subcategory){
                return redirect()->route('SubCategory-dashboard.index',$id)
                ->with([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا القسم الفرعي غير موجود    '
                ]);
            }

            $subcategory ->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'color'=>$request->color,
                'icon' => $request->icon,
                'slug' => $request->slug,
            ]);
            return redirect()-> route('SubCategory-dashboard.index')
            ->with([
                'notifyType' => 'successToast','notifyTitle' => 'تحديث القسم الفرعي ','notifyMsg' => 'تم تحديث القسم الفرعي  '.$request->title.'  بنجاح '
            ]);
        }catch (\Exception $ex){
            return redirect()-> route('SubCategory-dashboard.index')
            ->with([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تحديث القسم الفرعي    '. $request->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }

    public function destroy($id)
    {
        try{
            $subCategory = SubCategory::find($id);
            if(!$subCategory){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا القسم الفرعي غير موجود    '
                ]);
            }

            $subCategory ->delete();

            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'حذف القسم الفرعي ','notifyMsg' => 'تم حذف القسم الفرعي  '.$subCategory->title.'  بنجاح ',
                'item_id'=>$id
            ]);
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل حذف القسم الفرعي    '. $subCategory->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
        
    }
    
    public function changeStatus($id)
    {
        try{
            $subCategory = SubCategory::find($id);
            if(!$subCategory){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل  ','notifyMsg' => 'هذا القسم الفرعي غير موجود    '
                ]);
            }
                
            
            $status=$subCategory->active == 0 ? '1' : '0';
            
            //ther is Observer
            $subCategory->update([
                'active'=>$status,
            ]);
            
            return response() -> json([
                'notifyType' => 'successToast','notifyTitle' => 'تغيير حالة القسم الفرعي  ','notifyMsg' => 'تم بنجاح... القسم الفرعي    '.$subCategory->getActive().'  الأن  ',
                'active'=>$subCategory->active
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast','notifyTitle' => 'فشل  ','notifyMsg' => 'فشل تغيير حالة القسم الفرعي    '. $subCategory->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
       
    }
     
    public function trashed(){
        //return 'aaaa';
         $trashed = Category::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(50);
        if(!$trashed->count()){
            return redirect()-> back()
            ->with([
                'notifyType' => 'warningToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'لا يوجد فقرات في سلة المهملات    '
            ]);
        }
        return view('admin.subcategory.trashed',compact('trashed'));
    }

    public function restore($id){
        //return 'aaaa';
        try{
            $trashed_item = Category::onlyTrashed()->where('id', $id)->get();

            if(!$trashed_item){
                return response() -> json([
                    'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه فقرات غير موجودة '
                ]);        
            }
            Category::onlyTrashed()->where('id', $id)->restore();

            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'استعادة الفقرات',
                'notifyMsg' => 'تم استعادة الفقرات بنجاح ',
                'item_id'=>$id
            ]);
           
        }catch (\Exception $ex){
            //return $ex;
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل استعادة الفقرات لسبب ما يرجى المحاولة لاحقا '
        
            ]);
        }
        
    }
}
