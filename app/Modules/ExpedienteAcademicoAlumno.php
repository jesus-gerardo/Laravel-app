<?php
namespace App\Modules;

use Illuminate\Http\Request;
use App\Models\ExpedienteAcademicoAlumnos;

class ExpedienteAcademicoAlumno{
    function store(Request $request, $alumnos){
        $expediente = new ExpedienteAcademicoAlumnos();
        $expediente->save();
    }
}