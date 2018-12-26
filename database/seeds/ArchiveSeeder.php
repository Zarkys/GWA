<?php

use Illuminate\Database\Seeder;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $archive = \App\Http\Models\Entities\Archive::create([    

            'name' => 'name1',
            'type' => 'type1',
            'creation_date'=> '2018-12-01 01:00:00', 
            'size'=> '2020 MB', 
            'dimension'=> '20x20', 
            'url' => 'http://url1',
            'title' => 'title1',
            'legend' => 'legend1',
            'alternative_text'=> 'alternative_text1',  
            'description'=> 'description1', 
            'id_user'=> 1,         
            'active'=> 1                
           
        ]);
          $archive = \App\Http\Models\Entities\Archive::create([    

            'name' => 'name2',
            'type' => 'type2',
            'creation_date'=> '2018-12-02 02:00:00', 
            'size'=> '2020 MB', 
            'dimension'=> '20x20', 
            'url' => 'http://url2',
            'title' => 'title2',
            'legend' => 'legend2',
            'alternative_text'=> 'alternative_text2', 
            'description'=> 'description2', 
            'id_user'=> 1,         
            'active'=> 1                
           
        ]);
         
    }
}
