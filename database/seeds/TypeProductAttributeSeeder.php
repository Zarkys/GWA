<?php

use Illuminate\Database\Seeder;

class TypeProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeproductattribute = \App\Http\Models\Entities\TypeProductAttribute::create([    

            'id_attribute' => 1,
            'id_type_product'=> 1,          
            'active'=> 1                
           
        ]);
        $typeproductattribute = \App\Http\Models\Entities\TypeProductAttribute::create([    

            'id_attribute' => 2,
            'id_type_product'=> 2,          
            'active'=> 1                
           
        ]);
    }
}
