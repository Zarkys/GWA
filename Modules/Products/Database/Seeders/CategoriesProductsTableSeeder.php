<?php

namespace Modules\Products\Models\Entities;

use Illuminate\Database\Seeder;

class CategoriesProductsTableSeeder extends Seeder
{

    public function run()
    {

        CategoryProduct::create([
            'name' => 'No Definido',
            'slug' => 'no-definido',
            'active' => 1
        ]);

    }
}
