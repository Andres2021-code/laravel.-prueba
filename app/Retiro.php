<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retiro extends Model
{
    protected $table = "retiros";



    protected $fillable = [
        'codigo_retiro', 'id_usuario', 'id_cuenta', 'valor_retiro', 'descripcion'
    ];

}
