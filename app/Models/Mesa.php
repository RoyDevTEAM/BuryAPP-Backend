<?php
// app/Models/Mesa.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo
    protected $table = 'mesas';

    // Definir las propiedades asignables masivamente
    protected $fillable = [
        'ID',
        'Descripcion',
        'Precio',
        'Anticipo',
        'Bar_ID',
        'Imagen' // Añadido campo Imagen
    ];

    // Desactivar timestamps si no los usas en tu tabla
    public $timestamps = false;

    // Relación con el modelo Bar
    public function bar()
    {
        return $this->belongsTo(Bar::class, 'Bar_ID', 'ID');
    }
}