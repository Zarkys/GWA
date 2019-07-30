<?php

namespace Modules\Products\Models\Repositories;


use Modules\Products\Models\Entities\TypeProduct;
use Modules\Products\Models\Enums\ActiveTypeProduct;

class TypeProductRepo
{
    public function all($id_user)
    {

        $data = TypeProduct::with([
            'User',
            'Products',
        ])->where('id_user', $id_user)->get();
        return $data;

    }

    public function allActive()
    {
        $menu = TypeProduct::where(['active' => ActiveTypeProduct::$activated])->get();

        return $menu;
    }

    public function find($id)
    {

        $data = TypeProduct::find($id);

        return $data;
    }

    public function store($val)
    {

        $data = new TypeProduct();
        $data->fill($val);
        $data->save();

        return $data;
    }

    public function update($data, $val)
    {

        $data->fill($val);
        $data->save();

        return $data;
    }

    public function delete($id)
    {

        $data = TypeProduct::destroy($id);

        return $data;
    }


}
