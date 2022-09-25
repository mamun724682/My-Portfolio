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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('greeting')->nullable();
            $table->string('name');
            $table->string('designation');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('interest')->nullable();
            $table->string('quote')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('status')->nullable()->comment('Online/On Vacation');
            $table->text('about')->nullable();
            $table->string('cv')->nullable();
            $table->text('experiences')->nullable();
            $table->text('educations')->nullable();
            $table->string('work_process')->nullable();
            $table->string('social_urls')->nullable();
            $table->string('counter')->nullable();
            $table->text('testimonials')->nullable();
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
        Schema::dropIfExists('resumes');
    }
};
