<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ASISTENTE_EDUCACION.TB_ESTADO', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('TIPO_ESTADO_ID');
            $table->string('DESCRIPCION', 50)->nullable();
            $table->date('FECHA_CREA');
            $table->unsignedBigInteger('USUARIO_CREA_ID');
            $table->string('IP_CREA', 50);
            $table->string('SERVIDOR_CREA', 50);
            $table->unsignedBigInteger('PERSONAS_CREA');
            $table->date('FECHA_MOD')->nullable();
            $table->unsignedBigInteger('USUARIO_MOD_ID')->nullable();
            $table->string('IP_MOD', 50)->nullable();
            $table->string('SERVIDOR_MOD', 50)->nullable();
            $table->unsignedBigInteger('PERSONAS_MOD')->nullable();
            $table->timestamps();

            $table->foreign('TIPO_ESTADO_ID')->references('ID')->on('ASISTENTE_EDUCACION.TB_TIPO_ESTADO');  
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ASISTENTE_EDUCACION.TB_ESTADO');
    }
};
