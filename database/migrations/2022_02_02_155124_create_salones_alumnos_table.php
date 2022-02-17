<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonesAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salones_alumnos', function (Blueprint $table) {
            $table->unsignedBigInteger('salon_id');
            $table->foreign('salon_id')->references('id')->on('salones');

            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('expedientes');

            // $table->unsignedBigInteger('ciclo_escolar_id')->nullable();
            // $table->foreign('ciclo_escolar_id')->references('id')->on('ciclos_escolares');

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
        Schema::dropIfExists('salones_alumnos');
    }
}
