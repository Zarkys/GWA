<?php

use Illuminate\Database\Seeder;

class ArchiveAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $ArchiveAssignment = \App\Http\Models\Entities\ArchiveAssignment::create([    

            
            'id_page'=> 1, 
            'id_post'=> 1,   
            'id_archive' => 1,       
            'active'=> 1                
           
        ]);
       $ArchiveAssignment = \App\Http\Models\Entities\ArchiveAssignment::create([    

            
            'id_page'=> 2, 
            'id_post'=> 2,   
            'id_archive' => 2,       
            'active'=> 1                
           
        ]);
    }
}
