<?php


namespace Eyadhamza\MyFirstPackage;


use Illuminate\Support\ServiceProvider;

class LaravelBadgesServiceProvider extends ServiceProvider
{
    public function register()
    {

    }
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/create_badges_table.php',
            database_path('migrations/'.date('Y-m-d-His').'_create_badges_table.php')
        ]);
    }

}
