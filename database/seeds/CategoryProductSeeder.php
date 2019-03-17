<?php

use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CategoryProduct = \App\Http\Models\Entities\CategoryProduct::create([    

            'id_product'=> 1,   
            'id_category_for_product' => 1,       
            'active'=> 1                
           
        ]);
        $CategoryProduct = \App\Http\Models\Entities\CategoryProduct::create([    

            'id_product'=> 1,   
            'id_category_for_product' => 2,       
            'active'=> 1                
           
        ]);
        $CategoryProduct = \App\Http\Models\Entities\CategoryProduct::create([    

            'id_product'=> 2,   
            'id_category_for_product' => 1,       
            'active'=> 1                
           
        ]);
        $CategoryProduct = \App\Http\Models\Entities\CategoryProduct::create([    

            'id_product'=> 2,   
            'id_category_for_product' => 2,       
            'active'=> 1                
           
        ]);
    }
}
