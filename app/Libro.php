<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //Campos Modelo Libro
    protected $fillable = ['titulo','descripcion'];

    //Relacion con Modelo Usuarios (N:M)
    public function usuarios(){
      return $this->belongsToMany(Usuario::class)->withTimestamps();
    }

}
