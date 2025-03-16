<?php

namespace App\Services;

use App\Factories\MetodoEnvioFactory;

class EnvioService
{
    protected $metodoEnvio;

    public function __construct(MetodoEnvioInterface $metodoEnvio)
    {
        $this->metodoEnvio = $metodoEnvio;
    }
    public function procesarEnvio($metodo, $productoId)
    {
        $metodoEnvio = MetodoEnvioFactory::create($metodo);
        return $metodoEnvio->enviar($productoId);
    }
}
