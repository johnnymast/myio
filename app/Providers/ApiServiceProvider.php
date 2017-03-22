<?php

namespace App\Providers;

use App\Contracts\ApiUser;
use App\User;
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
        App()->bind('ApiUser', function () {
            $user = auth()->user();
            if (! $user) {
                return;
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
