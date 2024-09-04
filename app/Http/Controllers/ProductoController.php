<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Obtener todos los productos
    public function index()
    {
        $productos = Producto::with('bar')->get();
        return response()->json($productos);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'ID' => 'required|integer|unique:producto,ID',
            'Nombre' => 'required|string|max:100',
            'Precio' => 'required|numeric|min:0',
            'Descripcion' => 'nullable|string|max:500',
            'Bar_ID' => 'nullable|integer|exists:bares,ID'
        ]);

        $producto = Producto::create($request->all());

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'producto' => $producto
        ], 201);
    }

    // Obtener un producto por su ID
    public function show($id)
    {
        $producto = Producto::with('bar')->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Precio' => 'required|numeric|min:0',
            'Descripcion' => 'nullable|string|max:500',
            'Bar_ID' => 'nullable|integer|exists:bares,ID'
        ]);

        $producto->update($request->all());

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'producto' => $producto
        ]);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado exitosamente']);
    }
}
