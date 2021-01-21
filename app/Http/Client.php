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
}