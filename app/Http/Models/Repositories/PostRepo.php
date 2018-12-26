<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\Post;  
use App\Http\Models\Entities\Archive;

class PostRepo
{
    public function all()
    {
         $post = Post::with([
                'Archive',
            ])->whereIn('active', [0, 1])->get();           
         return $post;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
        
            $post = Post::with([
                    'Archive',
                ])->whereIn('active', [1])->get();
                    
                    
               
            return $post;

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

        $post = Post::find($id);

        return $post;
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

    public function delete($post, $data)
    {

        $post->fill($data);
        $post->save();

        return $post;
    }
}
