<?php

use Illuminate\Http\Request;
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

Route::group([
    'namespace' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('user.login');
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'registration'])->name('user.registration');
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'api', 'prefix' => 'post'], function () {
    Route::get('/', [\App\Http\Controllers\PostController::class, 'showAll'])->name('post.all');
    Route::post('/', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::put('/{post}', [\App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::delete('/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'api', 'prefix' => 'user'], function () {
    Route::post('/', [\App\Http\Controllers\UserController::class, 'create'])->name('post.create');
});

