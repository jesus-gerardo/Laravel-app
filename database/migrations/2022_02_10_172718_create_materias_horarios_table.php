<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasHorariosTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('materias_horarios', function (Blueprint $table) {
            $table->unsignedBigInteger('materia_dia_id');
            $table->foreign('materia_dia_id')->references('id')->on('materias_dias');

            $table->time('hora_inicio');
            $table->time('hora_termino');

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
        Schema::dropIfExists('materias_horarios');
    }
}
