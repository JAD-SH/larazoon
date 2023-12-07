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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);

            $table->enum('active', [1, 0])->default(1);
            $table->text('description',10100);//هنا يمكن يعمل خطأ في المستقبل
            $table->integer('user_id');
            
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->string('slug')->unique();
            $table->softdeletes();
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
        Schema::dropIfExists('questions');
    }
};
