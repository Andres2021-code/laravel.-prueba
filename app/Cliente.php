<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = [
        'tipo_doc', 'numero_cedula', 'apellidos', 'nombres', 'direccion', 'telefono', 'email'
    ];
}
