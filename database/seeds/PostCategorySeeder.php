<?php

use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PostCategory = \App\Http\Models\Entities\PostCategory::create([    

            'id_post'=> 1,   
            'id_category' => 1,       
            'active'=> 1                
           
        ]);
       $PostCategory = \App\Http\Models\Entities\PostCategory::create([    

             
            'id_post'=> 2,   
            'id_category' => 2,       
            'active'=> 1                
           
        ]);
    }
}
