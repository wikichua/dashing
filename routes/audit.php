<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'audit'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Audit'),'index'])->name('audit');
        Route::match(['get'], '{audit}/read', [config('dashing.Controllers.Audit'),'show'])->name('audit.show');
        Route::match(['put', 'patch'], '{alert}/set/read', [config('dashing.Controllers.Audit'),'setRead'])->name('alert.set.read');
    });
});
