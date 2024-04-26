<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCRelatorioTemperaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_relatorio_temperaturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_equipamento');
            $table->string('mac_sensor');
            $table->string('etiqueta_ident');
            $table->string('nome_unidade');
            $table->string('referencia');
            $table->string('detalhe');
            $table->unsignedBigInteger('cad_cliente_id');
            $table->decimal('setpoint');
            $table->decimal('limite_neg');
            $table->decimal('limite_pos');
            $table->dateTime('dt_leitura');
            $table->decimal('temperatura');

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
        Schema::dropIfExists('c_relatorio_temperaturas');
    }
}
