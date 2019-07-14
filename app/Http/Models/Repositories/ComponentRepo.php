<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Enums\ActiveModule;


class ComponentsRepo
{

    public function allStatus()
    {
        return [
            ['id' => ActiveModule::$disabled, 'name' => 'Desactivado'],
            ['id' => ActiveModule::$activated, 'name' => 'Activado'],
        ];
    }

}
