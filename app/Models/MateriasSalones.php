<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MateriasSalones extends Model{
    use HasFactory;
    
    public function salon(): HasOne{
        return $this->hasOne(Salones::class, 'id', 'salon_id');
    }
    public function materias(): HasOne{
        return $this->hasOne(Materias::class, 'id', 'salon_id');
    }
}
