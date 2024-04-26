<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelemetriaEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telemetria_equipamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_equipamento', 20)->nullable();
            $table->string('versao_firmware', 15)->nullable();
            $table->string('nome_rede', 50)->nullable();
            $table->datetime('dt_registro')->nullable();
            $table->string('motivo_registro', 30)->nullable();
            $table->string('dado_registrado', 20)->nullable();
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
        Schema::dropIfExists('telemetria_equipamentos');
    }
}
