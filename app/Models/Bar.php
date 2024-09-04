<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;

    protected $table = 'bares';

    protected $fillable = [
        'ID',
        'Nombre',
        'Descripcion',
        'Ubicacion',
        'Telefono',
        'LogoURL',
        'Categoria_ID'
    ];

    public $timestamps = false;

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'Categoria_ID', 'ID');
    }
}
