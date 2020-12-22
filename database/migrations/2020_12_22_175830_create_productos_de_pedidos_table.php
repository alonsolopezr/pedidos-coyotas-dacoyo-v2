<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosDePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_de_pedidos', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('pedido_id');
            $table->foreignId('producto_id');
            $table->integer('cantidad')->default(1);
            $table->double('precio_especial')->nullable();
            $table->longText('comentario')->nullable();
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
        Schema::dropIfExists('productos_de_pedidos');
    }
}