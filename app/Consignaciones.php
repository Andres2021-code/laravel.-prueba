<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignaciones extends Model
{
    protected $table = "consignaciones";



    protected $fillable = [
        'codigo_consignaciones', 'id_usuario', 'valor_consignacion', 'descripcion_consignacion'
    ];

}
