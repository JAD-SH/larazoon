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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('photo');
            $table->string('file');
            $table->enum('active', [1, 0])->default(1);
            $table->string('language', 50);
            $table->integer('downloads')->default(0);
            $table->integer('library_id');
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->string('author', 50);
            $table->string('description', 600)->nullable();
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
        Schema::dropIfExists('books');
    }
};
