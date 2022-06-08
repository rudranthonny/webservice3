<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;
    public function grados(){
        return $this->hasMany(Grado::class);
    }
    public function cursos(){
        return $this->hasMany(Curso::class);
    }
}
