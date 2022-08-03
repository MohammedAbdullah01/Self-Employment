<?php

namespace App\Providers;

use App\Repositories\Auth;
use App\Repositories\Interfaces\AuthRepository;
use App\Repositories\Interfaces\ProfileRepository;
use App\Repositories\Profile;
use Illuminate\Support\ServiceProvider;

class ServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthRepository::class      , Auth::class);
        
        $this->app->bind(ProfileRepository::class   , Profile::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
