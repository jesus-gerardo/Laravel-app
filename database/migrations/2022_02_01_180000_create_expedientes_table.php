<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('matricula');
            $table->string('image')->default('no-imagen.png');
            $table->string("type")->default('alumno');
            $table->string('nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('email');
            $table->string('curp')->nullable();
            $table->string('telefono')->nullable();
            $table->text('observaciones')->nullable();

            $table->string('status')->nullable(); // dado baja, temporal, activo
            $table->boolean('active')->default(1);

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
        Schema::dropIfExists('expedientes');
    }
}
