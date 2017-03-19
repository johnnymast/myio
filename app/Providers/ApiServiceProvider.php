<?php

namespace App\Providers;

use App\Http\Controllers\Api\LinksController;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
