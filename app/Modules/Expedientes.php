<?php

namespace App\Modules;

use App\Http\Requests\ExpedienteRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Expediente;

use App\Modules\Direccion;
use App\Modules\ExpedienteClinico;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

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

    function findImage($path){
        if (!File::exists($path)) {
            throw new Exception('Image not fount', 2);
        }

        $file = File::get($path);
        $type = File::mimeType($path);    
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
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

        if($request->has('image')){
            $picture = $request->file('image');
            $name = $picture->hashName();
            Storage::disk('root')->putFileAs("/expediente_alumnos", $picture, $name);
        }

        $expediente->numero_expediente = uniqid();
        $expediente->type = $request->type;
        $expediente->nombre = $request->nombre;
        $expediente->primer_apellido = $request->primer_apellido;
        $expediente->segundo_apellido = $request->segundo_apellido;
        $expediente->fecha_nacimiento = $request->fecha_nacimiento;
        $expediente->email = $request->email;
        $expediente->telefono = $request->telefono;
        $expediente->curp = $request->curp;
        $expediente->observaciones = $request->observaciones;
        $expediente->save();

        $this->direccion->store($request, $expediente->id);
        $this->expedienteClinico->store($request, $expediente->id);

        if($request->has('image')){
            $picture = $request->file('image');
            $name = $picture->hashName();
            Storage::disk('root')->putFileAs("/expediente_alumnos", $picture, $name);
            $expediente->image = $name;
            $expediente->save();
        }

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