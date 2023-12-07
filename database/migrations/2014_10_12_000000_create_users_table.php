<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('username')->unique()->nullable(); //as slug
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->string('description', 600)->nullable();
            $table->string('photo')->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('twitter', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('github', 200)->nullable();
            $table->string('interest', 50)->nullable();
            $table->enum('site_notification', [1, 0])->default(1);
            
            
            $table->enum('gender', [1, 0])->default(1);
            $table->date('birth_date')->nullable();
            $table->enum('user_appear', [2, 1, 0])->default(1);
            $table->enum('active', [1, 0])->default(1);
            
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('read_article')->default(0);
            $table->integer('lesson_assessment')->default(0);
            
            $table->smallInteger('level')->default(0);
            $table->smallInteger('professionalism')->default(0);
            $table->integer('plan_id')->nullable();
            $table->integer('plan_progress')->default(0);
            
            $table->integer('total_donations')->default(0);

            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
