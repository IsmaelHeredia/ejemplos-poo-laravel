<?php

namespace App\Services;

class EnvioTerrestre extends MetodoEnvioAbstract
{
    public function enviar($productoId)
    {
        return $this->registrarEnvio($productoId) . "Envío realizado por vía terrestre";
    }
}
