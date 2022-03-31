<?php

namespace Farazasifali\Blog;

use Farazasifali\Blog\Console\InstallBlog;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Method to bind the application based
     * classes to laravel singleton container
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Laravel self invoking method to be triggered
     * after this service provider registered
     * method
     *
     */
    public function boot()
    {
        //If application is running in console
        if($this->app->runningInConsole())
        {
            $this->commands([
                InstallBlog::class
            ]);
        }
    }
}
