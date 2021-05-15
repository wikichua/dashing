<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'carousel'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Carousel'),'index'])->name('carousel');
        Route::match(['get'], '{model}/read', [config('dashing.Controllers.Carousel'),'show'])->name('carousel.show');
        Route::match(['get'], 'create', [config('dashing.Controllers.Carousel'),'create'])->name('carousel.create');
        Route::match(['post'], 'create', [config('dashing.Controllers.Carousel'),'store'])->name('carousel.store');
        Route::match(['get'], '{model}/edit', [config('dashing.Controllers.Carousel'),'edit'])->name('carousel.edit');
        Route::match(['put', 'patch'], '{model}/edit', [config('dashing.Controllers.Carousel'),'update'])->name('carousel.update');
        Route::match(['delete'], '{model}/delete', [config('dashing.Controllers.Carousel'),'destroy'])->name('carousel.destroy');
        Route::match(['get'], 'orderable/{groupValue?}/{brand_id?}', [config('dashing.Controllers.Carousel'),'orderable'])->name('carousel.orderable');
        Route::match(['post'], 'orderable/{groupValue?}/{brand_id?}', [config('dashing.Controllers.Carousel'),'orderableUpdate'])->name('carousel.orderableUpdate');
    });
});
