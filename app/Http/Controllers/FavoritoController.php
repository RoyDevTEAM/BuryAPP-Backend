<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Bar;
use App\Models\User;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    // Obtener todos los favoritos de un usuario
    public function index(Request $request)
    {
        $userId = $request->user()->id; // Obtener el ID del usuario autenticado
        $favoritos = Favorito::with('bar')->where('user_id', $userId)->get();
        return response()->json($favoritos);
    }

    // Agregar un bar a los favoritos
    public function store(Request $request)
    {
        $request->validate([
            'bar_id' => 'required|exists:bares,ID'
        ]);

        $userId = $request->user()->id; // Obtener el ID del usuario autenticado

        // Crear o encontrar el favorito
        $favorito = Favorito::firstOrCreate(
            ['user_id' => $userId, 'bar_id' => $request->bar_id]
        );

        return response()->json([
            'message' => 'Bar agregado a favoritos',
            'favorito' => $favorito
        ], 201);
    }

    // Eliminar un bar de los favoritos
    public function destroy($id)
    {
        $favorito = Favorito::where('id', $id)->first();

        if (!$favorito) {
            return response()->json(['message' => 'Favorito no encontrado'], 404);
        }

        $favorito->delete();

        return response()->json(['message' => 'Bar eliminado de favoritos']);
    }
}
