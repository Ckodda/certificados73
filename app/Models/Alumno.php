<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumno extends Model
{
    protected $table = "alumno";
    use HasFactory;
    public function certificados():HasMany
    {
        return $this->hasMany(Certificado::class,'id_alumno','id');
    }
}
