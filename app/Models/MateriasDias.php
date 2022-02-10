<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class MateriasDias extends Model{
    use HasFactory;
    
    public function dias(): HasOne{
        return $this->hasOne(Dias::class, 'id', 'dia_id');
    }

    public function horarios(): HasMany{
        return $this->hasMany(MateriasHorarios::class, 'materia_dia_id', 'id');
    }
}
