<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = \App\Http\Models\Entities\Category::create([    

            'name' => 'category1',
            'slug' => 'slug1',
            'description'=> 'prueba category1', 
            'parent_category'=> 1,          
            'active'=> 1                
           
        ]);
        $category = \App\Http\Models\Entities\Category::create([    

            'name' => 'category2',
            'slug' => 'slug2',
            'description'=> 'prueba category2', 
            'parent_category'=> 2,          
            'active'=> 1                
           
        ]);
    }
}
