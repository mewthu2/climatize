<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdEquipamentoToCPanelTemperaturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_panel_temperaturas', function (Blueprint $table) {
            $table->string('id_equipamento')->after('id');
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
            $table->dropColumn('id_equipamento');
        });
    }
}
