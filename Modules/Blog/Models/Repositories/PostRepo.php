<?php

namespace Modules\Blog\Models\Repositories;

use Modules\Blog\Models\Entities\Post;
use Modules\Blog\Models\Enums\StatusPostBlog;


class PostRepo
{
    public function all()
    {
        $post = Post::with([
//            'User',
            'Tags',
            'Category',
            'Comments',
        ])->Orderby('id','desc')->get();

        return $post;
    }

    public function filteractive()
    {
        //Find By parameters (Item)
        try {

            $post = Post::with(['User',
            ])->whereIn('active', [1])->get();


            return $post;

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

    public function filterinactive()
    {
        //Find By parameters (Item)
        try {

            $post = Post::with(['User',
            ])->whereIn('active', [0])->get();


            return $post;

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

            $post = Post::with(['User',
            ])->whereIn('active', [2])->get();


            return $post;

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

    public function find($id)
    {

        $post = Post::find($id);

        return $post;
    }

    public function findbyid($id)
    {

        $post = Post::with([
//            'User',
            'Tags',
            'Category',
        ])->where('id', $id)->first();

        return $post;
    }

    public function filterby($item, $id)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'status_post') {

                $post = Post::with(['User',
                ])->where('status_post', $id)->whereIn('active', [0, 1])->get();
            }
            if ($item === 'id_user') {

                $post = Post::with(['User',
                ])->where('id_user', $id)->whereIn('active', [0, 1])->get();
            }
            return $post;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function findbyunique($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'title') {

                $post = Post::with(['User',
                ])->where('title', $string)->whereIn('active', [0, 1])->get();
            }
            if ($item === 'permanent_link') {

                $post = Post::with(['User',
                ])->where('permanent_link', $string)->whereIn('active', [0, 1])->get();
            }
            return $post;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }


    public function store($data)
    {

        $post = new Post();
        $post->fill($data);
        $post->save();

        return $post;
    }

    public function update($post, $data)
    {

        $post->fill($data);
        $post->save();

        return $post;
    }

    public function activate($post, $data)
    {

        $post->fill($data);
        $post->save();

        return $post;
    }

    public function inactivate($post, $data)
    {

        $post->fill($data);
        $post->save();

        return $post;
    }

    public function delete($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();

        $post = Post::destroy($post->id);

        return $post;
    }

    public function checkduplicate($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'title') {

                $post = Post::where('title', $string)
                    ->whereIn('active', [0, 1])
                    ->exists();

            }
            if ($item === 'permanent_link') {

                $post = Post::where('permanent_link', $string)
                    ->whereIn('active', [0, 1])
                    ->exists();

            }
            return $post;

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
