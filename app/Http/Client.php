<?php

class Client extends \Laravel\Passport\Client
{
    protected $fillable = [
        'name',
        'secret',
        'redirect',
        'personal_access_client',
        'password_client',
        'revoked',
        'tipo_id',
        'numero_identificacion'
    ];

    public function tipo_usuario()
    {
        return $this->belongsTo(Tipo_Usuario::class);
    } 
}