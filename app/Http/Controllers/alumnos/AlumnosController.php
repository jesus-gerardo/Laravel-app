<?php

namespace App\Http\Controllers\Alumnos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AlumnoRequest;
use App\Models\Expediente;
use Illuminate\Http\Request;

use App\Modules\Direccion;
// use App\Modules\ExpedienteClinico;
// use App\Modules\ExpedienteAcademicoAlumno;
// use App\Models\ExpedienteHistorialAlumnos;

use Exception;

class AlumnosController extends Controller{
    private $direccion;
    private $expedienteClinico;
    private $expedienteAcademico;
    private $expedienteHistorial;

    function __construct(){
        $this->direccion = new Direccion();
        // $this->expedienteClinico = new ExpedienteClinico();
        // $this->expedienteAcademico = new ExpedienteAcademicoAlumno();
        // $this->expedienteHistorial = new ExpedienteHistorialAlumnos();
    }

    function index(){
        try{
            extract(request()->only([ 'query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn', 'sort']));
            $json = json_decode($query);
            $expediente = Expediente::class;

            $result['response'] = true;
            $result['count'] = $expediente::count();
            $result['data'] = $expediente::take((int) $limit)
            ->skip( (int)$limit * ((int)$page - 1) )
            ->get();

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
    
    function show(Expediente $alumnos){
        try{
            return response()->json($alumnos);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    function store(AlumnoRequest $request){
        try{
            // falta registrar usuario
            DB::beginTransaction();
            // $direccion = $this->direccion->store($request);

            $expediente = new Expediente();
            $expediente->nombre = $request->nombre;
            $expediente->primer_apellido = $request->primer_apellido;
            $expediente->segundo_apellido = $request->segundo_apellido;
            $expediente->fecha_nacimiento = $request->fecha_nacimiento;
            
            $expediente->telefono = $request->telefono;
            $expediente->observaciones = $request->observaciones;
            
            $expediente->save();

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
