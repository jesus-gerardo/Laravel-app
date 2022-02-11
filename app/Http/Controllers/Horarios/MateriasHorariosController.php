<?php

namespace App\Http\Controllers\Horarios;

use App\Http\Controllers\Controller;
use App\Models\MateriasSalones;
use App\Models\MateriasDias;
use App\Models\MateriasHorarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class MateriasHorariosController extends Controller{
    //
    public function index($materia_id){
        try{
            // descomposition params get
            extract(request()->only([ 'query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn', 'sort']));
            $json = json_decode($query);
            $materia = MateriasSalones::with([
                'salon'
            ])->where('materia_id', $materia_id);

            $result['response'] = true;
            $result['count'] = $materia->count();
            $result['data'] = $materia->take((int) $limit)
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

    public function salon_horario($id){
        try{
            $horarios = MateriasDias::with([
                'dias',
                'horarios'
            ])->where('materia_salon_id', $id)
            ->get();

            return response()->json([
                'response' => false,
                'data' => $horarios
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'count' => 0,
                'data' => [],
                'error' => $e->getMessage()
            ], 200);
        }   
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $materiaSalon = new MateriasSalones();
            $materiaSalon->salon_id = $request->salon_id;
            $materiaSalon->materia_id = $request->materia_id;
            $materiaSalon->save();

            $dias = json_decode($request->dias);
            foreach($dias as $dia){
                $materiasDias = new MateriasDias();
                $materiasDias->materia_salon_id = $materiaSalon->id;
                $materiasDias->dia_id = $dia->id;
                $materiasDias->save();

                foreach($dia->horas as $hora){
                    $materiasHoras = new MateriasHorarios();
                    $materiasHoras->materia_dia_id = $materiasDias->id;
                    $materiasHoras->maestro_id = $hora->maestro_id;
                    $materiasHoras->hora_inicio = $hora->hora_inicio;
                    $materiasHoras->hora_termino = $hora->hora_termino;
                    $materiasHoras->save();
                }
            }

            DB::commit();
            return response()->json([
                'response' => false
            ], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'response' => false,
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 200);
        }
    }

    public function update(Request $request){
        try{

        }catch(Exception $e){

        }
    }
}
