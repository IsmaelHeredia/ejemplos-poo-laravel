<?php

namespace App\Services;

class EnvioAereo extends MetodoEnvioAbstract
{
    public function enviar($productoId)
    {
        return $this->registrarEnvio($productoId) . "Envío realizado por vía aérea";
    }
}