<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::match(['get', 'head'], '', [config('dashing.Controllers.User'),'index'])->name('user');
        Route::match(['get', 'head'], '{user}/read', [config('dashing.Controllers.User'),'show'])->name('user.show');
        Route::match(['get', 'head'], 'create', [config('dashing.Controllers.User'),'create'])->name('user.create');
        Route::match(['post'], 'store', [config('dashing.Controllers.User'),'store'])->name('user.store');
        Route::match(['get', 'head'], '{user}/edit', [config('dashing.Controllers.User'),'edit'])->name('user.edit');
        Route::match(['put', 'patch'], '{user}/update', [config('dashing.Controllers.User'),'update'])->name('user.update');
        Route::match(['delete'], '{user}/delete', [config('dashing.Controllers.User'),'destroy'])->name('user.destroy');
        Route::match(['get', 'head'], '{user}/editPassword', [config('dashing.Controllers.User'),'editPassword'])->name('user.editPassword');
        Route::match(['put', 'patch'], '{user}/updatePassword', [config('dashing.Controllers.User'),'updatePassword'])->name('user.updatePassword');

        // pat => personal access token
        Route::group(['prefix' => '{user}/pat'], function () {
            Route::match(['get', 'head'], 'list', [config('dashing.Controllers.PAT'),'index'])->name('pat');
            Route::match(['get', 'head'], 'create', [config('dashing.Controllers.PAT'),'create'])->name('pat.create');
            Route::match(['post'], 'store', [config('dashing.Controllers.PAT'),'store'])->name('pat.store');
            Route::match(['delete'], '{pat}/delete', [config('dashing.Controllers.PAT'),'destroy'])->name('pat.destroy');
        });
    });
});
