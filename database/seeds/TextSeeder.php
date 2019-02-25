<?php

use Illuminate\Database\Seeder;

class TextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $text = \App\Http\Models\Entities\Text::create([    

            'name' => 'titulo seccion1', 
            'value' => 'value section 1', 
            'id_section' => 1,             
            'active'=> 1                
           
        ]);
        $text = \App\Http\Models\Entities\Text::create([    

            'name' => 'titulo seccion 2',  
            'value' => 'value section 2', 
            'id_section' => 2,             
            'active'=> 1                
           
        ]);
    }
}
