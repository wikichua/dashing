<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'versionizer'], function () {
        Route::match(['get', 'head'], '', [config('dashing.Controllers.Versionizer'),'index'])->name('versionizer');
        Route::match(['get', 'head'], '{versionizer}/read', [config('dashing.Controllers.Versionizer'),'show'])->name('versionizer.show');
        Route::match(['put', 'patch'], '{versionizer}/revert', [config('dashing.Controllers.Versionizer'),'revert'])->name('versionizer.revert');
        Route::match(['delete'], '{versionizer}/delete', [config('dashing.Controllers.Versionizer'),'destroy'])->name('versionizer.destroy');
    });
});
