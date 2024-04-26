<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_sensors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_equipamento', 20)->nullable();
            $table->string('mac_sensor', 25);
            $table->string('status', 2)->nullable();
            $table->string('ip_cliente', 25)->nullable();
            $table->double('offset', 8, 2)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('cad_cliente_id')->nullable();
            
            $table->unique(['id_equipamento', 'mac_sensor']);
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
        Schema::dropIfExists('status_sensors');
    }
}

