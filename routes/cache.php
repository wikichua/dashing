<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'cache'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Cache'),'index'])->name('cache');
        Route::match(['get'], '{cache}/read', [config('dashing.Controllers.Cache'),'show'])->name('cache.show');
        Route::match(['put', 'patch'], '{cache}/revert', [config('dashing.Controllers.Cache'),'revert'])->name('cache.revert');
        Route::match(['delete'], '{cache}/delete', [config('dashing.Controllers.Cache'),'destroy'])->name('cache.destroy');
    });
});
