<?php

namespace App\Modules;

use Illuminate\Http\Request;
use App\Models\ExpedienteClinico as model;

class ExpedienteClinico{
    function store(Request $request, $id){
        $expediente = new model();
        $expediente->expediente_id = $id;
        $expediente->altura = $request->altura;
        $expediente->peso = $request->peso;
        $expediente->tipo_sangre = $request->tipo_sangre;
        $expediente->padecimientos = $request->padecimientos;
        $expediente->alergias = $request->alergias;
        $expediente->observaciones = $request->observaciones;
        $expediente->save();
    }
}