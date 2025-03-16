<?php

namespace App\Services;

interface MetodoPagoInterface
{
    public function procesarPago($monto);
}