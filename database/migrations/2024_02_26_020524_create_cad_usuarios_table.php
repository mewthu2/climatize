<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 50)->nullable();
            $table->string('login', 50)->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('cad_cliente_id')->nullable();
            $table->unsignedBigInteger('cad_grupo_id')->nullable();

            $table->foreign('cad_cliente_id')->references('id')->on('cad_clientes_old')->onDelete('cascade');
            $table->foreign('cad_grupo_id')->references('id')->on('cad_grupos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_usuarios');
    }
}
