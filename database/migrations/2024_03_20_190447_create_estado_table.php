<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BIBLIOTECA_VIRTUAL.ESTADO', function (Blueprint $table) {
            $table->string('ID')->primary();
            $table->string('CODIGO')->nullable();
            $table->string('DESCRIPCION')->nullable();
            $table->boolean('ACTIVO')->default(true);
            $table->integer('USUARIO_ID_MOD')->nullable();
            $table->timestamp('FECHA_MOD')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BIBLIOTECA_VIRTUAL.ESTADO');
    }
}