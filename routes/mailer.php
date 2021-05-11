<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'mailer'], function () {
        Route::match(['get', 'head'], '', [config('dashing.Controllers.Mailer'),'index'])->name('mailer');
        Route::match(['get', 'head'], '{mailer}/read', [config('dashing.Controllers.Mailer'),'show'])->name('mailer.show');
        Route::match(['get', 'head'], '{mailer}/edit', [config('dashing.Controllers.Mailer'),'edit'])->name('mailer.edit');
        Route::match(['put', 'patch'], '{mailer}/update', [config('dashing.Controllers.Mailer'),'update'])->name('mailer.update');
        Route::match(['delete'], '{mailer}/delete', [config('dashing.Controllers.Mailer'),'destroy'])->name('mailer.destroy');
        Route::match(['get', 'head'], '{mailer}/preview', [config('dashing.Controllers.Mailer'),'preview'])->name('mailer.preview');
        Route::match(['post'], '{mailer}/preview', [config('dashing.Controllers.Mailer'),'preview'])->name('mailer.preview');
    });
});
