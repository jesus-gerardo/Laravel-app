<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedientesAlumnos extends Model{
    use HasFactory;

    protected $appends = [
        'full_name'
    ];
 
    public function getFullNameAttribute(){
        return "{$this->nombre} {$this->primer_apellido} {$this->segundo_apellido}";
    }
}
