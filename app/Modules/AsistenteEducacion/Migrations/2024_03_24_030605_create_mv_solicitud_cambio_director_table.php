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
        Schema::create('ASISTENTE_EDUCACION.MV_SOLICITUD_CAMBIO_DIRECTOR', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ESTABLECIMIENTO_ID');
            $table->string('RBD', 12);
            $table->string('RUT_SOLICITA', 12);
            $table->string('NOMBRE_SOLICITA', 255);
            $table->string('APELLIDO_PAT_SOLICITA', 255);
            $table->string('APELLIDO_MAT_SOLICITA', 255);
            $table->string('EMAIL_SOLICITA', 255);
            $table->string('TELEFONO_SOLICITA', 255);
            $table->string('CARGO_SOLICITA', 255);
            $table->string('RUT_DIRECTOR', 12);
            $table->string('NOMBRE_DIRECTOR', 255);
            $table->string('APELLIDO_PAT_DIRECTOR', 255);
            $table->string('APELLIDO_MAT_DIRECTOR', 255);
            $table->string('EMAIL_DIRECTOR', 255);
            $table->string('TELEFONO_DIRECTOR', 255);
            $table->boolean('ACTIVO');
            $table->timestamp('FECHA_CREA');
            $table->unsignedBigInteger('USUARIO_CREA_ID');
            $table->string('IP_CREA', 255);
            $table->string('SERVIDOR_CREA', 255);
            $table->string('PERSONAS_CREA', 255);
            $table->timestamp('FECHA_MOD');
            $table->unsignedBigInteger('USUARIO_MOD_ID');
            $table->string('IP_MOD', 255);
            $table->string('SERVIDOR_MOD', 255);
            $table->string('PERSONAS_MOD', 255);
            $table->unsignedBigInteger('ESTADO_ID');
            $table->string('COMENTARIO_RECHAZO', 255);
            //$table->foreign('ESTABLECIMIENTO_ID')->references('ID')->on('ASISTENTE_EDUCACION.MV_ESTABLECIMIENTO');
            //$table->foreign('USUARIO_CREA_ID')->references('ID')->on('ASISTENTE_EDUCACION.TB_USUARIO');
            //$table->foreign('USUARIO_MOD_ID')->references('ID')->on('ASISTENTE_EDUCACION.TB_USUARIO');
            //$table->foreign('ESTADO_ID')->references('ID')->on('ASISTENTE_EDUCACION.TB_ESTADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ASISTENTE_EDUCACION.MV_SOLICITUD_CAMBIO_DIRECTOR');
    }
};
