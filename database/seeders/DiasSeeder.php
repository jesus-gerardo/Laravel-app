<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dias;

class DiasSeeder extends Seeder{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //
        Dias::create([
            'nombre'=> "Lunes"
        ]);
        Dias::create([
            'nombre'=> "Martes"
        ]);        
        Dias::create([
            'nombre'=> "Miercoles"
        ]);
        Dias::create([
            'nombre'=> "Jueves"
        ]);
        Dias::create([
            'nombre'=> "Viernes"
        ]);
        Dias::create([
            'nombre'=> "Sabado"
        ]);
        Dias::create([
            'nombre'=> "Domingo"
        ]);
    }
}
