<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cocinero extends Model
{
    protected $fillable = ['user_id', 'especialidad'];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
