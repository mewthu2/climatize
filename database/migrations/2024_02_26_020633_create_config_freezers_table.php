<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigFreezersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_freezers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mac_sensor', 255)->nullable();
            $table->float('temp_refrigerar')->nullable();
            $table->float('temp_aquecimento')->nullable();
            $table->integer('set_aquecimento')->nullable();
            $table->integer('set_ventilacao')->nullable();
            $table->float('offset_min_max')->nullable();
            $table->float('offset_termometro')->nullable();
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
        Schema::dropIfExists('config_freezers');
    }
}
