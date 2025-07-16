<?php

namespace App\Services;

use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PedidoService
{
    public function crearPedido(array $data): Pedido
    {
        return DB::transaction(function () use ($data) {
            $pedido = Pedido::create([
                'id_cliente' => $data['id_cliente'],
                'id_mesa' => $data['id_mesa'],
                'fecha_hora' => Carbon::now(),
                'estado' => 'pendiente', // quizá cambiar a 'recibido' para armonizar estados
                'total' => 0,
                'id_mesero_entrega' => null,
                'id_cocinero_asignado' => null,
                'id_coctelero_asignado' => null,
                'fecha_entrega' => null,
            ]);

            $total = 0;

            foreach ($data['productos'] as $item) {
                $producto = \App\Models\Producto::findOrFail($item['id_producto']);
                $subtotal = $producto->precio * $item['cantidad'];
                $total += $subtotal;

                $pedido->detalles()->create([
                    'id_producto' => $producto->id_producto,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal
                ]);
            }

            $pedido->update(['total' => $total]);

            return $pedido->load('detalles');
        });
    }

    public function listarPedidosPorRol($user)
    {
        if ($user->rol === 'cocinero') {
            $pedidos = Pedido::whereIn('estado', ['recibido', 'en preparacion'])
                ->where(function ($q) use ($user) {
                    $q->where('id_cocinero_asignado', $user->id_usuario)
                      ->orWhereNull('id_cocinero_asignado');
                })
                ->orderBy('fecha_hora')
                ->get();
        } elseif ($user->rol === 'mesero') {
            $pedidos = Pedido::whereIn('estado', ['recibido', 'en preparacion', 'listo', 'entregado'])
                ->orderBy('fecha_hora')
                ->get();
        } else {
            abort(403, 'No autorizado');
        }

        return response()->json(['data' => $pedidos]);
    }

    public function actualizarEstadoPedido($request, $id, $user)
    {
        $pedido = Pedido::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'estado' => 'required|in:recibido,en preparacion,listo,entregado,finalizado',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $estado = $request->estado;

        if ($user->rol === 'cocinero') {
            if (!in_array($estado, ['en preparacion', 'listo'])) {
                return response()->json(['error' => 'Estado no permitido para cocinero'], 403);
            }

            if (!$pedido->id_cocinero_asignado) {
                $pedido->id_cocinero_asignado = $user->id_usuario;
            }
        } elseif ($user->rol === 'mesero') {
            if (!in_array($estado, ['entregado', 'finalizado'])) {
                return response()->json(['error' => 'Estado no permitido para mesero'], 403);
            }

            if ($estado === 'entregado') {
                $pedido->id_mesero_entrega = $user->id_usuario;
                $pedido->fecha_entrega = Carbon::now();
            }
        } else {
            abort(403, 'No autorizado');
        }

        $pedido->estado = $estado;
        $pedido->save();

        return response()->json(['message' => 'Estado actualizado correctamente', 'pedido' => $pedido]);
    }

    public function listarPedidosPorMesa($mesaId)
    {
        if (!$mesaId) {
            return response()->json(['error' => 'Debe indicar una mesa'], 400);
        }

        $pedidos = Pedido::where('id_mesa', $mesaId)
            ->orderBy('fecha_hora', 'desc')
            ->get();

        return response()->json(['data' => $pedidos]);
    }
}
