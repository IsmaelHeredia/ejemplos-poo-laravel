<?php

namespace App\Models;

class ProductoFisico extends Producto
{
    protected $fillable = ['peso', 'dimensiones'];
}