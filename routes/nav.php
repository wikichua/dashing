<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'nav'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Nav'),'index'])->name('nav');
        Route::match(['get'], '{nav}/read', [config('dashing.Controllers.Nav'),'show'])->name('nav.show');
        Route::match(['get'], 'create', [config('dashing.Controllers.Nav'),'create'])->name('nav.create');
        Route::match(['post'], 'store', [config('dashing.Controllers.Nav'),'store'])->name('nav.store');
        Route::match(['get'], '{nav}/edit', [config('dashing.Controllers.Nav'),'edit'])->name('nav.edit');
        Route::match(['put', 'patch'], '{nav}/update', [config('dashing.Controllers.Nav'),'update'])->name('nav.update');
        Route::match(['delete'], '{nav}/delete', [config('dashing.Controllers.Nav'),'destroy'])->name('nav.destroy');
        Route::match(['get'], '{brand_id}/pages', [config('dashing.Controllers.Nav'),'pages'])->name('nav.pages');
        Route::match(['post'], '{nav}/replicate', [config('dashing.Controllers.Nav'),'replicate'])->name('nav.replicate');
        Route::match(['get'], 'orderable/{groupValue?}/{brand_id?}', [config('dashing.Controllers.Nav'),'orderable'])->name('nav.orderable');
        Route::match(['post'], 'orderable/{groupValue?}/{brand_id?}', [config('dashing.Controllers.Nav'),'orderableUpdate'])->name('nav.orderableUpdate');
        Route::match(['get'], '{nav}/migration', [config('dashing.Controllers.Nav'),'migration'])->name('nav.migration');
    });
});
