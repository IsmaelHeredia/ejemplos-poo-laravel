<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $fillable = ['nombre', 'contacto', 'telefono'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
