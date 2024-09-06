<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('bar')->get();
        return response()->json($eventos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'url_img' => 'nullable|string|max:255',
            'url_video' => 'nullable|string|max:255',
            'Bar_ID' => 'required|integer|exists:bares,ID'
        ]);

        $evento = Evento::create($request->all());

        return response()->json([
            'message' => 'Evento creado exitosamente',
            'evento' => $evento
        ], 201);
    }

    public function show($id)
    {
        $evento = Evento::with('bar')->find($id);

        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        return response()->json($evento);
    }

    public function update(Request $request, $id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'url_img' => 'nullable|string|max:255',
            'url_video' => 'nullable|string|max:255',
            'Bar_ID' => 'required|integer|exists:bares,ID'
        ]);

        $evento->update($request->all());

        return response()->json([
            'message' => 'Evento actualizado exitosamente',
            'evento' => $evento
        ]);
    }

    public function destroy($id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        }

        $evento->delete();

        return response()->json(['message' => 'Evento eliminado exitosamente']);
    }
}
