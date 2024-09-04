<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    // Guardar una nueva imagen
    public function store(Request $request)
    {
        $request->validate([
            'Titulo' => 'nullable|string|max:100',
            'URL' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi|max:20480', // Añadir formatos de video
            'Bar_ID' => 'nullable|exists:bares,ID',
        ]);

        $path = $request->file('URL')->store('files', 'public');
        $url = Storage::url($path);

        $imagen = Imagen::create([
            'Titulo' => $request->input('Titulo'),
            'URL' => $url,
            'Bar_ID' => $request->input('Bar_ID'),
        ]);

        return response()->json([
            'message' => 'Archivo guardado exitosamente',
            'imagen' => $imagen,
        ], 201);
    }

    // Obtener todas las imágenes y videos
    public function index()
    {
        $imagenes = Imagen::all();

        return response()->json($imagenes);
    }

    // Obtener un archivo específico
    public function show($id)
    {
        $imagen = Imagen::find($id);

        if (!$imagen) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }

        return response()->json($imagen);
    }

    // Actualizar un archivo
    public function update(Request $request, $id)
    {
        $request->validate([
            'Titulo' => 'nullable|string|max:100',
            'URL' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi|max:20480',
            'Bar_ID' => 'nullable|exists:bares,ID',
        ]);

        $imagen = Imagen::find($id);

        if (!$imagen) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }

        if ($request->hasFile('URL')) {
            // Eliminar el archivo anterior del almacenamiento
            $oldPath = str_replace('/storage', '', $imagen->URL);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }

            // Subir el nuevo archivo
            $path = $request->file('URL')->store('files', 'public');
            $imagen->URL = Storage::url($path);
        }

        $imagen->Titulo = $request->input('Titulo', $imagen->Titulo);
        $imagen->Bar_ID = $request->input('Bar_ID', $imagen->Bar_ID);
        $imagen->save();

        return response()->json([
            'message' => 'Archivo actualizado exitosamente',
            'imagen' => $imagen,
        ]);
    }

    // Eliminar un archivo
    public function destroy($id)
    {
        $imagen = Imagen::find($id);

        if (!$imagen) {
            return response()->json(['message' => 'Archivo no encontrado'], 404);
        }

        // Eliminar el archivo del almacenamiento
        $path = str_replace('/storage', '', $imagen->URL);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $imagen->delete();

        return response()->json(['message' => 'Archivo eliminado exitosamente']);
    }
}
