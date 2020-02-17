<?php

namespace Salyam\CobaltBlue;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class CobaltBlueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['router']->middleware('role', '\Salyam\CobaltBlue\MiddleWares\RoleMiddleware');
        $this->app['router']->middleware('permission', '\Salyam\CobaltBlue\MiddleWares\PermissionMiddleware');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'cobaltblue');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/salyam/cobaltblue'),
        ]);

        $this->RegisterBladeDirectives();
    }

    private function RegisterBladeDirectives()
    {
        Blade::if('role',
            function($roleName) {
                return Auth::check() && Auth::user()->HasRole($roleName);
            }
        );

        Blade::if('permission',
            function($permissionName) {
                return Auth::check() && Auth::user()->HasPermission($permissionName);
            }
        );

    }
}
