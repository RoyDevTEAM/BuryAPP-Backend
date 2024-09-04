<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    // Obtener todos los horarios
    public function index()
    {
        $horarios = Horario::with('bar')->get();
        return response()->json($horarios);
    }

    // Crear un nuevo horario
    public function store(Request $request)
    {
        $request->validate([
            'ID' => 'required|integer|unique:horarios,ID',
            'Dia' => 'required|string|max:20',
            'HoraApertura' => 'required|date_format:H:i',
            'HoraCierre' => 'required|date_format:H:i|after:HoraApertura',
            'Bar_ID' => 'nullable|integer|exists:bares,ID'
        ]);

        $horario = Horario::create($request->all());

        return response()->json([
            'message' => 'Horario creado exitosamente',
            'horario' => $horario
        ], 201);
    }

    // Obtener un horario por su ID
    public function show($id)
    {
        $horario = Horario::with('bar')->find($id);

        if (!$horario) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }

        return response()->json($horario);
    }

    // Actualizar un horario
    public function update(Request $request, $id)
    {
        $horario = Horario::find($id);

        if (!$horario) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }

        $request->validate([
            'Dia' => 'required|string|max:20',
            'HoraApertura' => 'required|date_format:H:i',
            'HoraCierre' => 'required|date_format:H:i|after:HoraApertura',
            'Bar_ID' => 'nullable|integer|exists:bares,ID'
        ]);

        $horario->update($request->all());

        return response()->json([
            'message' => 'Horario actualizado exitosamente',
            'horario' => $horario
        ]);
    }

    // Eliminar un horario
    public function destroy($id)
    {
        $horario = Horario::find($id);

        if (!$horario) {
            return response()->json(['message' => 'Horario no encontrado'], 404);
        }

        $horario->delete();

        return response()->json(['message' => 'Horario eliminado exitosamente']);
    }
}
