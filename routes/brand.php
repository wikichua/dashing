<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'brand'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Brand'),'index'])->name('brand');
        Route::match(['get'], '{model}/read', [config('dashing.Controllers.Brand'),'show'])->name('brand.show');
        Route::match(['get'], '{model}/edit', [config('dashing.Controllers.Brand'),'edit'])->name('brand.edit');
        Route::match(['put', 'patch'], '{model}/edit', [config('dashing.Controllers.Brand'),'update'])->name('brand.update');
    });
});
