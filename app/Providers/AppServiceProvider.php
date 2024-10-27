<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // set timezone menggunakan waktu indonesia
        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');

        // setting level user
        Gate::define('admin', function (User $user) {
            return $user->role == "admin";
        });
        Gate::define('user', function (User $user) {
            return $user->role == "user";
        });
    }
}
