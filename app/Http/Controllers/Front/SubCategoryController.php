<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Category;
use App\Events\AddLikeCategoryEvent;
use App\Events\AddViewCategoryEvent;
use Session;
use Spatie\SchemaOrg\Schema;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            Session::forget('categorySLUG');
            return $next($request);
        });
        
    }
    public function Subcategories()
    {
        $subcategories = SubCategory::active()->selection()->get();
        return view('front.subcategories',compact('subcategories'));
    }
    public function subcategory($subcategory_slug)
    {
        $subcategory = SubCategory::active()->selection()->where('slug',$subcategory_slug)->first();
        if($subcategory->categories()->count() == 0 ){
            return redirect()-> back()->with([
                'notifyType' => 'warningToast',
                'notifyTitle' => 'فشل',
                'notifyMsg' => 'لا يوجد فقرات بعد في هذا القسم .. نعمل بجد على اضافة محتوى الرجاء العودة لاحقا'
            ]);
        }
        Session::put('categorySLUG',$subcategory->slug);
        return view('front.subcategory',compact('subcategory'));
    }
    public function category($subcategory_slug,$category_slug)
    {
        $category = Category::where('slug',$category_slug)->active()->first();
        if(!$category){
            return redirect()-> route('Course.index')
            ->with([
                'notifyType' => 'warningToast','notifyTitle' => 'فشل','notifyMsg' => ' هذه الفقرة غير موجودة '
            ]);        
        }
        $status=event(new AddViewCategoryEvent($category));
        $schemaCategory = Schema::article()->mainEntityOfPage(Schema::webPage()->identifier("هنا رابط الفقرة"))
            ->headline($category->title)->description($category->description)->image($category->photo)->author(
            Schema::organization()->name('HelloLaravel')->url('http://localhost/HelloLaravel/'))
            ->publisher(Schema::organization()->name('HelloLaravel')->logo(Schema::imageObject()
            ->url('http://localhost/HelloLaravel/')))->datePublished($category->created_at)
            ->dateModified($category->updated_at);
        $schemajspnscript = $schemaCategory->toScript();
        Session::put('categorySLUG',$category->subcategory->slug);
        return view('front.category',compact('category','schemajspnscript'));
    }
    public function AddLike($id)
    {
        try{
            $category=Category::active()->find($id);
            if(!$category){
                return response() -> json([
                    'notifyType' => 'warningToast',
                    'notifyTitle' => 'فشل',
                    'notifyMsg' => 'هذه الفقرة غير موجودة'
                ]);
            }
            $status=event(new AddLikeCategoryEvent($category));
            if(!$status){
                return response() -> json([
                    'notifyType' => 'successToast',
                    'notifyTitle' => 'الاعجاب بالفقرة',
                    'notifyMsg' => 'شكرا لك انت بالفعل قد اعجبت بالفقرة   '.$category->title
                ]);
            }
            return response() -> json([
                'notifyType' => 'successToast',
                'notifyTitle' => 'الاعجاب بالفقرة',
                'notifyMsg' => 'شكرا للإعجاب بالفقرة  '.$category->title
            ]);
        }catch (\Exception $ex){
            return response() -> json([
                'notifyType' => 'dangerToast',
                'notifyTitle' => 'فشل  ',
                'notifyMsg' => 'فشل الإعجاب بالفقرة    '. $category->title.'  لسبب ما يرجى المحاولة لاحقا '
            ]);
        }
    }
}
