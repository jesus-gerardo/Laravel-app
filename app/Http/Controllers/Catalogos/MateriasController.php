<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Materias;
use App\Http\Requests\MateriasRequest;
use Exception;


class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            // descomposition params get
            extract(request()->only([ 'query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn', 'sort']));
            $json = json_decode($query);
            $materia = Materias::class;

            $result['response'] = true;
            $result['count'] = $materia::count();
            $result['data'] = $materia::take((int) $limit)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MateriasRequest $request){
        try{
            $materia = new Materias();
            $materia->nombre = $request->nombre;
            $materia->descripcion = $request->descripcion;
            $materia->creditos = $request->creditos;
            
            $materia->save();
            return response()->json([
                'response' => true
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MateriasRequest $request, $id){
        try{
            $materia = Materias::find($id);
            $materia->nombre = $request->nombre;
            $materia->descripcion = $request->descripcion;
            $materia->creditos = $request->creditos;
            $materia->save();
            return response()->json([
                'response' => true
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'error' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
}
