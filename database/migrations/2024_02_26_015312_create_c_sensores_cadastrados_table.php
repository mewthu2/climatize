<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCSensoresCadastradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_sensores_cadastrados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_equipamento');
            $table->string('mac_sensor');
            $table->string('status');
            $table->dateTime('dt_alteracao');
            $table->string('ip_cliente');
            $table->string('offset');

            $table->timestamps();

            $table->foreign('id_equipamento')->references('id')->on('c_equipamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_sensores_cadastrados');
    }
}
