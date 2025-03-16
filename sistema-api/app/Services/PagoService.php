<?php

namespace App\Services;

class PagoService
{
    protected $metodoPago;

    public function __construct(MetodoPagoInterface $metodoPago)
    {
        $this->metodoPago = $metodoPago;
    }

    public function procesar($metodo, $monto)
    {
        if ($metodo === 'tarjeta') {
            $this->metodoPago = app(\App\Services\PagoTarjeta::class);
        } elseif ($metodo === 'paypal') {
            $this->metodoPago = app(\App\Services\PagoPaypal::class);
        } else {
            throw new \Exception('Método de pago no válido');
        }

        return $this->metodoPago->procesarPago($monto);
    }
}