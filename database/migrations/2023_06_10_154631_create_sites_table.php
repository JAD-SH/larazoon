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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 50);
            $table->string('ar_site_name', 50);
            $table->string('site_description');
            $table->string('site_photo');
            $table->string('site_logo');
            //$table->string('site_sm_logo');
            $table->string('facebook', 200)->nullable();
            $table->string('twitter', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('github', 200)->nullable();
            $table->string('user_profile_background');
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
        Schema::dropIfExists('sites');
    }
};
