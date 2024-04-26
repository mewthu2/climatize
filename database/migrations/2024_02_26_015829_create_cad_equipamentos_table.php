<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_equipamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_equipamento', 20)->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('cad_cliente_id')->nullable();
            $table->foreign('cad_cliente_id')->references('id')->on('cad_clientes_old')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_equipamentos');
    }
}
