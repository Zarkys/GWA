<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Products\Models\Entities\CurrenciesProductsTableSeeder;

class ProductsDatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
        $this->call(CurrenciesProductsTableSeeder::class);
    }
}
