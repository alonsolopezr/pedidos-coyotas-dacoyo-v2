<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'sku',
        'qr',
        'precio',
        'imagen_1',
        'imagen_2',
        'imagen_3',

    ];
}
