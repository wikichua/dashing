<?php

namespace Wikichua\Dashing;

use App\Providers\RouteServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class DashingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'wikichua');
        $this->loadMiddlewares();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dashing');
        $this->loadComponents();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            $this->bootForConsole();
        }
        $this->configSettings();

        if ((isset(parse_url(config('app.url'))['host']) && parse_url(config('app.url'))['host'] == request()->getHost())) {
            $this->loadWebRoutes();
            $this->gatePermissions();

            Paginator::useBootstrap();
        }
    }
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/dashing.php', 'dashing');
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-impersonate.php', 'impersonate');

        // Register the service the package provides.
        $this->app->singleton('dashing', function ($app) {
            return new Dashing;
        });
        $this->app->register(\Wikichua\Dashing\Providers\HelpServiceProvider::class);
        $this->app->register(\Wikichua\Dashing\Providers\BrandServiceProvider::class);
        $this->app->register(\Wikichua\Dashing\Providers\ValidatorServiceProvider::class);
    }
    public function provides()
    {
        return ['dashing'];
    }
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/dashing.php' => config_path('dashing.php'),
        ], 'dashing.config');

        // Registering package commands.
        $this->commands([
            Console\Commands\Install::class,
            Console\Commands\Report::class,
            Console\Commands\Indexing::class,
            Console\Commands\Config::class,
            Console\Commands\Module::class,
            Console\Commands\Mailer::class,
            Console\Commands\Brand::class,
            Console\Commands\Pusher::class,
            Console\Commands\Component::class,
            Console\Commands\Service::class,
            Console\Commands\Import::class,
            Console\Commands\Export::class,
            Console\Commands\Vhost::class,
        ]);
    }

    protected function loadWebRoutes()
    {
        Route::middleware('web')
            ->prefix(config('dashing.route.root', 'dashboard'))
            ->group(function () {
                // load package routes
                $packageFiles = cache()->rememberForever('setup:dashing-routes-files', function () {
                    $files = File::files(__DIR__.'/../routes');
                    $out = [];
                    foreach ($files as $file) {
                        $out[] = $file->getPathname();
                    }
                    return $out;
                });

                // load app routes
                $appFiles = [];
                if (File::exists(app_path('../routes/dashing'))) {
                    $appFiles = cache()->rememberForever('setup:dashing-routes-files', function () {
                        $files = File::files(app_path('../routes/dashing/'));
                        $out = [];
                        foreach ($files as $file) {
                            $out[] = $file->getPathname();
                        }
                        return $out;
                    });
                }
                $files = array_merge($packageFiles, $appFiles);
                Route::group([], function () use ($files) {
                    foreach ($files as $file) {
                        include_once $file;
                    }
                });
            });

        if (RouteServiceProvider::HOME != config('dashing.route.root', 'dashboard')) {
            Route::redirect(RouteServiceProvider::HOME, config('dashing.route.root', 'dashboard'));
        }
        if (config('dashing.route.root', 'dashboard') != '/') {
            Route::redirect('/', config('dashing.route.root', 'dashboard'));
        }
    }

    protected function loadApiRoutes()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(function () {
                $files = File::files(__DIR__.'/../routes/api/');
                foreach ($files as $file) {
                    include_once $file->getPathname();
                }
                if (File::exists(app_path('../routes/dashing'))) {
                    $files = File::files(app_path('../routes/dashing/'));
                    foreach ($files as $file) {
                        include_once $file->getPathname();
                    }
                }
            });
    }

    protected function loadComponents()
    {
        \Blade::componentNamespace('Wikichua\\Dashing\\View\\Components', 'dashing');
    }

    protected function loadMiddlewares()
    {
        $this->app['router']->aliasMiddleware('intend_url', 'Wikichua\Dashing\Http\Middleware\IntendUrl');
        $this->app['router']->aliasMiddleware('auth', 'Wikichua\Dashing\Http\Middleware\Authenticate');
        $this->app['router']->aliasMiddleware('auth_admin', 'Wikichua\Dashing\Http\Middleware\AuthAdmin');
        $this->app['router']->aliasMiddleware('reauth_admin', 'Wikichua\Dashing\Http\Middleware\ReAuth');
        // $this->app['router']->aliasMiddleware('optimizeImages', 'Spatie\LaravelImageOptimizer\Middlewares\OptimizeImages');

        $this->app['router']->pushMiddlewareToGroup('web', \Wikichua\Dashing\Http\Middleware\PhpDebugBar::class);
        $this->app['router']->pushMiddlewareToGroup('web', \Wikichua\Dashing\Http\Middleware\HttpsProtocol::class);
        $this->app['router']->pushMiddlewareToGroup('web', \Spatie\Honeypot\ProtectAgainstSpam::class);
        $this->app['router']->pushMiddlewareToGroup('web', \Spatie\LaravelImageOptimizer\Middlewares\OptimizeImages::class);
        $this->app['router']->pushMiddlewareToGroup('api', \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class);
    }

    protected function gatePermissions()
    {
        Gate::before(function ($user, $permission) {
            if ($user->hasPermission($permission)) {
                return true;
            }
        });
    }

    protected function configSettings()
    {
        if (Schema::hasTable('settings')) {
            cache()->rememberForever('setup:config-settings', function () {
                $settings = app(config('dashing.Models.Setting'))->all();
                foreach ($settings as $setting) {
                    Config::set('settings.'.$setting->key, $setting->value);
                }
            });
        }
    }
}
