<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ProjectController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')->name('client.')->group(function () {

    Route::get('v/profile/{name}'       , [ProfileController::class, 'profile'])
            ->name('view.profile');

    Route::middleware(['guest:web', 'guest:client'  , 'history'])->group(function () {

        Route::get('login'                      , [ClientController::class  , 'showLogin'])
            ->name('login');

        Route::post('login/check'               , [ClientController::class  , 'checkClientLogin'])
            ->name('check');

        Route::get('register'                   , [ClientController::class  , 'showRegister'])
            ->name('register');

        Route::post('register/store'            , [ClientController::class  , 'store'])
            ->name('store.register');

            Route::get('password/forget'        , [ClientController::class, 'showForgetPassword'])
            ->name('forgot.password');

        Route::post('password/forgot'           , [ClientController::class, 'sendResetLink'])
            ->name('forgot.password.link');

        Route::get('password/reset/{token}'     , [ClientController::class, 'showPasswordResetForm'])
            ->name('password.reset');

        Route::PUT('confirm/password'           , [ClientController::class, 'confirmPasswordUpdate'])
            ->name('confirm.password.update');

        Route::get('password/reset/{token}'     , [ClientController::class, 'showPasswordResetForm'])
            ->name('password.reset');

            Route::get('verify'                 , [ClientController::class, 'verify'])
            ->name('verify');
    });




    Route::middleware(['auth:client' ,'is_user_verify_email' ,  'history'] )->group(function () {

        // Route::get('dashboard'              , [ProfileController::class  , 'dashboard'])
        //     ->name('dashboard');

        Route::get('profile/{name}'             , [ProfileController::class  , 'profile'])
            ->name('profile');



        Route::put('profile/update'             , [ProfileController::class, 'update'])
        ->name('update');

        Route::put('profile/change/Password'    , [ProfileController::class, 'changePassword'])
        ->name('change.Password');


        Route::get('projects'                   , [ProjectController::class , 'index'])
            ->name('create.projects');

        // Route::get('project/create'             , [ProjectController::class , 'create'])
        //     ->name('create.project');

        Route::post('project/store'             , [ProjectController::class , 'store'])
            ->name('store.project');

        // Route::get('project/edit/{slug}'        , [ProjectController::class , 'edit'])
        //     ->name('edit.project');

        Route::put('project/update/{project}'      , [ProjectController::class , 'update'])
            ->name('update.project');

        Route::delete('project/delete/{project}'     , [ProjectController::class , 'destroy'])
            ->name('delete.project');

        Route::post('logout'                    , [ClientController::class, 'destroy'])
            ->name('logout');

    });



    // Route::middleware(['auth:web','auth:client' , 'history'])->group(function () {

    // Route::get('v/profile/{name}'       , [ProfileController::class, 'profile'])
    // ->name('view.Profile');

    // });
});
