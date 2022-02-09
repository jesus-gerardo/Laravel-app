<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AlumnoRequest;
use App\Models\ExpedientesAlumnos;
use Exception;

class AlumnosController extends Controller{
    function view(ExpedientesAlumnos $alumno){
        try{
            return response()->json($alumno);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    function store(AlumnoRequest $request){
        try{
            // falta registrar usuario
            $expediente = new ExpedientesAlumnos();
            $expediente->nombre = $request->nombre;
            $expediente->primer_apellido = $request->primer_apellido;
            $expediente->segundo_apellido = $request->segundo_apellido;
            $expediente->fecha_nacimiento = $request->fecha_nacimiento;
            $expediente->save();

            // aqui tambien debo guardar la imagen
            return response()->json([
                'success' => true,
                'error' => null
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    function store_schedule(){

    }

    // no sera eliminar, sera dar de baja al alumno
    function remove(){
        
    }
}
