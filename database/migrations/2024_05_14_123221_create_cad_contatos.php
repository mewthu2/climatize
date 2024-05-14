<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cad_contatos', function (Blueprint $table) {
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
     */
    public function down(): void
    {
        Schema::table('cad_contatos', function (Blueprint $table) {
            $table->dropForeign(['cad_cliente_id']);
            $table->dropForeign(['cad_grupo_id']);
        });

        Schema::dropIfExists('cad_contatos');
    }
};
