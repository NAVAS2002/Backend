<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pago';
    protected $fillable = ['id_pedido', 'monto', 'fecha_pago', 'metodo'];

    public function pedido() {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }
}