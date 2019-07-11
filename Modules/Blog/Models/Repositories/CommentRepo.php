<?php

namespace Modules\Blog\Models\Repositories;

use Modules\Blog\Models\Entities\CategoryBlog;
use Modules\Blog\Models\Entities\CommentBlog;
use Modules\Blog\Models\Enums\ActiveCategory;
use Modules\Blog\Models\Enums\StatusCommentBlog;

class CommentRepo
{
    public function all()
    {

        $comments = CommentBlog::all();
        return $comments;

    }

    public function allStatus($status)
    {
        $menu = CommentBlog::where(['status' => $status])->get();

        return $menu;
    }

    public function find($id)
    {

        $category = CommentBlog::find($id);

        return $category;
    }

    public function store($data)
    {

        $category = new CommentBlog();
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

        $category = CommentBlog::destroy($id);

        return $category;
    }

    public function findbyid($id)
    {

        $category = CommentBlog::find($id);


        return $category;
    }
//
//
//    public function filteractive()
//    {
//        //Find By parameters (Item)
//        try {
//            $category = CategoryBlog::whereIn('active', [1])->get();
//            foreach ($category as $onecategory) {
//                $categorysuperior = CategoryBlog::find($onecategory->parent_category);
//                $onecategory->superiorcategory = $categorysuperior;
//            }
//
//            return $category;
//
//        } catch (\Exception $ex) {
//
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
//
//    public function filterinactive()
//    {
//        //Find By parameters (Item)
//        try {
//            $category = CategoryBlog::whereIn('active', [0])->get();
//            foreach ($category as $onecategory) {
//                $categorysuperior = CategoryBlog::find($onecategory->parent_category);
//                $onecategory->superiorcategory = $categorysuperior;
//            }
//
//            return $category;
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
//
//    public function filterdeleted()
//    {
//        //Find By parameters (Item)
//        try {
//            $category = CategoryBlog::whereIn('active', [2])->get();
//            foreach ($category as $onecategory) {
//                $categorysuperior = CategoryBlog::find($onecategory->parent_category);
//                $onecategory->superiorcategory = $categorysuperior;
//            }
//
//            return $category;
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
//
//    public function filterby($item, $id)
//    {
//        //Find By parameters (Item)
//        try {
//            if ($item === 'parent_category') {
//                $category = CategoryBlog::where('parent_category', $id)
//                    ->whereIn('active', [0, 1])->get();
//                foreach ($category as $onecategory) {
//                    $categorysuperior = CategoryBlog::find($onecategory->parent_category);
//                    $onecategory->superiorcategory = $categorysuperior;
//                }
//            }
//            return $category;
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
//
//    public function findbyunique($item, $string)
//    {
//        //Find By parameters (Item)
//        try {
//            if ($item === 'name') {
//
//
//                $category = CategoryBlog::where('name', $string)
//                    ->whereIn('active', [0, 1])->get();
//                foreach ($category as $onecategory) {
//                    $categorysuperior = CategoryBlog::find($onecategory->parent_category);
//                    $onecategory->superiorcategory = $categorysuperior;
//                }
//            }
//
//            if ($item === 'slug') {
//
//
//                $category = CategoryBlog::where('slug', $string)
//                    ->whereIn('active', [0, 1])->get();
//                foreach ($category as $onecategory) {
//                    $categorysuperior = CategoryBlog::find($onecategory->parent_category);
//                    $onecategory->superiorcategory = $categorysuperior;
//                }
//            }
//            return $category;
//
//        } catch (\Exception $ex) {
//
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error internor') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
//
//    public function checkduplicate($item, $string)
//    {
//        //Find By parameters (Item)
//        try {
//            if ($item === 'name') {
//
//                $category = CategoryBlog::where('name', $string)
//                    ->whereIn('active', [0, 1])
//                    ->exists();
//
//            }
//            if ($item === 'slug') {
//
//                $category = CategoryBlog::where('slug', $string)
//                    ->whereIn('active', [0, 1])
//                    ->exists();
//
//            }
//            return $category;
//
//        } catch (\Exception $ex) {
//
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => __('Ocurrio un error internor') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
}
