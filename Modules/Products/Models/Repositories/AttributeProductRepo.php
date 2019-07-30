<?php

namespace Modules\Products\Models\Repositories;

use Modules\Products\Models\Entities\AttributeProduct;

class AttributeProductRepo
{

    public function allPublic()
    {
        $data = AttributeProduct::where(['show_attr' => 1])->get();

        return $data;
    }

}
