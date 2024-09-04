<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use Illuminate\Http\Request;

class BarController extends Controller
{
    public function index()
    {
        $bares = Bar::with('categoria')->get();
        return response()->json($bares);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID' => 'required|integer|unique:bares,ID',
            'Nombre' => 'required|string|max:100',
            'Descripcion' => 'nullable|string|max:500',
            'Ubicacion' => 'nullable|string|max:255',
            'Telefono' => 'nullable|string|max:20',
            'LogoURL' => 'nullable|string|max:255',
            'Categoria_ID' => 'nullable|integer|exists:categorias,ID'
        ]);

        $bar = Bar::create($request->all());

        return response()->json([
            'message' => 'Bar creado exitosamente',
            'bar' => $bar
        ], 201);
    }

    public function show($id)
    {
        $bar = Bar::with('categoria')->find($id);

        if (!$bar) {
            return response()->json(['message' => 'Bar no encontrado'], 404);
        }

        return response()->json($bar);
    }

    public function update(Request $request, $id)
    {
        $bar = Bar::find($id);

        if (!$bar) {
            return response()->json(['message' => 'Bar no encontrado'], 404);
        }

        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Descripcion' => 'nullable|string|max:500',
            'Ubicacion' => 'nullable|string|max:255',
            'Telefono' => 'nullable|string|max:20',
            'LogoURL' => 'nullable|string|max:255',
            'Categoria_ID' => 'nullable|integer|exists:categorias,ID'
        ]);

        $bar->update($request->all());

        return response()->json([
            'message' => 'Bar actualizado exitosamente',
            'bar' => $bar
        ]);
    }

    public function destroy($id)
    {
        $bar = Bar::find($id);

        if (!$bar) {
            return response()->json(['message' => 'Bar no encontrado'], 404);
        }

        $bar->delete();

        return response()->json(['message' => 'Bar eliminado exitosamente']);
    }
}
