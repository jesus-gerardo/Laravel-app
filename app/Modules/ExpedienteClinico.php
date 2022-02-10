<?php

namespace App\Modules;

use Illuminate\Http\Request;
use App\Models\ExpedienteClinicoAlumnos;

class ExpedienteClinico{
    function store(Request $request, $alumno){
        $expediente = new ExpedienteClinicoAlumnos();
        $expediente->expediente_alumno_id = $alumno->id;
        $expediente->tipo_sangre = $request->tipo_sangre;
        $expediente->observaciones = $request->observaciones;
        $expediente->save();
    }
}