<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $section = \App\Http\Models\Entities\Section::create([    

            'title' => 'titulo seccion1',          
            'active'=> 1                
           
        ]);
        $section = \App\Http\Models\Entities\Section::create([    

            'title' => 'titulo seccion 2',        
            'active'=> 1                
           
        ]);
    }
}
