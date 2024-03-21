<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMvSolIngDocumentoArchivoTable extends Migration
{
    public function up()
    {
        Schema::create('BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO_ARCHIVO', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('FOLIO');
            $table->integer('FOLIO_ADJUNTO');
            $table->unsignedBigInteger('MV_SOL_ING_DOCUMENTO_ID');
            $table->string('DESCRIPCION', 100);
            $table->boolean('ACTIVO');
            $table->dateTime('FECHA_CREA');
            $table->string('IP_CREA', 15);
            $table->string('SERVIDOR_CREA', 50);
            $table->dateTime('FECHA_MOD');
            $table->string('IP_MOD', 15);
            $table->string('SERVIDOR_MOD', 50);
            $table->integer('FOLIO_SUBIDA');
            $table->boolean('DOCUMENTO_INTERNO');
            $table->string('RUTA_DOC_INTERNO', 100);
            $table->unsignedBigInteger('GENERADOS_ID');
            $table->unsignedBigInteger('USUARIO_CREA_ID');

            $table->foreign('MV_SOL_ING_DOCUMENTO_ID')->references('ID')->on('BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO');

            // Continúa con los demás campos...
        });
    }

    public function down()
    {
        Schema::dropIfExists('BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO_ARCHIVO');
    }
}