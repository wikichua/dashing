<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::match(['get', 'head'], '', [config('dashing.Controllers.Profile'),'show'])->name('profile');
        Route::match(['get', 'head'], 'edit', [config('dashing.Controllers.Profile'),'edit'])->name('profile.edit');
        Route::match(['put', 'patch'], 'update', [config('dashing.Controllers.Profile'),'update'])->name('profile.update');
        Route::match(['put', 'patch'], 'updatePassword', [config('dashing.Controllers.Profile'),'updatePassword'])->name('profile.updatePassword');
    });
});
