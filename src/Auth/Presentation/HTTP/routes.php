<?php


use Illuminate\Support\Facades\Route;
use Src\Auth\Presentation\HTTP\AuthController;
use Src\Common\Infrastructure\Laravel\Middleware\JwtMiddleware;

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::group([
        'middleware' => [JwtMiddleware::class],
    ], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});
