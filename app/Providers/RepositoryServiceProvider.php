<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Message\MessageRepository',
            'App\Message\EloquentMessageRepository'
        );

    }

}