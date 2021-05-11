<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    if (class_exists('\UniSharp\LaravelFilemanager\Lfm')) {
        Route::group(['prefix' => 'laravel-filemanager'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });
    }

    Route::group(['prefix' => ''], function () {
        Route::match(['get', 'head'], '/', [config('dashing.Controllers.Dashboard'),'index'])->name('dashboard');
        Route::match(['get', 'head'], '/lfm', [config('dashing.Controllers.Dashboard'),'lfm'])->name('lfm.home');
        Route::match(['get', 'head'], '/seo', [config('dashing.Controllers.Dashboard'),'seo'])->name('seo.home');
        Route::match(['get', 'head'], '/opcache', [config('dashing.Controllers.Dashboard'),'opcache'])->name('opcache.home');
        Route::match(['get', 'head'], '/wiki/{file?}', [config('dashing.Controllers.Dashboard'),'wiki'])->name('wiki.home');
    });
});
