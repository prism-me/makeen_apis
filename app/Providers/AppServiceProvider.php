<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Support\MyString;
use App\Support\BunnyCdn;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('mylibrary',function($app){
            return new MyString;
        });
        // $this->app->bind('cdnlibrary',function($app){
        //     return new BunnyCdn;
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
