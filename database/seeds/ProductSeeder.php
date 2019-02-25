<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = \App\Http\Models\Entities\Product::create([    

            'name' => 'name 1  product',
            'id_type_product'=> 1,          
            'active'=> 1                
           
        ]);
        $product = \App\Http\Models\Entities\Product::create([    

            'name' => 'name 2 type product',
            'id_type_product'=> 2,          
            'active'=> 1                
           
        ]);
    }
}
