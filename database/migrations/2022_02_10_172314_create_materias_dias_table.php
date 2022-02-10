<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasDiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias_dias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('materia_salon_id');
            $table->foreign('materia_salon_id')->references('id')->on('materias_salones');

            $table->unsignedBigInteger('dia_id');
            $table->foreign('dia_id')->references('id')->on('dias');

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
        Schema::dropIfExists('materias_dias');
    }
}
