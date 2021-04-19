<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TweetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\TweetRepositoryInterface',
            'App\Repository\Eloquent\TweetRepository'
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
