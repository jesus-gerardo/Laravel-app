<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Niveles;

use App\Http\Requests\NivelesRequest;
use Exception;
class NivelesController extends Controller
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
            $nivel = Niveles::class;

            $result['response'] = true;
            $result['count'] = $nivel::count();
            $result['data'] = $nivel::take((int) $limit)
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
    public function store(NivelesRequest $request){
        try{
            $nivel = new Niveles();
            $nivel->nivel = $request->nivel;
            $nivel->clave = $request->clave;
            $nivel->save();
            return response()->json([
                'response' => true 
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'error' => $e->getMessage()
            ], 400);
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
    public function update(NivelesRequest $request, $id){
        try{
            $nivel = Niveles::find($id);
            $nivel->nivel = $request->nivel;
            $nivel->clave = $request->clave;
            $nivel->save();

            return response()->json([
                'response' => true
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'response' => false,
                'error' => $e->getMessage()
            ], 400);
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
