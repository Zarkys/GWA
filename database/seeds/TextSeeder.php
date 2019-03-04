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

            'name' => 'title', 
            'value_es' => 'seccion prueba',
            'value_en' => 'section test', 
            'id_section' => 1,             
            'active'=> 1                
           
        ]);
        $text = \App\Http\Models\Entities\Text::create([    

            'name' => 'title2', 
            'value_es' => 'seccion prueba 2',
            'value_en' => 'section test 2', 
            'id_section' => 2,             
            'active'=> 1                
           
        ]);
    }
}
