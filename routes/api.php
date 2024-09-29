<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Onboarding\OnboardingController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(static function () {
    Route::group([
        'prefix' => 'auth',
        'as'     => 'auth.',
    ], static function () {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout')->middleware('auth:sanctum');
    });

    Route::group([
        'prefix' => 'onboarding',
        'as'     => 'onboarding.',
    ], static function () {
        Route::post('register', OnboardingController::class)->name('register');
    });
});
