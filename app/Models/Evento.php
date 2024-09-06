<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'ID',
        'nombre',
        'url_img',
        'url_video',
        'Bar_ID'
    ];

    public $timestamps = true;

    // Relación con Bar
    public function bar()
    {
        return $this->belongsTo(Bar::class, 'Bar_ID', 'ID');
    }
}
