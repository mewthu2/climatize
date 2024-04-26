<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRegistroEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_registro_eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_cliente')->nullable();
            $table->string('id_equipamento', 20)->nullable();
            $table->string('mac_sensor', 25)->nullable();
            $table->char('status_evento', 1)->nullable();
            $table->dateTime('hr_ab')->nullable();
            $table->float('temperatura')->nullable();
            $table->dateTime('hr_fc')->nullable();
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
        Schema::dropIfExists('t_registro_eventos');
    }
}
