<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'pusher'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Pusher'),'index'])->name('pusher');
        Route::match(['get'], '{pusher}/read', [config('dashing.Controllers.Pusher'),'show'])->name('pusher.show');
        Route::match(['get'], 'create', [config('dashing.Controllers.Pusher'),'create'])->name('pusher.create');
        Route::match(['post'], 'create', [config('dashing.Controllers.Pusher'),'store'])->name('pusher.store');
        Route::match(['get'], '{pusher}/edit', [config('dashing.Controllers.Pusher'),'edit'])->name('pusher.edit');
        Route::match(['put', 'patch'], '{pusher}/edit', [config('dashing.Controllers.Pusher'),'update'])->name('pusher.update');
        Route::match(['delete'], '{pusher}/delete', [config('dashing.Controllers.Pusher'),'destroy'])->name('pusher.destroy');
        Route::match(['post'], 'push/{pusher}', [config('dashing.Controllers.Pusher'),'push'])->name('pusher.push');
    });
});
