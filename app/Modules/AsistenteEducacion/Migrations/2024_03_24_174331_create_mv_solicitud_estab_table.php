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
        Schema::create('ASISTENTE_EDUCACION.MV_SOLICITUD_ESTAB', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedBigInteger('ESTADO_ID');
            $table->string('NOMBRE_ESTAB', 50)->nullable();
            $table->string('RUT_ESTAB', 12)->nullable();
            $table->string('RBD_ESTAB', 12)->nullable();
            $table->string('DIRECCION_ESTAB', 50)->nullable();
            $table->string('TELEFONO_ESTAB', 50)->nullable();
            $table->string('RUT_DIRECTOR', 12)->nullable();
            $table->string('NOMBRE_DIRECTOR', 50)->nullable();
            $table->string('APELLIDO_PAT_DIRECTOR', 50)->nullable();
            $table->string('APELLIDO_MAT_DIRECTOR', 50)->nullable();
            $table->string('CORREO_DIRECTOR', 50)->nullable();
            $table->date('FECHA_CREA')->nullable();
            $table->unsignedBigInteger('USUARIO_CREA_ID')->nullable();
            $table->string('IP_CREA', 50)->nullable();
            $table->string('SERVIDOR_CREA', 50)->nullable();
            $table->unsignedBigInteger('PERSONAS_CREA')->nullable();
            $table->date('FECHA_MOD')->nullable();
            $table->unsignedBigInteger('USUARIO_MOD_ID')->nullable();
            $table->string('IP_MOD', 50)->nullable();
            $table->string('SERVIDOR_MOD', 50)->nullable();
            $table->unsignedBigInteger('PERSONAS_MOD')->nullable();
            $table->string('COMENTARIO_RECHAZO', 1000)->nullable();
            $table->timestamps();

            $table->foreign('ESTADO_ID')->references('ID')->on('TB_ESTADO');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mv_solicitud_estab');
    }
};
