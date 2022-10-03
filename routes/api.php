<?php

use App\Helpers\Routes\RouteHelper;
use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')
    ->group(function(){
        RouteHelper::includeRouteFiles(__DIR__.'/api/v1');

        //require the file v1 folder recursively
        // require __DIR__ . '/api/v1/users.php';
        // require __DIR__ . '/api/v1/posts.php';
        // require __DIR__ . '/api/v1/comments.php';
    });



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
