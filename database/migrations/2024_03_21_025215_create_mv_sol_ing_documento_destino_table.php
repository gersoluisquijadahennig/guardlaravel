<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMvSolIngDocumentoDestinoTable extends Migration
{
    public function up()
    {
        Schema::create('BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO_DESTINO', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('MV_SOL_ING_DOCUMENTO_ID');
            $table->integer('ESTABLECIMIENTO_ID');
            $table->string('DESTINO', 100);
            $table->boolean('ACTIVO');
            $table->dateTime('FECHA_CREA');
            $table->string('IP_CREA', 15);
            $table->string('SERVIDOR_CREA', 50);
            $table->dateTime('FECHA_MOD');
            $table->string('IP_MOD', 15);
            $table->string('SERVIDOR_MOD', 50);

            $table->foreign('MV_SOL_ING_DOCUMENTO_ID')->references('ID')->on('BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO');
        });
    }

    public function down()
    {
        Schema::dropIfExists('BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO_DESTINO');
    }
}