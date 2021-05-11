<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'page'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Page'),'index'])->name('page');
        Route::match(['get'], '{page}/read', [config('dashing.Controllers.Page'),'show'])->name('page.show');
        Route::match(['get'], '{page}/preview', [config('dashing.Controllers.Page'),'preview'])->name('page.preview');
        Route::match(['get'], 'create', [config('dashing.Controllers.Page'),'create'])->name('page.create');
        Route::match(['post'], 'store', [config('dashing.Controllers.Page'),'store'])->name('page.store');
        Route::match(['get'], '{page}/edit', [config('dashing.Controllers.Page'),'edit'])->name('page.edit');
        Route::match(['put', 'patch'], '{page}/update', [config('dashing.Controllers.Page'),'update'])->name('page.update');
        Route::match(['delete'], '{page}/delete', [config('dashing.Controllers.Page'),'destroy'])->name('page.destroy');
        Route::match(['get'], '{brand_id}/templates', [config('dashing.Controllers.Page'),'templates'])->name('page.templates');
        Route::match(['post'], '{page}/replicate', [config('dashing.Controllers.Page'),'replicate'])->name('page.replicate');
        Route::match(['get'], '{page}/migration', [config('dashing.Controllers.Page'),'migration'])->name('page.migration');
    });
});
