<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlPedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'status',

    ];
}
