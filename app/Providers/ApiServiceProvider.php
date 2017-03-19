<?php

namespace App\Providers;

use App\Contracts\ApiUser;
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
        App()->bind('ApiUser', function() {
           $user = auth()->user();
           if (! $user) {
               return null;
           }

           return User::find($user->id);
        });
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
