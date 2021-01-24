<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = "cuentas";



    protected $fillable = [
        'numero_cuenta', 'id_cliente', 'saldo', 'activa', 'clave_cuenta', 'descripcion'
    ];

}
