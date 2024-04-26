<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_sensors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_equipamento', 20)->nullable();
            $table->string('mac_sensor', 23)->nullable();
            $table->datetime('dt_cadstr')->nullable();
            $table->string('ip_cliente', 50)->nullable();
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
        Schema::dropIfExists('cad_sensors');
    }
}
