<?php

use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([
    //    'auth:api',
    ])
        ->name('users.')
        ->namespace("\App\Http\Controllers")
        ->group(function () {
            Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])
                ->name('index')
                ->withoutMiddleware('auth');
    
            Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])
                ->name('show')
                ->whereNumber('user');
    
            Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('store');
    
            Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('update');
    
            Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');
        });

//Route::resource('users' , UserController::class);
// Route::apiResource('users' , UserController::class);

// Array syntax
// Route::group([
//     'middleware'=>[
//         'auth',
//     ],
//     'prefix'=>'laravel',
//     'as'=>'users.',
//     'namespace'=>"\App\Http\Controller",
// ], function(){
//     Route::get('/users' , [UserController::class, 'index'])->name('index');
//     Route::get('/users/{user}' , [UserController::class, 'show'])->name('show');
//     Route::post('/users' , [UserController::class, 'store'])->name('store');
//     Route::patch('/users/{user}' , [UserController::class, 'update'])->name('update');
//     Route::delete('/users/{user}' , [UserController::class, 'destroy'])->name('destroy');
// });

// Method syntax
// Route::middleware('auth')
//     ->as('users.')
//     ->group(function(){
//     Route::get('/users' , [UserController::class, 'index'])
//         ->name('index')
//         ->withoutMiddleware('auth'); //if you don't need to add middleware to this route we will use withoutMiddleware
//     Route::get('/users/{user}' , [UserController::class, 'show'])
//         ->name('show')
//         ->where('user' , '[0-9]+')// if you need to attach constraint to the url prameter in this case i need user parameter to be integr match to this regilarexpression [0-9]
//         ->withoutMiddleware('auth');

//     Route::post('/users' , [UserController::class, 'store'])
//     ->name('store')
//     ->withoutMiddleware('auth');
//     Route::patch('/users/{user}' , [UserController::class, 'update'])->name('update');
//     Route::delete('/users/{user}' , [UserController::class, 'destroy'])->name('destroy');

// });

