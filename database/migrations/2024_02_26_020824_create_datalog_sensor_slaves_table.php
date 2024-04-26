<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatalogSensorSlavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datalog_sensor_slaves', function (Blueprint $table) {
            $table->id();
            $table->string('id_equipamento', 50)->nullable();
            $table->string('mac_sensor', 23)->nullable();
            $table->float('temperatura')->nullable();
            $table->datetime('dt_leitura')->nullable();
            $table->timestamps();

            $table->index('mac_sensor');
            $table->index('dt_leitura');
            $table->index('temperatura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datalog_sensor_slaves');
    }
}
