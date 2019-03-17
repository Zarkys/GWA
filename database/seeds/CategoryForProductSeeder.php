<?php

use Illuminate\Database\Seeder;

class CategoryForProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CategoryForProduct = \App\Http\Models\Entities\CategoryForProduct::create([    

            'name'=> 'name category product 1',   
            'description' => 'descripcion category product 1',       
            'active'=> 1                
           
        ]);
        $CategoryForProduct = \App\Http\Models\Entities\CategoryForProduct::create([    

            'name'=> 'name category product 2',   
            'description' => 'descripcion category product 2',       
            'active'=> 1                
           
        ]);
    }
}
