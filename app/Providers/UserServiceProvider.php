<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Elquent\UserRepository;
use App\Repository\UserRepositoryInterface;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\UserRepositoryInterface',
            'App\Repository\Eloquent\UserRepository',
        );
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
