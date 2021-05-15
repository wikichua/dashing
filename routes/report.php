<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'report'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Report'),'index'])->name('report');
        Route::match(['get'], '{report}/read', [config('dashing.Controllers.Report'),'show'])->name('report.show');
        Route::match(['post'], '{report}/export', [config('dashing.Controllers.Report'),'export'])->name('report.export');
        Route::match(['get'], 'create', [config('dashing.Controllers.Report'),'create'])->name('report.create');
        Route::match(['post'], 'create', [config('dashing.Controllers.Report'),'store'])->name('report.store');
        Route::match(['get'], '{report}/edit', [config('dashing.Controllers.Report'),'edit'])->name('report.edit');
        Route::match(['put', 'patch'], '{report}/edit', [config('dashing.Controllers.Report'),'update'])->name('report.update');
        Route::match(['delete'], '{report}/delete', [config('dashing.Controllers.Report'),'destroy'])->name('report.destroy');
    });
});
