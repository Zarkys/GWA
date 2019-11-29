<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\Models\Entities\Tag;

class TagBlogTableSeeder extends Seeder
{

    public function run()
    {

        Tag::create([
            'name' => 'Tag por defecto',
            'slug' => 'no-definido',
            'description' => '- - -',
            'active' => 1

        ]);

    }
}
