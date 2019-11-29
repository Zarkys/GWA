<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsDatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(CategoriesProductsTableSeeder::class);
        $this->call(TypesProductsTableSeeder::class);
        $this->call(CurrenciesProductsTableSeeder::class);
    }
}
