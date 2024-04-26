<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatalogAlarmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datalog_alarmes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_cliente')->nullable();
            $table->string('equipamento', 23)->nullable();
            $table->string('mac_sensor', 23)->nullable();
            $table->char('status_disparo', 1)->nullable();
            $table->string('etiqueta_ident', 15)->nullable();
            $table->datetime('dt_abertura')->nullable();
            $table->datetime('dt_update')->nullable();
            $table->datetime('dt_fechamento')->nullable();
            $table->integer('nivel_escalonamento')->nullable();
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
        Schema::dropIfExists('datalog_alarmes');
    }
}
