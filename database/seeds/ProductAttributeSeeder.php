<?php

use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productattribute = \App\Http\Models\Entities\ProductAttribute::create([    

            'id_product' => 1,
            'id_attribute'=> 1,          
            'active'=> 1                
           
        ]);
        $productattribute = \App\Http\Models\Entities\ProductAttribute::create([    

            'id_product' => 2,
            'id_attribute'=> 2,          
            'active'=> 1                
           
        ]);
    }
}
