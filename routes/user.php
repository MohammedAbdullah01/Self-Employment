<?php

use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\LatestWorkController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->name('user.')->group(function () {

    Route::get('v/profile/{name}'                       , [ProfileController::class, 'profile'])
        ->name('view.profile');

    Route::middleware(['guest:web','guest:client',   'history'])->group(function () {

        Route::get('login'                              , [UserController::class  , 'showLogin'])
            ->name('login');

        Route::post('check/login'                       , [UserController::class  , 'checkUserLogin'])
            ->name('check');

        Route::get('register'                           , [UserController::class  , 'showRegister'])
            ->name('register');

        Route::post('register'                          , [UserController::class  , 'store'])
            ->name('store.register');

        Route::get('password/forget'                    , [UserController::class  , 'showForgetPassword'])
            ->name('forgot.password');

        Route::post('password/forgot'                   , [UserController::class  , 'sendResetLink'])
            ->name('forgot.password.link');

        Route::get('password/reset/{token}'             , [UserController::class  , 'showPasswordResetForm'])
            ->name('password.reset');

        Route::PUT('confirm/password'                   , [UserController::class  , 'confirmPasswordUpdate'])
            ->name('confirm.password.update');

        Route::get('password/reset/{token}'             , [UserController::class  , 'showPasswordResetForm'])
            ->name('password.reset');

        Route::get('verify'                             , [UserController::class  , 'verify'])
            ->name('verify');
    });



    Route::middleware(['auth:web,admin','is_user_verify_email' ,'history'])->group(function () {

        Route::get('profile/{name}'                     , [ProfileController::class   , 'profile'])
        ->name('profile');

        Route::put('profile/update'                     , [ProfileController::class   , 'update'])
            ->name('update');

        Route::post('profile/store/work'                , [LatestWorkController::class , 'storeLatestWork'])
            ->name('store.work');

        Route::put('profile/{latestwork}/update'        , [LatestWorkController::class , 'updateLatestWork'])
            ->name('update.work');

        Route::put('profile/change/Password'            , [ProfileController::class    , 'changePassword'])
            ->name('change.Password');

        Route::delete('profile/{latestwork}/delete'     , [LatestWorkController::class , 'destroyLatestWork'])
            ->name('delete.work');

        Route::post('logout'                            , [UserController::class       , 'destroy'])
            ->name('logout');

        Route::post('comment/{project}/store'           , [CommentController::class    , 'store'])
            ->name('comment.store');

        Route::put('comment/{comment}/update'           , [CommentController::class    , 'update'])
            ->name('comment.update');

        Route::delete('comment/{comment}/delete'        , [CommentController::class    , 'destroy'])
            ->name('comment.delete');
    });
});


