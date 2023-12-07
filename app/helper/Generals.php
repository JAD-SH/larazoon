<?php

function Site(){
    return \App\Models\Site::first();
}
function MainCategories(){
    return \App\Models\MainCategory::active()->selection()->get();
}
function Plans(){
    return \App\Models\Plan::active()->get();
}
function ArticleLibraries(){
    return \App\Models\ArticleLibrary::active()->selection()->get();
}
function BookLibraries(){
    return \App\Models\BookLibrary::active()->selection()->get();
}
function Courses(){
    return \App\Models\Course::active()->selection()->get();
}
function LessonGroups(){
    return \App\Models\LessonGroup::active()->selection()->get();
}
function SubCategories(){
    return \App\Models\SubCategory::active()->get();
}

function uploadFile( $file,$folder)
{
    $file->store('/', $folder);
    $filename = $file->hashName();
    $path =  $folder . '/' . $filename;
    return $path;
}


function Messages(){
    return \App\Models\Notification::where('type','message')->where('watch','0')->get();
}

function Asks(){
    return \App\Models\Notification::where('type','ask')->where('watch','0')->get();
}

function Supporters(){
    return \App\Models\Supporter::get();
}
function Image($slug){
    $image = \App\Models\Image::where('slug',$slug)->first()->image;
    if($image) return $image;
    else return Site()->site_photo;
}
function Media($slug){
    $model = \App\Models\Media::where('slug',$slug)->first();
    if(!$model) return ['media'=>null ,'type'=>null];
    $media = $model->media;
    $type = $model->type;
    return ['media'=>$media ,'type'=>$type];
}

function PlanProgres(){
    $lesson_has_exam = Auth::user()->courses()->with('lessons')->get()->pluck('lessons')->flatten()->count();
    if($lesson_has_exam == 0) return $lesson_has_exam;
    $lesson_examine = Auth::user()->lessons()->where('result','!=',null)->count();
    $Plan_progres = (int)(($lesson_examine*100)/$lesson_has_exam);
    return $Plan_progres;
}
function UserPlanProgres($user){
    $lesson_has_exam = $user->courses()->with('lessons')->get()->pluck('lessons')->flatten()->count();
    if($lesson_has_exam == 0) return $lesson_has_exam;
    $lesson_examine = $user->lessons()->where('result','!=',null)->count();
    $Plan_progres = (int)(($lesson_examine*100)/$lesson_has_exam);
    return $Plan_progres;
}
function CourseProgres($course){

    $user_lessons_count = Auth::user()->lessons->where('course_id',$course->id)->count();
    $course_lessons_count = $course->lessons->count();
    if($course_lessons_count == 0)
        return 0;
    $Course_progres = (int)(($user_lessons_count*100)/$course_lessons_count);
    return $Course_progres;
}
function UserCourseProgres($user, $course){

    $user_lessons_count = $user->lessons->where('course_id',$course->id)->count();
    $course_lessons_count = $course->lessons->count();
    if($course_lessons_count == 0)
        return 0;
    $Course_progres = (int)(($user_lessons_count*100)/$course_lessons_count);
    return $Course_progres;
}
