<?php

use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attribute = \App\Http\Models\Entities\Attribute::create([    

            'name' => 'name 1 attribute',
            'description'=> 'description 1 attribute',          
            'active'=> 1                
           
        ]);
        $attribute = \App\Http\Models\Entities\Attribute::create([    

            'name' => 'name 2 attribute',
            'description'=> 'description 2 attribute',          
            'active'=> 1                
           
        ]);
    }
}
