<?php


use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

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




Route::name('front.')->group(function () {

    Route::get('/' , [HomeController::class , 'index'])->name('home');

    Route::get('Browse/projects' , [HomeController::class , 'browseProjects'])
        ->name('projects');

    Route::get('show/project/{title}' , [HomeController::class , 'show'])
        ->name('show.project')->middleware('markAs_Read_Notification');
});





