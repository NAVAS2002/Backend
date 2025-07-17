<?php
namespace App\Repositories;

use App\Models\Producto;
use App\Repositories\BaseRepository;

class ProductoRepository extends BaseRepository {
    public function __construct(Producto $producto) {
        $this->model = $producto;
    }
}