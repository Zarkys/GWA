<?php

namespace Modules\Products\Models\Repositories;

use Modules\Products\Models\Entities\CategoryProduct;
use Modules\Products\Models\Enums\ActiveCategory;

class CategoryProductRepo
{
    public function all()
    {

        $category = CategoryProduct::all();
        return $category;

    }

    public function allActive()
    {
        $menu = CategoryProduct::where(['active' => ActiveCategory::$activated])->get();

        return $menu;
    }

    public function find($id)
    {

        $category = CategoryProduct::find($id);

        return $category;
    }

    public function store($data)
    {

        $category = new CategoryProduct();
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function update($category, $data)
    {

        $category->fill($data);
        $category->save();

        return $category;
    }

    public function delete($id)
    {

        $category = CategoryProduct::destroy($id);

        return $category;
    }

    public function findbyid($id)
    {

        $category = CategoryProduct::find($id);


        return $category;
    }

}
