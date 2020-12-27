<?php

namespace App\Models;

use App\Models\User;
use App\Models\Producto;
use App\Models\ProductosDePedido;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'folio',
        'qr',
        'status',
        'paga_en_tienda',
        'monto_total',
        'fecha',
        'hora',
        'cancelado',
        'cliente_id',

    ];

    public function productosDePedido()
    {
        return $this->hasMany(ProductosDePedido::class, 'pedido_id');
    }
    public function infoDeProductosDePedido()
    {
        return $this->hasManyThrough(Producto::class, ProductosDePedido::class, 'producto_id', 'pedido_id', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
}