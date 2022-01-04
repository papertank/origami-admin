<?php

namespace Origami\Admin;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Origami\Admin\Auth\AdminUserProvider;
use Origami\Admin\Http\Middleware\AuthenticateAdmin;

class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->publishViews();
            $this->publishSourceAssets();
            $this->publishPublicAssets();
        }

        $this->bootRouting();
        $this->bootAuth();
        $this->bootViews();
        $this->bootBlade();
    }

    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin');
    }

    protected function bootBlade()
    {
        Blade::directive('adminStyles', function () {
            return "<?php echo app('Origami\Admin\Admin')->cssAssets(); ?>";
        });

        Blade::directive('adminScripts', function () {
            return "<?php echo app('Origami\Admin\Admin')->javascriptAssets(); ?>";
        });
    }

    protected function bootAuth()
    {
        config([
            'auth.guards.admin' => array_merge([
                'driver' => 'session',
                'provider' => 'admins',
            ], config('auth.guards.admin', [])),
            'auth.providers.admins' => array_merge([
                'driver' => 'admins',
                'model' => config('auth.providers.users.model', \App\Models\User::class),
            ], config('auth.providers.admins', [])),
            'auth.passwords.admins' => array_merge([
                'provider' => 'admins',
                'table' => 'password_resets',
                'expire' => 60,
            ], config('auth.passwords.admins', [])),
        ]);

        Gate::define('access-admin', function ($user) {
            return in_array($user->role, ['admin']);
        });

        Auth::provider('admins', function ($app, array $config) {
            return new AdminUserProvider($app['hash'], $config['model']);
        });

        if (config('admin.impersonating')) {
            $this->app->register('Lab404\Impersonate\ImpersonateServiceProvider');
        }
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');
    }

    protected function bootRouting()
    {
        Route::aliasMiddleware('admin.auth', AuthenticateAdmin::class);

        if (!$this->app->routesAreCached()) {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        }
    }

    protected function publishViews()
    {
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/admin'),
        ], 'admin-views');
    }

    protected function publishSourceAssets()
    {
        $this->publishes([
            __DIR__.'/../resources/js' => resource_path('assets/js'),
            __DIR__.'/../resources/sass' => resource_path('assets/sass'),
        ], 'admin-resources');
    }

    protected function publishPublicAssets()
    {
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/admin'),
        ], 'admin-assets');
    }

    public function register()
    {
        $this->app->instance(Admin::class, new Admin);

        $this->mergeConfigFrom(
            __DIR__.'/../config/admin.php',
            'admin'
        );

        URL::macro('admin', function ($path = null, $extra = [], $secure = null) {
            $prefix = trim(config('admin.path'), '/');
            return URL::to($prefix.'/'.$path, $extra, $secure);
        });
    }
}
