<?php

namespace App\Services;

class PagoTarjeta implements MetodoPagoInterface
{
    public function procesarPago($monto)
    {
        return "Pago con monto de $monto procesado con tarjeta de crédito";
    }
}