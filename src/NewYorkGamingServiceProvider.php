<?php

namespace Ruhul\NYGaming;

use Illuminate\Support\ServiceProvider;
use Ruhul\NYGaming\Console\InstallNYGaming;

class NewYorkGamingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/nygaming.php' => config_path('newyorkgaming.php'),
        ], 'nyg-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallNYGaming::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('newyorkgaming', function () {
            return new NewYorkGaming;
        });
    }
}
