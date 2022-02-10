<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReticulasMaterias;
use Exception;

class ReticulasMateriasController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
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
    public function store(Request $request){
        try{
            $reticula = new ReticulasMaterias();
            $reticula->materia_id = $request->materia_id;
            $reticula->nombre = $request->nombre;
            $reticula->descripcion = $request->descripcion;
            $reticula->reticula_materia_id = $request->reticula_materia_id;
            $reticula->save();
            return response()->json([
                'response' => true,                
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
    public function update(Request $request, $id){
        try{
            $reticula = ReticulasMaterias::find($id);
            $reticula->materia_id = $request->materia_id;
            $reticula->nombre = $request->nombre;
            $reticula->descripcion = $request->descripcion;
            $reticula->reticula_materia_id = $request->reticula_materia_id;
            $reticula->save();
            return response()->json([
                'response' => true,                
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
