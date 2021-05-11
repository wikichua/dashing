<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'permission'], function () {
        Route::match(['get', 'head'], '', [config('dashing.Controllers.Permission'),'index'])->name('permission');
        Route::match(['get', 'head'], '{permission}/read', [config('dashing.Controllers.Permission'),'show'])->name('permission.show');
        Route::match(['get', 'head'], 'create', [config('dashing.Controllers.Permission'),'create'])->name('permission.create');
        Route::match(['post'], 'create', [config('dashing.Controllers.Permission'),'store'])->name('permission.store');
        Route::match(['get', 'head'], '{permission}/edit', [config('dashing.Controllers.Permission'),'edit'])->name('permission.edit');
        Route::match(['put', 'patch'], '{permission}/edit', [config('dashing.Controllers.Permission'),'update'])->name('permission.update');
        Route::match(['delete'], '{permission}/delete', [config('dashing.Controllers.Permission'),'destroy'])->name('permission.destroy');
    });
});
