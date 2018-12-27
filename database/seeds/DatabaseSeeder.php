<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         
         $this->call(ArchiveSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(TagSeeder::class);
         $this->call(PostSeeder::class);
         $this->call(ComentSeeder::class);
         $this->call(PageSeeder::class);
         $this->call(PostCategorySeeder::class);
         $this->call(PostTagSeeder::class);
         $this->call(ArchiveAssignmentSeeder::class);
    }
}