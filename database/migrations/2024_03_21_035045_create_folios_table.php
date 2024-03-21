<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoliosTable extends Migration
{
    public function up()
    {
        Schema::create('BIBLIOTECA_VIRTUAL.FOLIOS', function (Blueprint $table) {
            $table->id('ID');
            $table->string('PREFIJO');
            $table->integer('FOLIO');
            $table->integer('FORMULARIO_ID');
            $table->timestamps();

  
        });
    }

    public function down()
    {
        Schema::dropIfExists('BIBLIOTECA_VIRTUAL.FOLIOS');
    }
}