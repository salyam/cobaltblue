<?php

namespace Salyam\CobaltBlue;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        //$this->loadViewsFrom(__DIR__ . '/views', 'cobaltblue');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/salyam/cobaltblue'),
        ]);

        $this->RegisterBladeDirectives();
    }

    private function RegisterBladeDirectives()
    {
        Blade::if('role',
            function($roleName)
            {
                $user = auth()->user();
                if($user == null)
                    return false;
                return $user->HasRole($roleName);
            }
        );

        Blade::if('permission',
            function($permissionName)
            {
                $user = auth()->user();
                if($user == null)
                    return false;
                return $user->HasPermission($permissionName);
            }
        );

    }
}
