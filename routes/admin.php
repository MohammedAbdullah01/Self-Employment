<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LatestWorkUser;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin'  , 'history')->group(function () {

        Route::get('login'                       , [AdminController::class, 'showLogin'])
            ->name('show.login');

        Route::post('login/store'                , [AdminController::class, 'storeLogin'])
            ->name('store.login');

});

    Route::middleware('auth:admin' , 'history')->group(function () {

        Route::get('dashboard'                   , [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('categories'                  , [CategoryController::class , 'index'])
            ->name('categories.all');

        Route::post('categories/store'           , [CategoryController::class , 'store'])
            ->name('categories.store');

        Route::put('categories/{id}/edit'        , [CategoryController::class , 'update'])
            ->name('categories.update');

        Route::delete('categories/{id}/delete'   , [CategoryController::class , 'destroy'])
            ->name('categories.dalete');

        // ====== End Pages Categories ======

        Route::get('project/activte'             , [ProjectController::class , 'projectActivte'])
            ->name('project.activte');

        Route::get('project/not/activte'         , [ProjectController::class , 'projectNotActivte'])
            ->name('project.notactivte');

        Route::get('show/project/{title}'        , [ProjectController::class , 'showProject'])
            ->name('project.show');

        Route::put('activate/{project}/project'  , [ProjectController::class , 'storeActivatProject'])
            ->name('project.activat');

        Route::delete('project/{project}/delete' ,[ProjectController::class , 'destroy'])
            ->name('project.delete');

        // ====== End Pages Projects ======

        Route::get('latestworks'                 , [LatestWorkUser::class , 'latestWorks'])
            ->name('latestworks');

        Route::delete('latestwork/{latestwork}'  , [LatestWorkUser::class , 'destroyLatestWork'])
            ->name('latestwork.delete');

        // ====== End Pages Latestworks ======

        Route::get('comments'                    , [CommentController::class , 'index'])
            ->name('comment.all');

        Route::delete('user/{comment}/comment'   , [CommentController::class , 'destroy'])
            ->name('comment.delete');
        // ====== End Pages Comments ======

        Route::get('users'                       , [UserController::class , 'index'])
            ->name('users.all');

        Route::delete('delete/{user}/user'       , [UserController::class , 'destroy'])
            ->name('user.delete');

        // ====== End Pages Users ======

        Route::get('clients'                     , [ClientController::class , 'index'])
            ->name('clients.all');

        Route::delete('delete/{client}/client'   , [ClientController::class , 'destroy'])
            ->name('client.delete');

        // ====== End Pages Clients ======


        Route::post('logout'                     , [AdminController::class, 'destroy'])
            ->name('logout');

    });


});
