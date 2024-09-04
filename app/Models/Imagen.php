<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'ID'; // Clave primaria
    public $incrementing = false; // Si la clave primaria no es autoincrementable
    protected $keyType = 'int'; // Tipo de la clave primaria

    protected $fillable = [
        'Titulo',
        'URL',
        'Bar_ID',
    ];

    // Definir las relaciones si es necesario
    public function bar()
    {
        return $this->belongsTo(Bar::class, 'Bar_ID', 'ID');
    }
}
