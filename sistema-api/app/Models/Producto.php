<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $baseFillable = ['nombre', 'precio', 'descripcion', 'stock', 'proveedor_id'];

    public function getFillable()
    {
        return array_merge($this->baseFillable, $this->fillable);
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function actualizarStock($cantidad)
    {
        if (!is_numeric($cantidad)) {
            throw new \InvalidArgumentException("La cantidad debe ser un número");
        }

        $this->stock = $cantidad;
        $this->save();
    }

}