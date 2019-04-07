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
            'description' => 'description 1  product',
            'id_type_product'=> 1, 
            'image' => 'image1.png',
            'price'=> 1.40,
            'price_discount'=> 1.30,
            'show_price'=> 1.29,
            'id_category_for_product'=> 1,
            'active'=> 1                
           
        ]);
        $product = \App\Http\Models\Entities\Product::create([    

            'name' => 'name 2 type product',
            'description' => 'description 2  product',
            'id_type_product'=> 2,  
            'image' => 'image2.png',
            'price'=> 1.65, 
            'price_discount'=> 1.60,
            'show_price'=> 1.59,  
            'id_category_for_product'=> 2,     
            'active'=> 1                
           
        ]);
    }
}
