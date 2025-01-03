<?php

use App\Http\Controllers\ACL\PermissionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\CustomerController;
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

    Route::middleware('auth:sanctum')->group(static function () {
        Route::group([
            'prefix' => 'acl',
            'as'     => 'acle.',
        ], static function () {
            Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
            Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
            Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
            Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
        });

        Route::group([
            'prefix' => 'customers',
            'as'     => 'customers.',
        ], static function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::post('/', [CustomerController::class, 'store'])->name('store');
            Route::get('{customer}', [CustomerController::class, 'show'])->name('show');
            Route::put('{customer}', [CustomerController::class, 'update'])->name('update');
            Route::delete('{customer}', [CustomerController::class, 'destroy'])->name('destroy');
        });
    });
});
