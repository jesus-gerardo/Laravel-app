<?php

namespace App\Http\Controllers\Expedientes;

use App\Http\Requests\ExpedienteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modules\Expedientes;
use App\Models\Expediente;



use Exception;

class ExpedientesController extends Controller{
    private $expediente;
    function __construct(){
        $this->expediente = new Expedientes();
    }

    function index(Request $request){
        try{
            $result = $this->expediente->index($request);
            return response()->json($result, 200);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'count' => 0,
                'data' => [],
                'error' => $e->getMessage()
            ], 200);
        }
    }

    function image($name){
        try{
            return $this->expediente->findImage(storage_path("expediente_alumnos/{$name}"));
        }catch(Exception $e){
            return $this->expediente->findImage(public_path("img/no-imagen.png"));
        }
    }
    
    function show(Expediente $expediente){
        try{
            return response()->json($expediente);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    function store(ExpedienteRequest $request){
        try{
            // falta registrar usuario
            DB::beginTransaction();
            $this->expediente->store($request);
            DB::commit();
            return response()->json([
                'response' => true,
                'error' => null
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'response' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    function update(Request $request, $id){
        try{
            return response()->json([
                'response' => true,
                'error' => null
            ]);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    // no sera eliminar, sera dar de baja al alumno
    function remove(){}

}
