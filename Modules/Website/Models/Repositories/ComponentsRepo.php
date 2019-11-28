<?php

namespace Modules\Website\Models\Repositories;


use Modules\Website\Models\Entities\Section;
use Modules\Website\Models\Enums\ActiveSection;
use Modules\Website\Models\Enums\ActiveText;
use Illuminate\Support\Facades\Log;

class ComponentsRepo
{

    /*public function allStatus()
    {
        return [
            ['id' => StatusPostBlog::$draft, 'name' => 'Borrador'],
            ['id' => StatusPostBlog::$published, 'name' => 'Publicar'],
        ];
    }*/
    public function allSection()
    {
        $sections = Section::where('active', ActiveSection::$activated)->get();
        return $sections;
    }

}
