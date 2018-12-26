<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = \App\Http\Models\Entities\Tag::create([    

            'name' => 'tag1',
            'slug' => 'slug1',
            'description'=> 'prueba tag1',          
            'active'=> 1                
           
        ]);
        $tag = \App\Http\Models\Entities\Tag::create([    

            'name' => 'tag2',
            'slug' => 'slug2',
            'description'=> 'prueba tag2',          
            'active'=> 1                
           
        ]);
    }
}
