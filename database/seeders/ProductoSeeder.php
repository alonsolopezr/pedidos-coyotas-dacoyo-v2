<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $coyotas =  [
            [
                'nombre' => 'Paquete de 10 Coyotas - Piloncillo',
                'descripcion' => 'Paquete de Coyotas con 10 piezas, rellenas de Piloncillo.',
                'imagen_1' => 'images/productos/coyotas_piloncillo.jpg',
                'precio' => 80.00,
            ],
            [
                'nombre' => 'Paquete de 10 Coyotas - Jamoncillo',
                'descripcion' => 'Paquete de Coyotas con 10 piezas, rellenas de Jamoncillo.',
                'imagen_1' => 'images/productos/coyotas_jamoncillo.jpg',
                'precio' => 90.00,
            ],
            [
                'nombre' => 'Paquete de 10 Coyotas - Jamoncillo con Nuéz',
                'descripcion' => 'Paquete de Coyotas con 10 piezas, rellenas de Jamoncillo con Nuéz.',
                'imagen_1' => 'images/productos/coyotas_jam_con_nuez.jpg',
                'precio' => 100.00,
            ],
            [
                'nombre' => 'Paquete de 10 Coyotas - Surtido',
                'descripcion' => 'Paquete de Coyotas con 10 piezas, surtido con los trés rellenos: Piloncillo, Jamoncillo y Jamoncillo con Nuéz.',
                'imagen_1' => 'images/productos/coyotas_surtidas.jpg',
                'precio' => 90.0,
            ],
            [
                'nombre' => 'Paquete de 5 Coyotas - Piloncillo',
                'descripcion' => 'Paquete de Coyotas con 5 piezas, rellenas de Piloncillo.',
                'imagen_1' => 'images/productos/coyotas_piloncillo.jpg',
                'precio' => 40.00,
            ],
            [
                'nombre' => 'Paquete de 5 Coyotas - Jamoncillo',
                'descripcion' => 'Paquete de Coyotas con 5 piezas, rellenas de Jamoncillo.',
                'imagen_1' => 'images/productos/coyotas_jamoncillo.jpg',
                'precio' => 45.00,
            ],
            [
                'nombre' => 'Paquete de 5 Coyotas - Jamoncillo con Nuéz',
                'descripcion' => 'Paquete de Coyotas con 5 piezas, rellenas de Jamoncillo con Nuéz.',
                'imagen_1' => 'images/productos/coyotas_jam_con_nuez.jpg',
                'precio' => 50.00,
            ],
            [
                'nombre' => 'Paquete de 5 Coyotas - Surtido',
                'descripcion' => 'Paquete de Coyotas con 5 piezas, surtido con los trés rellenos: Piloncillo, Jamoncillo y Jamoncillo con Nuéz.',
                'imagen_1' => 'images/productos/coyotas_surtidas.jpg',
                'precio' => 45.0,
            ],
            [
                'nombre' => '1 Coyota de Piloncillo',
                'descripcion' => 'Una Coyotas rellena de Piloncillo.',
                'imagen_1' => 'images/productos/coyotas_piloncillo.jpg',
                'precio' => 9.00,
            ],
            [
                'nombre' => '1 Coyota de Jamoncillo',
                'descripcion' => 'Una Coyotas rellena de Jamoncillo.',
                'imagen_1' => 'images/productos/coyotas_jamoncillo.jpg',
                'precio' => 10.00,
            ],
            [
                'nombre' => '1 Coyota de Jamoncillo con Nuéz',
                'descripcion' => 'Una Coyotas rellena de Jamoncillo con Nuéz.',
                'imagen_1' => 'images/productos/coyotas_jam_con_nuez.jpg',
                'precio' => 11.00,
            ],
        ];
        //
        foreach ($coyotas as $producto)
        {
            DB::table('productos')->insert($producto);
        }
    }
}