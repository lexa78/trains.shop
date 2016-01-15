<?php
namespace App\MyDesigns\ServiceProviders;


use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('App\MyDesigns\Interfaces\ProductRepositoryInterface', 'App\MyDesigns\Repositories\ProductRepository');
    }
}