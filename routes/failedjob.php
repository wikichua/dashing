<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'failed_job'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.FailedJob'),'index'])->name('failedjob');
        Route::match(['get'], '{failedjob}/read', [config('dashing.Controllers.FailedJob'),'show'])->name('failedjob.show');
        Route::match(['post'], '{failedjob}/retry', [config('dashing.Controllers.FailedJob'),'retry'])->name('failedjob.retry');
    });
});
