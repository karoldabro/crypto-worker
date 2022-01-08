<?php

use Illuminate\Support\Facades\Route;
use Kdabrow\CryptoWorker\Http\Controllers\UserController;
use Kdabrow\CryptoWorker\Http\Controllers\WorkerController;
use Kdabrow\CryptoWorker\Http\Controllers\KlineController;
use Kdabrow\CryptoWorker\Http\Controllers\StrategyController;
use Kdabrow\CryptoWorker\Http\Controllers\ExchangeController;

Route::group(['middleware' =>['auth:sanctum', 'bindings'], 'prefix' => 'api/v1/users'], function() {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'destroy']);
});

Route::group(['middleware' =>['auth:sanctum', 'bindings'], 'prefix' => 'api/v1/workers'], function() {
    Route::get('/', [WorkerController::class, 'index']);
    Route::get('/{worker}', [WorkerController::class, 'show']);
    Route::post('/', [WorkerController::class, 'store']);
    Route::put('/{worker}', [WorkerController::class, 'update']);
    Route::delete('/{worker}', [WorkerController::class, 'destroy']);
});

Route::group(['middleware' =>['auth:sanctum', 'bindings'], 'prefix' => 'api/v1/klines'], function() {
    Route::get('/', [KlineController::class, 'index']);
    Route::get('/{kline}', [KlineController::class, 'show']);
    Route::post('/', [KlineController::class, 'store']);
    Route::put('/{kline}', [KlineController::class, 'update']);
    Route::delete('/{kline}', [KlineController::class, 'destroy']);
});

Route::group(['middleware' =>['auth:sanctum', 'bindings'], 'prefix' => 'api/v1/exchanges'], function() {
    Route::get('/', [ExchangeController::class, 'index']);
    Route::get('/{exchange}', [ExchangeController::class, 'show']);
    Route::post('/', [ExchangeController::class, 'store']);
    Route::put('/{exchange}', [ExchangeController::class, 'update']);
    Route::delete('/{exchange}', [ExchangeController::class, 'destroy']);
});

Route::group(['middleware' =>['auth:sanctum', 'bindings'], 'prefix' => 'api/v1/strategies'], function() {
    Route::get('/', [StrategyController::class, 'index']);
    Route::get('/{strategy}', [StrategyController::class, 'show']);
    Route::post('/', [StrategyController::class, 'store']);
    Route::put('/{strategy}', [StrategyController::class, 'update']);
    Route::delete('/{strategy}', [StrategyController::class, 'destroy']);
});