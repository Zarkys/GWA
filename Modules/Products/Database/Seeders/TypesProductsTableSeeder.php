<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Products\Models\Entities\TypeProduct;

class TypesProductsTableSeeder extends Seeder
{

    public function run()
    {

        TypeProduct::create([
            'name' => 'Producto Digital',
            'description' => 'Descripcion del Producto Digital',
            'id_user' => 1,
            'active' => 1
        ]);

        TypeProduct::create([
            'name' => 'Producto Entregable',
            'description' => 'Descripcion del Producto Entregable',
            'id_user' => 1,
            'active' => 1
        ]);

        TypeProduct::create([
            'name' => 'Servicios',
            'description' => 'Descripcion del Servicio',
            'id_user' => 1,
            'active' => 1
        ]);

    }
}
