<?php

use App\Http\Controllers\API\v1\DeliveryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\ClientController;

Route::get('/', [ClientController::class, 'index']);
Route::get('/clients/different-deliveries', [ClientController::class, 'getDifferentDeliveries']);
Route::get('/clients/filter', [ClientController::class, 'getClientsByFilter']);
Route::get('/clients/{id}/addresses', [ClientController::class, 'getAddresses']);
Route::apiResource('clients', ClientController::class);
Route::get('/deliveries/last', [DeliveryController::class, 'getLastDeliveries']);
