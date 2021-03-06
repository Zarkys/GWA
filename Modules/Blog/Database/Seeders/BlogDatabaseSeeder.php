<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BlogDatabaseSeeder extends Seeder
{

    public function run()
    {

        $this->call(CategoriesBlogTableSeeder::class);
        $this->call(TagBlogTableSeeder::class);

    }
}
