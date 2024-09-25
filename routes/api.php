<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(static function () {
    Route::group([
        'prefix' => 'auth',
        'as'     => 'auth.',
    ], static function () {
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');
        Route::post('logout', 'logout')->name('logout')->middleware('auth:sanctum');
    });
});
