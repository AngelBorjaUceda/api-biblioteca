<?php

namespace App;

use App\Libro;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;

    //Campos Modelo Usuario
    protected $fillable = ['nombre','email','password'];

    //Relacion con Modelo Libros (N:M)
    public function libros(){
        return $this->belongsToMany(Libro::class)->withTimestamps();
      }
         /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
