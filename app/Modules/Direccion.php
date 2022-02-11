<?php
namespace App\Modules;

use Illuminate\Http\Request;
use App\Models\Direcciones;


class Direccion{

    public function store(Request $request, $id){ 
        $direccion = new Direcciones();
        $direccion->calle = $request->calle;
        $direccion->cruzamiento_1 = $request->cruzamiento_1;
        $direccion->cruzamiento_2 = $request->cruzamiento_2;
        $direccion->colonia = $request->colonia;
        $direccion->codigo_postal = $request->codigo_postal;
        $direccion->numero_interior = $request->numero_interior;
        $direccion->numero_exterior = $request->numero_exterior;
        $direccion->expediente_id = $id;
        $direccion->save();
        return $direccion;
    }

}