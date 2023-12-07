<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Article;
use App\Models\Book;
use App\Models\Course;
use App\Models\MainCategory;
use App\Models\Question;
use App\Models\SubCategory;

class AutoSiteMapGenerate extends Controller
{
    public function generate_site_map(){
        $sitemap = Sitemap::create()->add(Url::create('/'))->add(Url::create('/Subcategories'));
        
        MainCategory::all()->each(function(MainCategory $maincategory) use ($sitemap) {
            $sitemap->add(Url::create("/{$maincategory->route}"));
        });

        Course::all()->each(function(Course $course) use ($sitemap) {
            $sitemap->add(Url::create("/Course/{$course->slug}"));
            foreach ($course->lessons()->get() as $key => $lesson) {
                $sitemap->add(Url::create("/Course/{$course->slug}/{$lesson->slug}"));
                if($lesson->accessors()->exists()){
                    foreach($lesson->accessors as $accessor){
                        $sitemap->add(Url::create("/Course/{$course->slug}/{$accessor->slug}"));
                    }
                }
            }
        }); 

        SubCategory::all()->each(function(SubCategory $subcategory) use ($sitemap) {
            $sitemap->add(Url::create("/Subcategories/{$subcategory->slug}"));
            foreach ($subcategory->categories()->get() as $key => $category) {
                $sitemap->add(Url::create("/Subcategories/{$subcategory->slug}/{$category->slug}"));
            }
        });  

        Article::all()->each(function(Article $article) use ($sitemap) {
            $sitemap->add(Url::create("/Article/{$article->slug}"));
        });

        Book::all()->each(function(Book $book) use ($sitemap) {
            $sitemap->add(Url::create("/Book/{$book->slug}"));
        });

        Question::all()->each(function(Question $question) use ($sitemap) {
            $sitemap->add(Url::create("/Question/{$question->slug}"));
        });
           
        $sitemap->writeToFile('sitemap.xml');
        return $sitemap;
    }

}
