<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCPanelTemperaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_panel_temperaturas', function (Blueprint $table) {
            $table->id('id_equipamento');
            $table->string('mac_sensor');
            $table->string('nome_unidade');
            $table->string('referencia');
            $table->string('etiqueta_ident');
            $table->string('detalhe');
            $table->unsignedBigInteger('cad_cliente_id');
            $table->decimal('setpoint');
            $table->dateTime('dt_leitura');
            $table->decimal('max');
            $table->decimal('min');
            $table->boolean('atu');

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
        Schema::dropIfExists('c_panel_temperaturas');
    }
}
