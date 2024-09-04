<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ProductoController;
use  App\Http\Controllers\ImagenController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FavoritoController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas de API para tu aplicación. 
| Estas rutas están cargadas por el RouteServiceProvider y todas están 
| asignadas al grupo de middleware "api".
|
*/

// Rutas públicas
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

// Rutas protegidas por middleware de autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/user', [AuthController::class, 'user']); 
    // Corrige aquí: Cambia POST a GET

    // Rutas para gestionar bares
    Route::get('bares', [BarController::class, 'index']);
    Route::post('bares', [BarController::class, 'store']);
    Route::get('bares/{id}', [BarController::class, 'show']);
    Route::put('bares/{id}', [BarController::class, 'update']);
    Route::delete('bares/{id}', [BarController::class, 'destroy']);

    // Rutas para gestionar horarios
    Route::get('horarios', [HorarioController::class, 'index']);
    Route::post('horarios', [HorarioController::class, 'store']);
    Route::get('horarios/{id}', [HorarioController::class, 'show']);
    Route::put('horarios/{id}', [HorarioController::class, 'update']);
    Route::delete('horarios/{id}', [HorarioController::class, 'destroy']);
    
    Route::get('mesas', [MesaController::class, 'index']); // Obtener todas las mesas
    Route::post('mesas', [MesaController::class, 'store']); // Crear una nueva mesa
    Route::get('mesas/{id}', [MesaController::class, 'show']); // Obtener una mesa específica
    Route::put('mesas/{id}', [MesaController::class, 'update']); // Actualizar una mesa
    Route::delete('mesas/{id}', [MesaController::class, 'destroy']); // Eliminar una mesa
    // Rutas para gestionar productos
    Route::get('productos', [ProductoController::class, 'index']);
    Route::post('productos', [ProductoController::class, 'store']);
    Route::get('productos/{id}', [ProductoController::class, 'show']);
    Route::put('productos/{id}', [ProductoController::class, 'update']);
    Route::delete('productos/{id}', [ProductoController::class, 'destroy']);

     // Rutas para manejar imágenes
     Route::get('imagenes', [ImagenController::class, 'index']); // Obtener todas las imágenes
     Route::post('imagenes', [ImagenController::class, 'store']); // Crear una nueva imagen
     Route::get('imagenes/{id}', [ImagenController::class, 'show']); // Obtener una imagen específica
     Route::put('imagenes/{id}', [ImagenController::class, 'update']); // Actualizar una imagen
     Route::delete('imagenes/{id}', [ImagenController::class, 'destroy']); // Eliminar una imagen
// Rutas para gestionar categorías
Route::get('categorias', [CategoriaController::class, 'index']);
Route::post('categorias', [CategoriaController::class, 'store']);
Route::get('categorias/{id}', [CategoriaController::class, 'show']);
Route::put('categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy']);
      // Rutas para manejar videos
    Route::get('videos', [VideoController::class, 'index']); // Obtener todos los videos
    Route::post('videos', [VideoController::class, 'store']); // Crear un nuevo video
    Route::get('videos/{id}', [VideoController::class, 'show']); // Obtener un video específico
    Route::put('videos/{id}', [VideoController::class, 'update']); // Actualizar un video
    Route::delete('videos/{id}', [VideoController::class, 'destroy']); // Eliminar un video

    //ruta favoritos
    Route::get('favoritos', [FavoritoController::class, 'index']); // Obtener todos los favoritos del usuario autenticado
    Route::post('favoritos', [FavoritoController::class, 'store']); // Agregar un bar a favoritos
    Route::delete('favoritos/{id}', [FavoritoController::class, 'destroy']); // Eliminar un bar de favoritos

});
