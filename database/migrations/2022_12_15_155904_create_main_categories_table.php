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
        Schema::create('main_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('route', 50);
            $table->string('light_photo');
            $table->string('dark_photo')->nullable();
            //$table->nullableUuidMorphs('taggable');//morph
            $table->string('icon', 100);
            $table->string('color', 50)->default("primary");
            $table->enum('active', [1, 0])->default(1);
            $table->string('description', 600)->nullable();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('main_categories');
    }
};
