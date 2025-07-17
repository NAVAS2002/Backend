<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesero extends Model
{
    protected $fillable = ['user_id', 'turno'];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }
}
