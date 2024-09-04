<?php
// app/Http/Controllers/MesaController.php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    // Obtener todas las mesas
    public function index()
    {
        $mesas = Mesa::with('bar')->get();
        return response()->json($mesas);
    }

    // Crear una nueva mesa
    public function store(Request $request)
    {
        $request->validate([
            'ID' => 'required|integer|unique:mesas,ID',
            'Descripcion' => 'nullable|string|max:500',
            'Precio' => 'required|numeric|min:0',
            'Anticipo' => 'required|numeric|min:0',
            'Bar_ID' => 'nullable|integer|exists:bares,ID',
            'Imagen' => 'nullable|string|max:255' // Validación del nuevo campo
        ]);

        $mesa = Mesa::create($request->all());

        return response()->json([
            'message' => 'Mesa creada exitosamente',
            'mesa' => $mesa
        ], 201);
    }

    // Obtener una mesa por su ID
    public function show($id)
    {
        $mesa = Mesa::with('bar')->find($id);

        if (!$mesa) {
            return response()->json(['message' => 'Mesa no encontrada'], 404);
        }

        return response()->json($mesa);
    }

    // Actualizar una mesa
    public function update(Request $request, $id)
    {
        $mesa = Mesa::find($id);

        if (!$mesa) {
            return response()->json(['message' => 'Mesa no encontrada'], 404);
        }

        $request->validate([
            'Descripcion' => 'nullable|string|max:500',
            'Precio' => 'required|numeric|min:0',
            'Anticipo' => 'required|numeric|min:0',
            'Bar_ID' => 'nullable|integer|exists:bares,ID',
            'Imagen' => 'nullable|string|max:255' // Validación del nuevo campo
        ]);

        $mesa->update($request->all());

        return response()->json([
            'message' => 'Mesa actualizada exitosamente',
            'mesa' => $mesa
        ]);
    }

    // Eliminar una mesa
    public function destroy($id)
    {
        $mesa = Mesa::find($id);

        if (!$mesa) {
            return response()->json(['message' => 'Mesa no encontrada'], 404);
        }

        $mesa->delete();

        return response()->json(['message' => 'Mesa eliminada exitosamente']);
    }
}
