<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_sensors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mac_sensor', 23)->nullable();
            $table->float('offset')->nullable();
            $table->timestamps();
            
            $table->index('mac_sensor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_sensors');
    }
}
