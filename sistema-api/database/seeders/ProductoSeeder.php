<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Proveedor;
use Faker\Factory as Faker;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $proveedores = Proveedor::all();

        foreach ($proveedores as $proveedor) {
            $esFisico = $faker->boolean;

            Producto::create([
                'nombre' => $faker->word,
                'descripcion' => $faker->sentence,
                'precio' => $faker->randomFloat(2, 10, 500),
                'stock' => $faker->numberBetween(1, 100),
                'peso' => $esFisico ? $faker->randomFloat(2, 0.5, 20) : null,
                'dimensiones' => $esFisico ? $faker->randomElement(['10x15x20', '30x40x50', '5x5x5']) : null,
                'url_descarga' => !$esFisico ? $faker->url : null,
                'licencia' => !$esFisico ? $faker->uuid : null,
                'proveedor_id' => $proveedor->id,
            ]);
        }
    }
}
