<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_agendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_cliente');
            $table->string('etiqueta_ident', 15);
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fim')->nullable();
            $table->string('dia_semana', 15)->nullable();
            $table->timestamps();

            $table->unique(['id_cliente', 'etiqueta_ident', 'hora_inicio', 'hora_fim', 'dia_semana'], 'unique_agenda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_agendas');
    }
}
