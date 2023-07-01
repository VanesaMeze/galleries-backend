<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('refresh', 'refresh');
    Route::post('logout', 'logout');
});

Route::controller(GalleriesController::class)->group(function () {
    Route::get('galleries', 'index');
    Route::get('galleries/{id}', 'show');
    Route::post('galleries', 'store');
    Route::put('galleries/{id}', 'update');
    Route::delete('galleries/{id}', 'destroy');
});

Route::controller(CommentsController::class)->group(function () {
    Route::get('comments', 'index');
    Route::post('galleries/{id}/comments', 'store');
    Route::delete('comments/{id}', 'destroy');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('users', 'index');
    Route::get('users/{id}', 'show');
    Route::get('users/{userId}/galleries', 'getUserGalleries');

});