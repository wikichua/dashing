<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'role'], function () {
        Route::match(['get'], '', [config('dashing.Controllers.Role'),'index'])->name('role');
        Route::match(['get'], '{role}/read', [config('dashing.Controllers.Role'),'show'])->name('role.show');
        Route::match(['get'], 'create', [config('dashing.Controllers.Role'),'create'])->name('role.create');
        Route::match(['post'], 'create', [config('dashing.Controllers.Role'),'store'])->name('role.store');
        Route::match(['get'], '{role}/edit', [config('dashing.Controllers.Role'),'edit'])->name('role.edit');
        Route::match(['put', 'patch'], '{role}/edit', [config('dashing.Controllers.Role'),'update'])->name('role.update');
        Route::match(['delete'], '{role}/delete', [config('dashing.Controllers.Role'),'destroy'])->name('role.destroy');
    });
});
