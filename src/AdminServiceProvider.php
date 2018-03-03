<?php

namespace Origami\Admin;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Origami\Admin\Auth\AdminUserProvider;

class AdminServiceProvider extends ServiceProvider {

    const VERSION = '2.0.0';

    public function boot()
    {
        if ( $this->app->runningInConsole() ) {
            $this->publishConfig();
            $this->publishViews();
            $this->publishSourceAssets();
            $this->publishPublicAssets();
        }

        $this->loadRoutes();
        $this->bootAuth();
    }

    protected function bootAuth()
    {
        Gate::define('access-admin', function($user) {
            return in_array($user->role, ['admin','assessor']);
        });

        Auth::provider('admins', function($app, array $config) {
            return new AdminUserProvider($app['hash'], $config['model']);
        });

        if ( config('admin.impersonating') ) {
            $this->app->register('Lab404\Impersonate\ImpersonateServiceProvider');
        }
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');
    }

    protected function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    protected function publishViews()
    {
        $this->publishes([
            __DIR__.'/../resources/views/admin' => resource_path('views/admin'),
        ], 'admin-views');
    }

    protected function publishSourceAssets()
    {
        $this->publishes([
            __DIR__.'/../resources/assets/js' => resource_path('assets/js'),
            __DIR__.'/../resources/assets/sass' => resource_path('assets/sass'),
        ], 'admin-assets');
    }

    protected function publishPublicAssets()
    {
        $this->publishes([
            __DIR__.'/../public/assets/css' => public_path('assets/css'),
            __DIR__.'/../public/assets/fonts' => public_path('assets/fonts'),
            __DIR__.'/../public/assets/js' => public_path('assets/js'),
        ], 'admin-public');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/admin.php', 'admin'
        );

        URL::macro('admin', function($path = null, $extra = [], $secure = null) {
            $prefix = trim(config('admin.url'), '/');
            return URL::to($prefix.'/'.$path, $extra, $secure);
        });
    }

}
