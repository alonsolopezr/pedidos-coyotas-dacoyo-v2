<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductosDePedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_especial',
        'comentario',

    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}