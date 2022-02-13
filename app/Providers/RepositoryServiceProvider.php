<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.
        $this->app->bind(
            'App\Interfaces\MediaInterface',
            'App\Repositories\MediaRepository'
        );

        $this->app->bind(
            'App\Interfaces\PostInterface',
            'App\Repositories\PostRepository'
        );

        $this->app->bind(
            'App\Interfaces\AstuceInterface',
            'App\Repositories\AstuceRepository'
        );
        $this->app->bind(
            'App\Interfaces\ReferencementInterface',
            'App\Repositories\ReferencementRepository'
        );
    }
}
