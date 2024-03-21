<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMvSolIngDocumentoTable extends Migration
{
    public function up()
    {
        Schema::create('BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO', function (Blueprint $table) {
            $table->id('ID');
            $table->string('RUT_RESPONSABLE');
            $table->string('NOMBRE_RESPONSABLE');
            $table->string('CORREO_RESPONSABLE');
            $table->string('TELEFONO_FIJO_RESPONSABLE');
            $table->string('TELEFONO_MOVIL_RESPONSABLE');
            $table->integer('FOLIO');
            $table->integer('ORIGEN_ID');
            $table->integer('DOCUMENTO_ID');
            $table->text('OBSERVACION_EXTERNA');
            $table->text('OBSERVACION_CIERRE');
            $table->integer('ESTADO_ID');
            // Continúa con los demás campos...
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('BIBLIOTECA_VIRTUAL.MV_SOL_ING_DOCUMENTO');
    }
}