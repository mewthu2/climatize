<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCLog24temperaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_log_24temperaturas', function (Blueprint $table) {
            $table->id('id_equipamento');
            $table->string('mac_sensor');
            $table->decimal('temperatura');
            $table->dateTime('dt_leitura');
            $table->string('nome_unidade');
            $table->string('referencia');
            $table->string('etiqueta_ident');
            $table->string('detalhe');
            $table->decimal('setpoint');
            $table->decimal('max');
            $table->decimal('min');
            $table->unsignedBigInteger('cad_cliente_id');

            $table->foreign('cad_cliente_id')->references('id')->on('c_clientes')->onDelete('cascade');

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
        Schema::dropIfExists('c_log_24temperaturas');
    }
}
