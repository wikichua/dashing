<?php

namespace Wikichua\Dashing\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class BrandServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $brand_path = base_path('brand');
        if (Schema::hasTable('brands') && File::isDirectory($brand_path)) {
            if (app()->runningInConsole() || (isset(parse_url(config('app.url'))['host']) && parse_url(config('app.url'))['host'] == request()->getHost())) { // load from admin route
                $dirs = File::directories($brand_path);
                foreach ($dirs as $dir) {
                    if (File::exists($dir.'/routes/web.php')) {
                        $this->loadRoutesFrom($dir.'/routes/web.php');
                    }
                    if (File::isDirectory($dir.'/database/migrations')) {
                        $this->loadMigrationsFrom($dir.'/database/migrations');
                    }
                    // load admin routes in brand
                    if (File::exists($dir.'/routes/admin')) {
                        $files = cache()->rememberForever('setup-dashing-brands-routes-files', function () use ($dir) {
                            $files = File::files($dir.'/routes/admin/');
                            $out = [];
                            foreach ($files as $file) {
                                $out[] = $file->getPathname();
                            }
                            if (File::exists($dir.'/routes/admin/api')) {
                                $files = File::files($dir.'/routes/admin/api/');
                                foreach ($files as $file) {
                                    $out[] = $file->getPathname();
                                }
                            }
                            return $out;
                        });
                        foreach ($files as $file) {
                            $this->loadRoutesFrom($file);
                        }
                    }
                }
                app(config('dashing.Models.Brand'))->query()->whereStatus('A')->where('expired_at', '<', date('Y-m-d 23:59:59'))->update(['status' => 'E']);
            } else {
                // $this->loadBrandStuffs();
                $this->registerBrandServiceProviders();
            }
        }
    }

    protected function registerBrandServiceProviders()
    {
        if (File::exists(base_path('brand'))) {
            $brandName = \Help::getBrandNameByHost(request()->getHost());
            $brandPublished = \Help::getPublishedBrand($brandName);
            $dir = base_path('brand/'.$brandPublished->name);
            if ($brandPublished && File::isDirectory($dir.'/Providers')) {
                $files = File::files($dir.'/Providers');
                foreach ($files as $file) {
                    [$namespace, $class] = array_values(preg_grep('/class|namespace/', explode(PHP_EOL, File::get($file->getPathname()))));
                    $class = explode(' ', $class)[1];
                    $namespace = '\\'.str_replace(['namespace ', ';'], '', $namespace).'\\'.$class;
                    $this->app->register($namespace);
                }
            }
            $this->loadMigrationsFrom($dir.'/database');
        }
    }

    /*protected function loadBrandStuffs()
    {
        if (File::exists(base_path('brand'))) {
            $brandName = \Help::getBrandNameByHost(request()->getHost());
            $brand = \Help::brand($brandName);
            if ($brand) {
                $dir = base_path('brand/'.$brand->name);
                if (File::exists($dir.'/routes/web.php')) {
                    $this->registerBrandServiceProviders($dir);
                    // $dotenv = \Dotenv\Dotenv::createImmutable($dir, '.env');
                    // $dotenv->load();
                    // $this->app->loadEnvironmentFrom($dir.'/.env');
                    // \Route::middleware('web')->group($dir.'/routes/web.php');
                    // $this->loadTranslationsFrom($dir.'/lang', $brandName);
                    // $this->loadViewsFrom($dir, $brandName);
                }
            }
        }
    }*/
}
