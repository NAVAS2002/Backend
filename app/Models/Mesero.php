<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesero extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_mesero';
    protected $fillable = ['id_usuario', 'nombre', 'turno', 'zona'];

    public function usuario() {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}