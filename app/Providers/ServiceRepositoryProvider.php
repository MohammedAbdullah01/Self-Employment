<?php

namespace App\Providers;

use App\Repositories\Auth;
use App\Repositories\Category;
use App\Repositories\Comment;
use App\Repositories\Dashboard;
use App\Repositories\LatesWork;
use App\Repositories\Interfaces\AuthRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\CommentRepository;
use App\Repositories\Interfaces\DashboardRepository;
use App\Repositories\Interfaces\LatesWorkRepository;
use App\Repositories\Interfaces\ProfileRepository;
use App\Repositories\Interfaces\ProjectRepository;
use App\Repositories\Profile;
use App\Repositories\Project;
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
        $this->app->bind(AuthRepository::class        , Auth::class);

        $this->app->bind(ProfileRepository::class     , Profile::class);

        $this->app->bind(LatesWorkRepository::class   , LatesWork::class);

        $this->app->bind(CommentRepository::class     , Comment::class);

        $this->app->bind(ProjectRepository::class     , Project::class);

        $this->app->bind(CategoryRepository::class    , Category::class);

        $this->app->bind(DashboardRepository::class   , Dashboard::class);
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
