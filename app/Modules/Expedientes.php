<?php

namespace App\Modules;

use App\Http\Requests\ExpedienteRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Expediente;


use App\Modules\Direccion;
use App\Modules\ExpedienteClinico;
use Exception;

class Expedientes{
    private $direccion;
    private $expedienteClinico;
    private $expedienteAcademico;
    private $expedienteHistorial;

    function __construct(){
        $this->direccion = new Direccion();
        $this->expedienteClinico = new ExpedienteClinico();
        // $this->expedienteAcademico = new ExpedienteAcademicoAlumno();
        // $this->expedienteHistorial = new ExpedienteHistorialAlumnos();
    }

    function index(Request $request){
        extract($request->only([ 'query', 'limit', 'page', 'orderBy', 'byColumn', 'sort', 'type']));
        $json = json_decode($query);
        $expediente = Expediente::where('type', $type);

        $result['response'] = true;
        $result['count'] = $expediente->count();
        $result['data'] = $expediente->take((int) $limit)
        ->skip( (int)$limit * ((int)$page - 1) )
        ->get();
    
        return $result;
    }
    
    function store(ExpedienteRequest $request){
        $expediente = new Expediente();

        $expediente->type = $request->type;
        $expediente->nombre = $request->nombre;
        $expediente->primer_apellido = $request->primer_apellido;
        $expediente->segundo_apellido = $request->segundo_apellido;
        $expediente->fecha_nacimiento = $request->fecha_nacimiento;
        $expediente->email = $request->email;
        $expediente->telefono = $request->telefono;
        $expediente->observaciones = $request->observaciones;
        $expediente->save();

        $this->direccion->store($request, $expediente->id);
        $this->expedienteClinico->store($request, $expediente->id);

        $result['response'] = true;
        $result['error'] = null;
        return $result;
    }

    function update(Request $request, $id){
        try{
            $result['response'] = true;
            $result['error'] = null;
        }catch(Exception $e){
            $result['response'] = false;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }
}