<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware([
//    'auth:api',
])
    ->name('posts.')
    ->namespace("\App\Http\Controllers")
    ->group(function () {
        Route::get('/posts', [PostController::class, 'index'])
            ->name('index');

        Route::get('/posts/{post}', [PostController::class, 'show'])
            ->name('show')
            ->whereNumber('post');

        Route::post('/posts', [PostController::class, 'store'])->name('store');

        Route::patch('/posts/{post}', [PostController::class, 'update'])->name('update');

        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('destroy');

        Route::post('/posts/{post}/share', [PostController::class, 'share'])->name('share');

    });

