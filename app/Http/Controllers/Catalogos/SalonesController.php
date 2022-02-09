<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Salones;
use Exception;
use Illuminate\Http\Request;

class SalonesController extends Controller{
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
            $salones = Salones::class;

            $result['response'] = true;
            $result['count'] = $salones::count();
            $result['data'] = $salones::take((int) $limit)
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
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try{
            $salon = new Salones();
            $salon->clave = $request->clave;
            $salon->capacidad = $request->capacidad;
            $salon->save();
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
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        try{
            $salon = Salones::find($id);
            $salon->clave = $request->clave;
            $salon->capacidad = $request->capacidad;
            $salon->save();
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
