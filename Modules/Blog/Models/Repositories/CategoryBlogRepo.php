<?php

namespace Modules\Blog\Models\Repositories;

use Modules\Blog\Models\Entities\CategoryBlog;
use Modules\Blog\Models\Enums\ActiveCategory;

class CategoryBlogRepo
{
    public function all()
    {

        $category = CategoryBlog::all();
        return $category;

    }

    public function allActive()
    {
        $menu = CategoryBlog::where(['active' => ActiveCategory::$activated])->get();

        return $menu;
    }

    public function find($id)
    {

        $category = CategoryBlog::find($id);

        return $category;
    }

    public function store($data)
    {

        $category = new CategoryBlog();
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

        $category = CategoryBlog::destroy($id);

        return $category;
    }

    public function findbyid($id)
    {

        $category = CategoryBlog::find($id);


        return $category;
    }


    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $category = CategoryBlog::whereIn('active', [1])->get();
            foreach ($category as $onecategory) {
                $categorysuperior = CategoryBlog::find($onecategory->parent_category);
                $onecategory->superiorcategory = $categorysuperior;
            }

            return $category;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function filterinactive()
    {
        //Find By parameters (Item)
        try {
            $category = CategoryBlog::whereIn('active', [0])->get();
            foreach ($category as $onecategory) {
                $categorysuperior = CategoryBlog::find($onecategory->parent_category);
                $onecategory->superiorcategory = $categorysuperior;
            }

            return $category;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function filterdeleted()
    {
        //Find By parameters (Item)
        try {
            $category = CategoryBlog::whereIn('active', [2])->get();
            foreach ($category as $onecategory) {
                $categorysuperior = CategoryBlog::find($onecategory->parent_category);
                $onecategory->superiorcategory = $categorysuperior;
            }

            return $category;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function filterby($item, $id)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'parent_category') {
                $category = CategoryBlog::where('parent_category', $id)
                    ->whereIn('active', [0, 1])->get();
                foreach ($category as $onecategory) {
                    $categorysuperior = CategoryBlog::find($onecategory->parent_category);
                    $onecategory->superiorcategory = $categorysuperior;
                }
            }
            return $category;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function findbyunique($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'name') {


                $category = CategoryBlog::where('name', $string)
                    ->whereIn('active', [0, 1])->get();
                foreach ($category as $onecategory) {
                    $categorysuperior = CategoryBlog::find($onecategory->parent_category);
                    $onecategory->superiorcategory = $categorysuperior;
                }
            }

            if ($item === 'slug') {


                $category = CategoryBlog::where('slug', $string)
                    ->whereIn('active', [0, 1])->get();
                foreach ($category as $onecategory) {
                    $categorysuperior = CategoryBlog::find($onecategory->parent_category);
                    $onecategory->superiorcategory = $categorysuperior;
                }
            }
            return $category;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function checkduplicate($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'name') {

                $category = CategoryBlog::where('name', $string)
                    ->whereIn('active', [0, 1])
                    ->exists();

            }
            if ($item === 'slug') {

                $category = CategoryBlog::where('slug', $string)
                    ->whereIn('active', [0, 1])
                    ->exists();

            }
            return $category;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }
}
