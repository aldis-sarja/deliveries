<?php

use App\Http\Controllers\API\v1\DeliveryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\ClientController;

Route::get('/', [ClientController::class, 'index']);
Route::get('/clients/different-deliveries', [ClientController::class, 'getDifferentDeliveries']);
Route::get('/clients/no-liquid-deliveries', [ClientController::class, 'getClientsWithoutLiquidDeliveries']);
Route::get('/clients/{id}/addresses', [ClientController::class, 'getAddresses']);
Route::apiResource('clients', ClientController::class);
Route::get('/deliveries/last', [DeliveryController::class, 'getLastDeliveries']);
