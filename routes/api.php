<?php

use App\Http\Controllers\Api\Client\AuthTokensCotroller;
use App\Http\Controllers\Api\Client\ProfileController;
use App\Http\Controllers\Api\Client\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('client')->name('api.client.')->group(function () {
    // Route::apiResource('projects', ProjectController::class);


    Route::middleware('guest:sanctum')->group(function () {

        Route::post('auth/store/token', [AuthTokensCotroller::class, 'checkClientLogin'])
            ->name('login');

            Route::post('register/store' , [AuthTokensCotroller::class  , 'store'])
            ->name('store.register');

            Route::get('verify'                 , [AuthTokensCotroller::class, 'verify'])
            ->name('verify');

            Route::post('password/forgot'           , [AuthTokensCotroller::class, 'sendResetLink'])
            ->name('forgot.password.link');

            Route::get('password/reset/{token}'     , [AuthTokensCotroller::class, 'showPasswordResetForm'])
            ->name('password.reset');

            Route::PUT('confirm/password'           , [AuthTokensCotroller::class, 'confirmPasswordUpdate'])
            ->name('confirm.password.update');

        Route::get('project/show/{project}', [ProjectController::class, 'show'])
            ->name('show.project');
    });




    Route::middleware('auth:sanctum')->group(function () {

        Route::get('auth/tokens'                , [AuthTokensCotroller::class, 'index'])
            ->name('all.tokens');

        Route::get('profile'                    , [ProfileController::class, 'profile'])
            ->name('profile');

        Route::put('profile/update'             , [ProfileController::class, 'update'])
            ->name('update');

        Route::put('profile/change/Password'    , [ProfileController::class, 'changePassword'])
            ->name('change.Password');

        Route::post('project/store'             , [ProjectController::class, 'store'])
            ->name('store.project');

        Route::put('project/update/{project}'   , [ProjectController::class, 'update'])
            ->name('update.project');

        Route::delete('project/delete/{project}', [ProjectController::class, 'destroy'])
            ->name('delete.project');

        Route::delete('logout/tokens/{id}'      , [AuthTokensCotroller::class, 'destroy'])
            ->name('logout');
    });
});
