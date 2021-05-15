<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'component'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Component'),'index'])->name('component');
        Route::match(['get'], '{model}/read', [config('dashing.Controllers.Component'),'show'])->name('component.show');
        Route::match(['post'], '{model}/try', [config('dashing.Controllers.Component'),'try'])->name('component.try');
    });
});
