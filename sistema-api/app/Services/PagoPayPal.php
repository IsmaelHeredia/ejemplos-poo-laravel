<?php

namespace App\Services;

class PagoPayPal implements MetodoPagoInterface
{
    public function procesarPago($monto)
    {
        return "Pago con monto de $monto procesado con PayPal";
    }
}