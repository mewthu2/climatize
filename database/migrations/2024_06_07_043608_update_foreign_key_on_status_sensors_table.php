<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnStatusSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_sensors', function (Blueprint $table) {
            $table->dropForeign(['cad_cliente_id']);
            
            $table->foreign('cad_cliente_id')->references('id')->on('cad_clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('status_sensors', function (Blueprint $table) {
            $table->dropForeign(['cad_cliente_id']);
            
            $table->foreign('cad_cliente_id')->references('id')->on('cad_clientes_old')->onDelete('cascade');
        });
    }
}

