<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCPanelTemperaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_panel_temperaturas', function (Blueprint $table) {
            $table->dropForeign(['cad_cliente_id']);
            $table->dropColumn('cad_cliente_id');
        });

        Schema::table('c_panel_temperaturas', function (Blueprint $table) {
            $table->unsignedBigInteger('cad_cliente_id')->nullable();
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
        Schema::table('c_panel_temperaturas', function (Blueprint $table) {
            $table->dropForeign(['cad_cliente_id']);
            $table->dropColumn('cad_cliente_id');
        });
    }
};