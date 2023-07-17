<?php

namespace App\Providers;

use App\Contracts\Services\CommentServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Services\Models\CommentService;
use App\Services\Models\PostService;
use App\Services\Models\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PostServiceInterface::class,
            PostService::class
        );

        $this->app->bind(
            CommentServiceInterface::class,
            CommentService::class
        );

        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
