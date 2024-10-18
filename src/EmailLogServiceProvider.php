<?php

namespace Vikramsra\EmailLogToDb;

use Illuminate\Support\ServiceProvider;

class EmailLogServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the event service provider
        $this->app->register(EventServiceProvider::class);
    }

    public function boot()
    {
        // Load migrations from the plugin directory
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        // Load views from the src/views directory
        $this->loadViewsFrom(__DIR__ . '/views', 'emailLogs');

        // Load routes from the plugin's routes/web.php file
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }
}
