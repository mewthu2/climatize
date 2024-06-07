<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCadClienteIdToCadFreezersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_freezers', function (Blueprint $table) {
            // $table->unsignedBigInteger('cad_cliente_id')->after('id');
            $table->foreign('cad_cliente_id')->references('id')->on('cad_clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cad_freezers', function (Blueprint $table) {
            $table->dropForeign(['cad_cliente_id']);
            $table->dropColumn('cad_cliente_id');
        });
    }
}
