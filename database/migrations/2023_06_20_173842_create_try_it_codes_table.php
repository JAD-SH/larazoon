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
        Schema::create('try_it_codes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->text('code',2100);
            $table->string('type');
            $table->text('code1',2100)->nullable();
            $table->string('type1')->nullable();
            $table->text('code2',2100)->nullable();
            $table->string('type2')->nullable();
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
        Schema::dropIfExists('try_it_codes');
    }
};
