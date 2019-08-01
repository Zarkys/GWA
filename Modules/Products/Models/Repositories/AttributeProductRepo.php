<?php

namespace Modules\Products\Models\Repositories;

use Modules\Products\Models\Entities\AttributeProduct;

class AttributeProductRepo
{

    public function all()
    {
        $data = AttributeProduct::all();

        return $data;
    }

    public function allPublic()
    {
        $data = AttributeProduct::where(['show_attr' => 1])->get();

        return $data;
    }

    public function allProductNull()
    {
        $data = AttributeProduct::where(['id_product' => null])->get();

        return $data;
    }

    public function allProduct($id)
    {
        $data = AttributeProduct::where(['id_product' => $id])->get();

        return $data;
    }

    public function find($id)
    {
        $data = AttributeProduct::find($id);

        return $data;
    }

    public function store($data)
    {
        $attr = new AttributeProduct();
        $attr->fill($data);
        $attr->save();

        return $attr;
    }

    public function delete($id)
    {
        $data = AttributeProduct::destroy($id);

        return $data;
    }

    public function deleteAll($product)
    {
        $data = AttributeProduct::where('id_product', $product)->delete();

        return $data;
    }

}
