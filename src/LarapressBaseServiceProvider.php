<?php

namespace farazasifali\Larapress;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LarapressBaseServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        if($this->app->runningInConsole())
        {
            $this->registerPublishing();
        }

        $this->registerResources();
        $this->registerRoutes();
    }

    /**
     * Method to register the resources of package
     */
    protected function registerResources()
    {
        $this->loadMigrationsFrom($this->rootDirectory('database/migrations'));
        $this->loadViewsFrom($this->rootDirectory('resources/views'), 'Larapress');
    }

    /**
     * Method to register publishing resources of package
     */
    protected function registerPublishing()
    {
        $this->publishes([
            $this->rootDirectory('config/larapress.php') => config_path('larapress.php')
        ]);
    }

    /**
     * Method to get the root dir path
     *
     * @param  string  $path
     * @return string
     */
    protected function rootDirectory($path = '')
    {
        return __DIR__.'/../'.$path;
    }

    
    protected function registerRoutes()
    {

        Route::group($this->routeConfiguration(), function() {
            $this->loadRoutesFrom($this->rootDirectory('routes/web.php'));
        });
    }

    private function routeConfiguration()
    {
        return [
            'prefix' => 'larapress'
        ];
    }
}
