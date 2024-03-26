<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMvEstablecimientoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ASISTENTE_EDCUCACION.MV_ESTABLECIMIENTO', function (Blueprint $table) {
            $table->id('ID');
            $table->string('NOMBRE', 80)->nullable();
            $table->string('RUT', 12)->nullable();
            $table->string('RBD', 12)->unique();
            $table->string('DIRECCION', 90)->nullable();
            $table->string('TELEFONO', 50)->nullable();
            $table->string('EMAIL', 50)->nullable();
            $table->string('N_CELULAR', 15)->nullable();
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
            $table->char('ACTIVO', 1)->nullable();
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mv_establecimiento');
    }
}