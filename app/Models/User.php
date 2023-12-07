<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('username')
            ->usingSeparator('_')
            ->doNotGenerateSlugsOnUpdate();
    }
    public function getRouteKeyName()
    {
        return 'username';
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'description',
        'photo',
        'interest',

        'facebook',
        'twitter',
        'instagram',
        'github',

        'site_notification',
    

        'gender',
        'birth_date',
        'active',
        'user_appear',

        'views',
        'likes',
        'read_article',
        'lesson_assessment',
        
        'level',
        'professionalism',
        
        'total_donations',
        'plan_id',
        'plan_progress',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getGender(){ 
        return $this-> gender == 1 ? 'انثى' : 'ذكر';
    }

    public function getAge(){ 
        if($this->birth_date != null){
            $year = Carbon::now()->format('Y');
            $birth = explode("-",$this->birth_date);
            $age = (int)$year - (int)$birth[0];
            return $age;
        }else{
            return '__';
        }
    }
    public function getActive(){ 
        return $this-> active == 0 ? 'محظور من قبل إدارة الموقع' : 'مسموح';
    }
   
    public function getStatusSiteNotification(){ 
        return $this-> site_notification == 1 ? 'مفعلة' : 'محظورة';
    }
    public function getUserActive(){ //من هنا
        switch($this-> user_appear){
            case 0:
                return 'مخفي عن الجميع';
            case 1:
                return 'ظاهر للجميع';
            case 2:
                return 'مخفي جذئيا';
            default:
                return '__';
        }
    }
    public function getSiteNotification(){ 
        return $this-> site_notification == 1 ? 'استقبال اشعارات من الموقع (ينصح به) ' : 'حظر الاشعارات من الموقع';
    }
    /*
    public function getProfessionalism(){ 
        $pro= $this-> professionalism;
        $ex= $this-> exams;
    }
    */

    public function scopeActive($query){
        return $query -> where('active',1);
    }
    public function scopeUserAppear($query){
        return  $query -> where('user_appear','!=','0');
    }
    
    public function scopeSelection($query){

        if($query ->select('user_appear')->value('user_appear') == '1'){
            return $query ->select('id',
        
                'email',
                'photo',
                'facebook',
                'twitter',
                'instagram',
                'github',
                'gender',
                'birth_date',
                
                'name',
                'username',
                'interest',
                'description',
                'site_notification',
                
                'active',
                'user_appear',

                'views',
                'likes',

                'read_article',
                'lesson_assessment',
                
                'level',
                'professionalism',
                'plan_id',
                'plan_progress',
                'total_donations',
                'created_at',

        
            );
        }elseif($query ->select('user_appear')->value('user_appear') == '2'){
            return $query ->select('id',
         
                'name',
                'username',
                'interest',
                'description',
                'site_notification',
                
                'active',
                'user_appear',

                'views',
                'likes',

                'read_article',
                'lesson_assessment',
                
                'level',
                'professionalism',
                'plan_id',
                'plan_progress',
                'total_donations',
                'created_at',

        
            );
        }
        return null;
    }

    
    public function getPhoto(){ 
        return ($this->user_appear == 1 && $this->photo !== null) ? asset('public/assets/'.$this->photo) : asset('public/assets/images/user.jpg');
    }
    public function questions(){ 
        return $this ->hasMany('App\Models\Question','user_id','id'); 
    }
    
    public function notification(){ 
        return $this ->hasMany('App\Models\Notification','user_id','id'); 
    }
    
    public function comments(){ 
        return $this ->hasMany('App\Models\Comment','user_id','id'); 
    }

    public function courses(){ 
        return $this ->belongsToMany('App\Models\Course','App\Models\User_Course','user_id','course_id','id'); 
    }
    public function lessons(){ 
        return $this ->hasMany('App\Models\UserLesson','user_id','id'); 
    }
    public function experience(){ 
        return $this ->hasOne('App\Models\UserExperience','user_id','id'); 
    }

    public function plan(){ 
        return $this ->belongsTo('App\Models\Plan','plan_id','id'); 
    }
    public function OwnerComments(){ 
        return $this ->hasMany('App\Models\OwnerComment','owner_id','id'); 
    }
    ///////////////////////////////////////
    public function savedArticles(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'savedable')->withPivot(['id']);
    }
    public function savedLessons(): MorphToMany
    {
        return $this->morphedByMany(Lesson::class, 'savedable')->withPivot(['id']);
    }
    public function savedQuestions(): MorphToMany
    {
        return $this->morphedByMany(Question::class, 'savedable')->withPivot(['id']);
    }
    public function savedBooks(): MorphToMany
    {
        return $this->morphedByMany(Book::class, 'savedable')->withPivot(['id']);
    }
    public function savedCategories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'savedable')->withPivot(['id']);
    }
    public function supports(){ 
        return $this ->hasMany('App\Models\Supporter','user_id','id'); 
    }
}
