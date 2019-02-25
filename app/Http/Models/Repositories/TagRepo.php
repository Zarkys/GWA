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
    public function filterinactive()
    {
        //Find By parameters (Item)
        try {
            $tag = Tag::whereIn('active', [0])->get();

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
    public function filterdeleted()
    {
        //Find By parameters (Item)
        try {
            $tag = Tag::whereIn('active', [2])->get();

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
    public function findbyid($id)
    {

        $tag = Tag::find($id);

        return $tag;
    }

    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){

                        $tag = Tag::where('name', $string)->whereIn('active', [0, 1])->get();
                    } 
                    if($item==='slug'){

                        $tag = Tag::where('slug', $string)->whereIn('active', [0, 1])->get();
                    } 
                    return $tag;

            } catch (\Exception $ex) {
                
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error internor') . '.',
                ];
                
                return response()->json($response, 500);
            } 
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

    public function activate($tag, $data)
    {

        $tag->fill($data);
        $tag->save();

        return $tag;
    }

    public function inactivate($tag, $data)
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

     public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name')
                    {

                        $tag = Tag::where('name', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    if($item==='slug')
                    {

                        $tag = Tag::where('slug', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $tag;

            } catch (\Exception $ex) {
                
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error internor') . '.',
                ];
                
                return response()->json($response, 500);
            } 
        }
}
