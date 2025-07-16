<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'id_cliente',
        'id_mesa',
        'fecha_hora',
        'estado',
        'total',
        'id_mesero_entrega',
        'id_cocinero_asignado',
        'id_coctelero_asignado',
        'fecha_entrega',
    ];

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }

    public function cliente()
    {
        return $this->belongsTo(\App\Models\Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function mesa()
    {
        return $this->belongsTo(\App\Models\Mesa::class, 'id_mesa', 'id_mesa');
    }
}
