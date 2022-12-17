<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\SkillController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', FrontendController::class)->name('frontend');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    //Module Category
    Route::apiResource('module-categories', ModuleCategoryController::class);
    // Modules
    Route::resource('modules', ModuleController::class);
    // Codes
    Route::resource('codes', CodeController::class);

    /* --------Portfolio--------- */
    Route::resource('skills', SkillController::class);
    Route::apiResource('experiences', ExperienceController::class);
    Route::apiResource('projects', ProjectController::class);
});
