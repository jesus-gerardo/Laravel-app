<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasSalonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias_salones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('salon_id'); // salon A
            $table->foreign('salon_id')->references('id')->on('salones');

            $table->unsignedBigInteger('materia_id'); // español
            $table->foreign('materia_id')->references('id')->on('materias');

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
        Schema::dropIfExists('materias_salones');
    }
}
