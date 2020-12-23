<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    ];

    public function productosDePedido()
    {
        return $this->hasMany(ProductosDePedido::class);
    }
}
