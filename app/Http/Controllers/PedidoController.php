<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PedidoService;

class PedidoController extends Controller
{
    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function index(Request $request)
    {
        return $this->pedidoService->listarPedidosPorRol($request->user());
    }

    public function actualizarEstado(Request $request, $id)
    {
        return $this->pedidoService->actualizarEstadoPedido($request, $id, $request->user());
    }

    public function misPedidos(Request $request)
    {
        return $this->pedidoService->listarPedidosPorMesa($request->query('mesa'));
    }
}
