<?php

namespace Modules\Doctors\Models\Repositories;


use Modules\Doctors\Models\Entities\Specialty;
use Modules\Doctors\Models\Enums\ActiveSpecialty;


class ComponentsRepo
{

    /*public function allStatus()
    {
        return [
            ['id' => StatusPostBlog::$draft, 'name' => 'Borrador'],
            ['id' => StatusPostBlog::$published, 'name' => 'Publicar'],
        ];
    }*/
    public function allSpecialty()
    {
        $specialties = Specialty::where('active', ActiveSpecialty::$activated)->get();
        return $specialties;
    }

}
