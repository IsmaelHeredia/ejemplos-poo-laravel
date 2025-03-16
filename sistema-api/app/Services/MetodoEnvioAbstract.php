<?php

namespace App\Services;

abstract class MetodoEnvioAbstract implements MetodoEnvioInterface
{
    public function registrarEnvio($productoId)
    {
        return "Registrando el envío del producto {$productoId}. ";
    }

    abstract public function enviar($productoId);
}