<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ApiController;

Route::apiResource('productos', ProductoController::class);
Route::apiResource('proveedores', ProveedorController::class);

Route::put('/productos/{id}/stock', [ApiController::class, 'modificarStock']);
Route::post('/pagos', [ApiController::class, 'procesarPago']);
Route::post('/envios', [ApiController::class, 'procesarEnvio']);