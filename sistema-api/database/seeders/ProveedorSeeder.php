<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;
use Faker\Factory as Faker;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 10; $i++) {
            Proveedor::create([
                'nombre' => $faker->company,
                'contacto' => $faker->unique()->companyEmail,
                'telefono' => $faker->phoneNumber,
            ]);
        }
    }
}
