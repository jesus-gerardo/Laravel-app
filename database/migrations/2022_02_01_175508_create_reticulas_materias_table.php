<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReticulasMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reticulas_materias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias');

            $table->string('nombre');
            $table->string('descripcion');

            // si esta pertenece a un subindice de la reticula
            $table->unsignedBigInteger('reticula_materia_id')->nullable();
            $table->foreign('reticula_materia_id')->references('id')->on('reticulas_materias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reticulas_materias');
    }
}
