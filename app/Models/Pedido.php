<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'mesa_id', 'mesero_id', 'estado'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function mesa() {
        return $this->belongsTo(Mesa::class);
    }

    public function mesero() {
        return $this->belongsTo(Mesero::class);
    }

    public function detalles() {
        return $this->hasMany(DetallePedido::class);
    }

    public function pago() {
        return $this->hasOne(Pago::class);
    }
}
