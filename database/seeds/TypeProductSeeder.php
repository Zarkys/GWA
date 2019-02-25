<?php

use Illuminate\Database\Seeder;

class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $typeproduct = \App\Http\Models\Entities\TypeProduct::create([    

            'name' => 'name 1 type product',
            'description'=> 'description 1 type product',          
            'active'=> 1                
           
        ]);
        $typeproduct = \App\Http\Models\Entities\TypeProduct::create([    

            'name' => 'name 2 type product',
            'description'=> 'description 2 type product',          
            'active'=> 1                
           
        ]);
    }
}
