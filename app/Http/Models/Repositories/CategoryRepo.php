<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\Category;

class CategoryRepo
{
    public function all()
    {

        $category = Category::whereIn('active', [0, 1])->get();
        return $category;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $category = Category::whereIn('active', [1])->get();

            return $category;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status'  => 'FAILED',
                'code'    => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }
    public function find($id)
    {

        $category = Category::find($id);

        return $category;
    }

    public function store($data)
    {

        $category = new Category();
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

    public function delete($category, $data)
    {

        $category->fill($data);
        $category->save();

        return $category;
    }
}
