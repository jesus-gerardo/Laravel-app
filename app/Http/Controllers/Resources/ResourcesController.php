<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

use App\Models\Salones;
use App\Models\Materias;
use App\Models\Expediente;

class ResourcesController extends Controller{
    //

    function getClassRoom(){
        try{
            $rooms = Salones::where('active', 1)->get();
            return response()->json([
                'data' => $rooms
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'data' => [],
                'error' => $e->getMessage()
            ], 200);
        }
    }

    function getCourses(){
        try{
            $rooms = Materias::where('active', 1)->get();
            return response()->json([
                'data' => $rooms
            ]);
        }catch(Exception $e){
            return response()->json([
                'data' => [],
                'error' => $e->getMessage()
            ]);
        }
    }

    function getTeachers(){
        try{
            $rooms = Expediente::select(
                'id',
                'nombre',
                'primer_apellido',
                'segundo_apellido'
            )->where('type', 'docente')->where('active', 1)->get();
            return response()->json([
                'data' => $rooms
            ]);
        }catch(Exception $e){
            return response()->json([
                'data' => [],
                'error' => $e->getMessage()
            ]);
        }
    }
}
