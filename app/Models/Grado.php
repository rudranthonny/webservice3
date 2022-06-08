<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    public function areas(){
        return $this->hasMany(Area::class);
    }

    public function periodo(){
        return $this->belongsTo(periodo::class);
    }

    public function plantilla(){
        return $this->belongsTo(Plantilla::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
    
}
