<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Products\Models\Entities\CategoriesProductsTableSeeder;
use Modules\Products\Models\Entities\CurrenciesProductsTableSeeder;
use Modules\Products\Models\Entities\TypesProductsTableSeeder;

class ProductsDatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
        $this->call(CategoriesProductsTableSeeder::class);
        $this->call(TypesProductsTableSeeder::class);
        $this->call(CurrenciesProductsTableSeeder::class);
    }
}
