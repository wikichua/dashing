<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'setting'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Setting'),'index'])->name('setting');
        Route::match(['get'], '{setting}/read', [config('dashing.Controllers.Setting'),'show'])->name('setting.show');
        Route::match(['get'], 'create', [config('dashing.Controllers.Setting'),'create'])->name('setting.create');
        Route::match(['post'], 'create', [config('dashing.Controllers.Setting'),'store'])->name('setting.store');
        Route::match(['get'], '{setting}/edit', [config('dashing.Controllers.Setting'),'edit'])->name('setting.edit');
        Route::match(['put', 'patch'], '{setting}/edit', [config('dashing.Controllers.Setting'),'update'])->name('setting.update');
        Route::match(['delete'], '{setting}/delete', [config('dashing.Controllers.Setting'),'destroy'])->name('setting.destroy');
    });
});
