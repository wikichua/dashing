<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'cronjob'], function () {
        Route::match(['get', 'head'], '', [config('dashing.Controllers.Cronjob'),'index'])->name('cronjob');
        Route::match(['get', 'head'], '{cronjob}/read', [config('dashing.Controllers.Cronjob'),'show'])->name('cronjob.show');
        Route::match(['get', 'head'], 'create', [config('dashing.Controllers.Cronjob'),'create'])->name('cronjob.create');
        Route::match(['post'], 'create', [config('dashing.Controllers.Cronjob'),'store'])->name('cronjob.store');
        Route::match(['get', 'head'], '{cronjob}/edit', [config('dashing.Controllers.Cronjob'),'edit'])->name('cronjob.edit');
        Route::match(['put', 'patch'], '{cronjob}/edit', [config('dashing.Controllers.Cronjob'),'update'])->name('cronjob.update');
        Route::match(['delete'], '{cronjob}/delete', [config('dashing.Controllers.Cronjob'),'destroy'])->name('cronjob.destroy');
    });
});
