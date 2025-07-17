<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductoService;
use Illuminate\Http\Request;

class ProductoController extends Controller {
    protected ProductoService $service;

    public function __construct(ProductoService $service) {
        $this->service = $service;
    }

    public function index() {
        return response()->json($this->service->listar(), 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'requiere_preparacion' => 'required|boolean',
            'disponible' => 'required|boolean'
        ]);
        return response()->json($this->service->guardar($validated), 201, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nombre' => 'sometimes|string',
            'precio' => 'sometimes|numeric',
            'descripcion' => 'nullable|string',
            'requiere_preparacion' => 'sometimes|boolean',
            'disponible' => 'sometimes|boolean'
        ]);
        return response()->json($this->service->actualizar($id, $validated), 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function destroy($id) {
        $this->service->eliminar($id);
        return response()->json(['message' => 'Producto eliminado'], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
