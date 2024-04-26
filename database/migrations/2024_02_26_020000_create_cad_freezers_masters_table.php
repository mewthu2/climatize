<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadFreezersMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_freezers_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->string('id_equipamento', 50)->nullable();
            $table->string('nome_unidade', 255)->nullable();
            $table->string('referencia', 50)->nullable();
            $table->string('detalhe', 30)->nullable();
            $table->string('mac_sensor', 23)->nullable();
            $table->float('tLiga')->nullable();
            $table->float('tDesliga')->nullable();
            $table->tinyInteger('statusEquipamento')->nullable();
            $table->timestamps();

            $table->foreign('id_cliente')->references('id')->on('cad_clientes_old')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_freezers_masters');
    }
}
