<?php

namespace App\Models;

use Carbon\Carbon;
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
        'sucursal',
        'num_del_dia',
        'paquetes_de_coyotas',
        'cliente_pasa_por_pedido',
        'nombre_otra_persona_pasa_por_pedido',
        'telefono_otra_persona_pasa_por_pedido',
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

    public static  function numSiguientePedido($fecha)
    {
        $contadorPorDia = count(Pedido::where('fecha', '=', $fecha)->latest()->get());
        $contadorCampo = Pedido::where('fecha', '=', $fecha)->count() == 0 ? '0' : Pedido::where('fecha', '=', $fecha)->latest()->first()->num_del_dia;
        //dd('debug pedidos', $contadorPorDia, $contadorCampo);
        return $contadorCampo + 1;
    }
}