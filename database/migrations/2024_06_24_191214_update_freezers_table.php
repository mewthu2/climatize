<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFreezersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_freezers', function (Blueprint $table) {
            $table->dropColumn('mac_sensor');
            $table->unsignedBigInteger('status_sensor_id')->nullable();

            // Define a chave estrangeira
            $table->foreign('status_sensor_id')->references('id')->on('status_sensors');
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
            $table->dropForeign(['status_sensor_id']);
            $table->dropColumn('status_sensor_id');
            $table->string('mac_sensor')->nullable();
        });
    }
}
