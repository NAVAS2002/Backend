<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\AuthApiController;

Route::get('/menu', function () {
    $productos = \App\Models\Producto::where('disponible', true)->get();
    return response()->json(['productos' => $productos]);
});


Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/registro', [AuthApiController::class, 'registrar']);

Route::middleware('auth:sanctum')->post('/logout', [AuthApiController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pedidos', [PedidoController::class, 'index']);
    Route::put('/pedidos/{id}/estado', [PedidoController::class, 'actualizarEstado']);
    Route::get('/mis-pedidos', [PedidoController::class, 'misPedidos']);
});

Route::prefix('menu')->group(function () {
    Route::get('/', [MenuController::class, 'index']);
    Route::post('/pedido', [MenuController::class, 'crearPedido']);
});

