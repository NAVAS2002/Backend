<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $fillable = ['codigo', 'capacidad', 'disponible'];

    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }
}
