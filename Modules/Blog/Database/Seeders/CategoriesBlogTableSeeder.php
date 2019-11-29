<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\Models\Entities\CategoryBlog;

class CategoriesBlogTableSeeder extends Seeder
{

    public function run()
    {

        CategoryBlog::create([
            'name' => 'Categoria por defecto',
            'slug' => 'no-definido',
            'description' => '- - -',
            'active' => 1
        ]);

    }
}
