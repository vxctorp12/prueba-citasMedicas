<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'apellido', 'dui', 'fecha_nacimiento'];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
