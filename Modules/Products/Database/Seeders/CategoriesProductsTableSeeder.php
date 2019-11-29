<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Products\Models\Entities\CategoryProduct;

class CategoriesProductsTableSeeder extends Seeder
{

    public function run()
    {

        CategoryProduct::create([
            'name' => 'Categoria por defecto',
            'slug' => 'no-definido',
            'description' => '- - -',
            'active' => 1
        ]);

    }
}
