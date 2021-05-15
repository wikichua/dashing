<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'mailer'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Mailer'),'index'])->name('mailer');
        Route::match(['get'], '{mailer}/read', [config('dashing.Controllers.Mailer'),'show'])->name('mailer.show');
        Route::match(['get'], '{mailer}/edit', [config('dashing.Controllers.Mailer'),'edit'])->name('mailer.edit');
        Route::match(['put', 'patch'], '{mailer}/edit', [config('dashing.Controllers.Mailer'),'update'])->name('mailer.update');
        Route::match(['delete'], '{mailer}/delete', [config('dashing.Controllers.Mailer'),'destroy'])->name('mailer.destroy');
        Route::match(['get'], '{mailer}/preview', [config('dashing.Controllers.Mailer'),'preview'])->name('mailer.preview');
        Route::match(['post'], '{mailer}/preview', [config('dashing.Controllers.Mailer'),'preview'])->name('mailer.preview');
    });
});
