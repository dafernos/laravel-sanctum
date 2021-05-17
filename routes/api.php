<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiscController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

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

//Route Login and register
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'login']);

//Routes Authenticated
Route::middleware(['auth:sanctum'])->group(function() {

    //Route get user
    Route::get('user', [UserController::class, 'getUser']);

    //Routes Discs
    Route::get('discs', [DiscController::class,'list']);
    Route::get('disc/{id}', [DiscController::class,'findById']);

    //Routes Genres
    Route::get('genres', [GenreController::class,'list']);
    Route::get('genre/{id}', [GenreController::class,'findById']);

    //Routes Admin CRUD
    Route::group(['prefix' => 'admin/'], function () {
        Route::apiResource('genre', GenreController::class)
            ->only([ 'store', 'update', 'destroy']);
        Route::apiResource('disc', DiscController::class)
            ->only(['store', 'update', 'destroy']);
    });

    //Route Logout
    Route::post('logout', [LoginController::class, 'logout']);
});
