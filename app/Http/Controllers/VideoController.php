<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    // Guardar un nuevo video
    public function store(Request $request)
    {
        $request->validate([
            'Titulo' => 'nullable|string|max:100',
            'URL' => 'required|file|mimes:mp4,mov,avi|max:20480', // Aceptar solo ciertos tipos de video
            'Bar_ID' => 'nullable|exists:bares,ID',
        ]);

        // Subir el archivo de video
        $path = $request->file('URL')->store('videos', 'public');
        $url = Storage::url($path);

        // Crear el registro del video en la base de datos
        $video = Video::create([
            'Titulo' => $request->input('Titulo'),
            'URL' => $url,
            'Bar_ID' => $request->input('Bar_ID'),
        ]);

        return response()->json([
            'message' => 'Video guardado exitosamente',
            'video' => $video,
        ], 201);
    }

    // Obtener todos los videos
    public function index()
    {
        $videos = Video::all();

        return response()->json($videos);
    }

    // Obtener un video específico
    public function show($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video no encontrado'], 404);
        }

        return response()->json($video);
    }

    // Actualizar un video
    public function update(Request $request, $id)
    {
        $request->validate([
            'Titulo' => 'nullable|string|max:100',
            'URL' => 'nullable|file|mimes:mp4,mov,avi|max:20480', // Aceptar solo ciertos tipos de video
            'Bar_ID' => 'nullable|exists:bares,ID',
        ]);

        $video = Video::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video no encontrado'], 404);
        }

        if ($request->hasFile('URL')) {
            // Eliminar el archivo anterior del almacenamiento
            $oldPath = str_replace('/storage', '', $video->URL);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }

            // Subir el nuevo archivo de video
            $path = $request->file('URL')->store('videos', 'public');
            $video->URL = Storage::url($path);
        }

        $video->Titulo = $request->input('Titulo', $video->Titulo);
        $video->Bar_ID = $request->input('Bar_ID', $video->Bar_ID);
        $video->save();

        return response()->json([
            'message' => 'Video actualizado exitosamente',
            'video' => $video,
        ]);
    }

    // Eliminar un video
    public function destroy($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video no encontrado'], 404);
        }

        // Eliminar el archivo del almacenamiento
        $path = str_replace('/storage', '', $video->URL);
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        $video->delete();

        return response()->json(['message' => 'Video eliminado exitosamente']);
    }
}
