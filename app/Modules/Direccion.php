<?php
namespace App\Modules;

use Illuminate\Http\Request;
use App\Models\Direcciones;


class Direccion{

    public function store(Request $request){ 
        $direccion = new Direcciones();
        $direccion->calle = $request->calle;
        $direccion->cruzamiento_1 = $request->cruzamiento_1;
        $direccion->cruzamiento_2 = $request->cruzamiento_2;
        $direccion->colonia = $request->colonia;
        $direccion->codigo_postal = $request->numero_interior;
        $direccion->numero_exterior = $request->numero_exterior;
        $direccion->save();
        return $direccion;
    }

}