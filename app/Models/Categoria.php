<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo
    protected $table = 'categorias';

     // Desactivar timestamps si no los usas en tu tabla
     public $timestamps = false;
    // Definir las propiedades asignables masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];
}
