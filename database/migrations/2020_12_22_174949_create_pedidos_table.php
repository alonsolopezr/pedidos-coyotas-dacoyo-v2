<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table)
        {
            $table->id();
            $table->string('folio'); //crear
            $table->string('qr'); //crear
            $table->enum('status', ['REGISTRADO', 'CONFIRMADO', 'EN_PROCESO', 'PREPARADO', 'ENPAQUETADO', 'ESPERANDO_CLIENTE', 'ENTREGADO']);
            //$table->unsignedBigInteger('cliente_id'); //TODO: falta FK
            $table->boolean('paga_en_tienda')->default(true); //siempre prefereir pagar en tienda
            $table->double('monto_total');
            $table->date('fecha');
            $table->time('hora'); //entre 10:30am y 4:00pm
            $table->boolean('cancelado')->default(false);
            //TODO: cambiar al clientes, ahorita por mientras users id
            $table->foreignId('cliente_id')->on('users');
            $table->enum('sucursal', ['VILLA_DE_SERIS', 'OLIVARES'])->default('VILLA_DE_SERIS');
            $table->integer('num_del_dia')->default(1);
            $table->integer('paquetes_de_coyotas');
            $table->boolean('cliente_pasa_por_pedido')->default(true);
            $table->string('nombre_otra_persona_pasa_por_pedido')->nullable();
            $table->string('telefono_otra_persona_pasa_por_pedido')->nullable();
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
        Schema::dropIfExists('pedidos');
    }
}