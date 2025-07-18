<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'precio', 'descripcion', 'requiere_preparacion', 'disponible'];

    public function detallePedidos() {
        return $this->hasMany(DetallePedido::class);
    }
}
