<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'logviewer'], function () {
        Route::match(['get', 'head'], '', [config('dashing.Controllers.LogViewer'),'index'])->name('logviewer');
    });
});
