<?php

namespace App\Factories;

use App\Services\EnvioAereo;
use App\Services\EnvioTerrestre;
use Exception;

class MetodoEnvioFactory
{
    public static function create($metodo)
    {
        return match ($metodo) {
            'aereo' => app(EnvioAereo::class),
            'terrestre' => app(EnvioTerrestre::class),
            default => throw new Exception('Método de envío no válido'),
        };
    }
}