<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_pedidos', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('pedido_id');
            $table->enum('status', ['REGISTRADO', 'CONFIRMADO', 'EN_PROCESO', 'PREPARADO', 'ENPAQUETADO', 'ESPERANDO_CLIENTE', 'ENTREGADO']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_pedidos');
    }
}