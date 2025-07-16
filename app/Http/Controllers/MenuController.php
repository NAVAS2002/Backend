<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrearPedidoRequest;
use App\Models\Producto;
use App\Services\PedidoService;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function index(): JsonResponse
    {
        $productos = Producto::where('disponible', true)->get();

        return response()->json([
            'status' => 'success',
            'data' => $productos
        ], 200);
    }

    public function crearPedido(CrearPedidoRequest $request): JsonResponse
    {
        try {
            $pedido = $this->pedidoService->crearPedido($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Pedido creado correctamente.',
                'data' => $pedido
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el pedido: ' . $e->getMessage()
            ], 500);
        }
    }
}
