<?php

namespace Modules\Blog\Models\Repositories;

use Modules\Blog\Models\Entities\CategoryBlog;
use Modules\Blog\Models\Entities\Tag;
use Modules\Blog\Models\Enums\ActiveCategory;
use Modules\Blog\Models\Enums\ActiveTag;
use Modules\Blog\Models\Enums\StatusPostBlog;


class ComponentsRepo
{

    public function allStatus()
    {
        return [
            ['id' => StatusPostBlog::$draft, 'name' => 'Borrador'],
            ['id' => StatusPostBlog::$published, 'name' => 'Publicar'],
        ];
    }

    public function allCategory()
    {
        $category = CategoryBlog::where('active', ActiveCategory::$activated)->get();
        return $category;
    }

    public function allTag()
    {
        $tags = Tag::where('active', ActiveTag::$activated)->get();
        return $tags;
    }

}
