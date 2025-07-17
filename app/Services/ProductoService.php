<?php
namespace App\Services;

use App\Repositories\ProductoRepository;

class ProductoService {
    protected ProductoRepository $repo;

    public function __construct(ProductoRepository $repo) {
        $this->repo = $repo;
    }

    public function listar() {
        return $this->repo->all();
    }

    public function guardar(array $data) {
        return $this->repo->create($data);
    }

    public function actualizar($id, array $data) {
        return $this->repo->update($id, $data);
    }

    public function eliminar($id) {
        return $this->repo->delete($id);
    }
}
