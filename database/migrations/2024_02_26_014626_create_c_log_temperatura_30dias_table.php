<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCLogTemperatura30diasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_log_temperatura_30dias', function (Blueprint $table) {
            $table->id('id_equipamento');
            $table->string('mac_sensor');
            $table->decimal('temperatura');
            $table->dateTime('dt_leitura');
            $table->string('nome_unidade');
            $table->string('referencia');
            $table->string('etiqueta_ident');
            $table->string('detalhe');
            $table->decimal('setpoint');

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
        Schema::dropIfExists('c_log_temperatura_30dias');
    }
}
