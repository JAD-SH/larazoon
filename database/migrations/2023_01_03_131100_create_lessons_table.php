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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->enum('active', [1, 0])->default(1);
            $table->longText('content');
            $table->longText('style')->nullable();
            $table->longText('script')->nullable();
            $table->string('about', 50)->nullable();
            $table->string('description', 600)->nullable();
            $table->string('photo')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('lesson_id')->nullable();
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
        Schema::dropIfExists('lessons');
    }
};
