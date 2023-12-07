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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('question', 150);
            $table->string('right_answer', 150);
            $table->string('wrong_answer_1', 150);
            $table->string('wrong_answer_2', 150);
            $table->string('wrong_answer_3', 150);
            $table->enum('active', [1, 0])->default(1);

            $table->integer('lesson_id');
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
        Schema::dropIfExists('exams');
    }
};
