<?php

use Illuminate\Database\Seeder;

class ComentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $coment = \App\Http\Models\Entities\Coment::create([    

            'coment' => 'coment1',
            'id_answer_to'=> 1, 
            'id_post' => 1,
            'status_coment'=> 1, 
            'publication_date' => '2018-12-01 01:00:00',
            'id_user'=> 1,          
            'active'=> 1                
           
        ]);
        $coment = \App\Http\Models\Entities\Coment::create([    

            'coment' => 'coment2',
            'id_answer_to'=> 2, 
            'id_post' => 2,
            'status_coment'=> 2, 
            'publication_date' => '2018-12-02 02:00:00',
            'id_user'=> 1,          
            'active'=> 2               
           
        ]);
    }
}
