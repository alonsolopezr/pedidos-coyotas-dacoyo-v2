<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('celular', 10);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('residential')->nullable();
            $table->string('postal_code')->nullable();
            $table->rememberToken();
            //$table->boolean('is_client')->default(0);
            //$table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->text('qr_client')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
