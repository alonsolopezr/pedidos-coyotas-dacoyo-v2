<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table)
        {
            $table->id();
            $table->string('nombre');
            $table->longText('descripcion');
            $table->string('sku')->nullable();
            $table->string('qr')->nullable();
            $table->double('precio');
            $table->string('imagen_1')->nullable();
            $table->string('imagen_2')->nullable();
            $table->string('imagen_3')->nullable();
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
        Schema::dropIfExists('productos');
    }
}