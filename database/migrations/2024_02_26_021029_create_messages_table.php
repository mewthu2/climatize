<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_aparelho')->nullable();
            $table->unsignedBigInteger('id_alarme')->nullable();
            $table->unsignedBigInteger('id_responsavel')->nullable();
            $table->string('telefone', 25)->nullable();
            $table->unsignedInteger('status_msg')->nullable();
            $table->unsignedInteger('enviada')->nullable();
            $table->string('tipo_mensagem', 2)->nullable();
            $table->string('texto', 600)->nullable();
            $table->binary('conteudo_binario')->nullable();
            $table->binary('raw')->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->unsignedInteger('ativo')->nullable();
            $table->timestamps();

            $table->foreign('id_aparelho')->references('id')->on('aparelhos')->onDelete('cascade');
            $table->foreign('id_alarme')->references('id')->on('alarmes')->onDelete('cascade');
            $table->foreign('id_responsavel')->references('id')->on('responsaveis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
