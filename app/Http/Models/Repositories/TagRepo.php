<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\Tag;

class TagRepo
{
    public function all()
    {

        $tag = Tag::whereIn('active', [0, 1])->get();
        return $tag;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $tag = Tag::whereIn('active', [1])->get();

            return $tag;

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

        $tag = Tag::find($id);

        return $tag;
    }

    public function store($data)
    {

        $tag = new Tag();
        $tag->fill($data);
        $tag->save();

        return $tag;
    }

    public function update($tag, $data)
    {

        $tag->fill($data);
        $tag->save();

        return $tag;
    }

    public function delete($tag, $data)
    {

        $tag->fill($data);
        $tag->save();

        return $tag;
    }
}
