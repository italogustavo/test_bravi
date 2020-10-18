<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Validators
        Validator::extend('user_client', function ($attribute, $value, $parameters, $validator) {
            $user = User::find($value);
            if ($user) {
                return $user->type == 'client';
            }
            return true;
        }, 'The selected user id is not from client type.');
    }
}
