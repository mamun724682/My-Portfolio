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
        Schema::table('users', function (Blueprint $table) {
            $table->after('remember_token', function () use ($table) {
                $table->string('greeting')->nullable();
                $table->string('designation');
                $table->string('phone')->nullable();
                $table->string('address')->nullable();
                $table->string('interest')->nullable();
                $table->string('current_learning')->nullable();
                $table->string('quote')->nullable();
                $table->string('profile_image')->nullable();
                $table->string('banner_image')->nullable();
                $table->string('status')->nullable()->comment('Online/On Vacation');
                $table->text('about')->nullable();
                $table->string('cv_file')->nullable();
                $table->text('educations')->nullable();
                $table->string('experience_info')->nullable()->comment('Heading & Sub-heading');
                $table->string('skill_info')->nullable()->comment('Heading & Sub-heading');
                $table->string('portfolio_info')->nullable()->comment('Heading & Sub-heading');
                $table->string('contact_info')->nullable()->comment('Heading & Sub-heading');
                $table->string('git_info')->nullable()->comment('Heading, Sub-heading & etc.');
                $table->string('work_process')->nullable();
                $table->string('social_medias')->nullable();
                $table->string('counter')->nullable();
                $table->text('testimonials')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
//                'greeting',
//                'designation',
//                'phone',
//                'address',
//                'interest',
//                'current_learning',
//                'quote',
//                'profile_image',
//                'banner_image',
//                'status',
//                'about',
//                'cv_file',
//                'educations',
                'experience_info',
                'skill_info',
                'portfolio_info',
                'contact_info',
                'git_info',
//                'work_process',
//                'social_medias',
//                'counters',
//                'testimonials'
            ]);
        });
    }
};
