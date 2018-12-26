<?php

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $page = \App\Http\Models\Entities\Page::create([    

            'title' => 'title1',
            'content'=> 'content1', 
            'id_featured_image' => 1,
            'visibility'=> 'no visible', 
            'status_page'=> 1,   
            'id_user' => 1,
            'permanent_link'=> 'permanent_link1',
            'creation_date' => '2018-12-01 01:00:00',
            'publication_date' => '2018-12-01 01:00:00',
            'modification_date' => '2018-12-01 01:00:00',       
            'active'=> 1                
           
        ]);
         $page = \App\Http\Models\Entities\Page::create([    

            'title' => 'title2',
            'content'=> 'content2', 
            'id_featured_image' => 2,
            'visibility'=> 'visible', 
            'status_page'=> 2,   
            'id_user' => 2,
            'permanent_link'=> 'permanent_link2',
            'creation_date' => '2018-12-02 02:00:00',
            'publication_date' => '2018-12-02 02:00:00',
            'modification_date' => '2018-12-02 02:00:00',       
            'active'=> 1                
           
        ]);
    }
}
