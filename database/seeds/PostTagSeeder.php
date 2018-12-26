<?php

use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PostTag = \App\Http\Models\Entities\PostTag::create([    

            'id_post'=> 1,   
            'id_tag' => 1,       
            'active'=> 1                
           
        ]);
       $PostTag = \App\Http\Models\Entities\PostTag::create([    

             
            'id_post'=> 2,   
            'id_tag' => 2,       
            'active'=> 1                
           
        ]);
    }
}
