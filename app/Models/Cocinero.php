<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocinero extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cocinero';
    protected $fillable = ['id_usuario', 'nombre', 'turno', 'especialidad'];

    public function usuario() {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}