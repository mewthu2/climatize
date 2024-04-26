<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_contatos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 50)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->integer('nivel_escalonamento')->nullable();
            $table->string('endereco', 50)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('estado', 2)->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('cad_cliente_id')->nullable();
            $table->unsignedBigInteger('cad_usuario_id')->nullable();

            $table->foreign('cad_cliente_id')->references('id')->on('cad_clientes_old')->onDelete('cascade');
            $table->foreign('cad_usuario_id')->references('id')->on('cad_usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_contatos');
    }
}
