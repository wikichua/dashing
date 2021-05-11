<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth_admin', 'can:access-admin-panel']], function () {
    Route::group(['prefix' => 'file'], function () {
        Route::match(['post'], 'directories', [config('dashing.Controllers.File'),'directories'])->name('folder.directories');
        Route::match(['put'], 'directories/make/{path?}', [config('dashing.Controllers.File'),'make'])->name('folder.make');
        Route::match(['put'], 'directories/{path?}/rename', [config('dashing.Controllers.File'),'change'])->name('folder.change');
        Route::match(['put'], 'directories/{path?}/clone', [config('dashing.Controllers.File'),'clone'])->name('folder.clone');
        Route::match(['delete'], 'directories/{path?}/remove', [config('dashing.Controllers.File'),'remove'])->name('folder.remove');

        // Route::match(['get', 'head'], '{file}/read', [config('dashing.Controllers.File'),'show'])->name('file.show');

        Route::match(['get', 'head'], '/{path?}', [config('dashing.Controllers.File'),'index'])->name('file');
        Route::match(['post'], 'upload/{path?}', [config('dashing.Controllers.File'),'upload'])->name('file.upload');
        Route::match(['put', 'patch'], '{path?}/rename', [config('dashing.Controllers.File'),'rename'])->name('file.rename');
        Route::match(['put', 'patch'], '{path?}/duplicate', [config('dashing.Controllers.File'),'duplicate'])->name('file.duplicate');
        Route::match(['delete'], '{path?}/delete', [config('dashing.Controllers.File'),'destroy'])->name('file.destroy');
    });
});
