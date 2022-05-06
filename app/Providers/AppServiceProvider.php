<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;

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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView("pagination::bootstrap-4");
        Paginator::defaultSimpleView("pagination::bootstrap-4");

        Gate::define('AdminAccess', function ($user) {
            if ($user->role_id == '1') {
                return true;
            }
            return false;
        });

        Gate::define('CustomerAccess', function ($user) {
            if ($user->role_id == '2') {
                return true;
            }
            return false;
        });
    }
}
