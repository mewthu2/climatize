<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadFreezersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_freezers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_equipamento', 20)->nullable();
            $table->string('mac_sensor', 23)->nullable();
            $table->string('nome_unidade', 255)->nullable();
            $table->string('referencia', 50)->nullable();
            $table->string('detalhe', 30)->nullable();
            $table->float('setpoint')->nullable();
            $table->string('etiqueta_ident', 15)->nullable();
            $table->float('limite_neg')->nullable();
            $table->float('limite_pos')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('cad_cliente_id')->nullable();
            $table->unsignedBigInteger('cad_responsave_id')->nullable();

            $table->foreign('cad_cliente_id')->references('id')->on('cad_clientes_old')->onDelete('cascade');
            $table->foreign('cad_responsave_id')->references('id')->on('cad_responsaves')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_freezers');
    }
}
