<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeReferenciaNullableInCPanelTemperaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_panel_temperaturas', function (Blueprint $table) {
            $table->string('referencia')->nullable()->change();
            $table->dateTime('dt_leitura')->nullable()->change();
            $table->boolean('atu')->nullable()->default(false)->change();
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
            $table->string('referencia')->nullable(false)->change();
            $table->dateTime('dt_leitura')->nullable(false)->change();
            $table->boolean('atu')->nullable(false)->default(null)->change();
        });
    }
}


