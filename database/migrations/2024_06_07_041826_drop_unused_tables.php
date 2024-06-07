<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUnusedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('panel_temperaturas');
        Schema::dropIfExists('c_log_6temperaturas');
        Schema::dropIfExists('c_log_12temperaturas');
        Schema::dropIfExists('c_log_24temperaturas');
        Schema::dropIfExists('c_log_temperatura_30dias');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('panel_temperaturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('c_log_6temperaturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('c_log_12temperaturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('c_log_24temperaturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('c_log_temperatura_30dias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}
