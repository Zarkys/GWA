<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\Post;  
use App\Http\Models\Entities\Tag;
use App\Http\Models\Entities\PostTag;

class PostTagRepo
{
    public function all()
    {
        $posttag = PostTag::with([
                'Post', 'Tag',
            ])->whereIn('active', [0, 1])->get();           
        return $posttag;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
           
            $posttag = PostTag::with([
                    'Post', 'Tag',
                ])->whereIn('active', [1])->get();

            return $posttag;

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

        $posttag = PostTag::find($id);

        return $posttag;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_post'){
                        //$productstation = ProductStation::where('id_product', $id)->get();

                        $posttag = PostTag::with([
                            'Post', 'Tag',
                        ])->where('id_post', $id)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='id_tag'){
                        $posttag = PostTag::with([
                            'Post', 'Tag',
                        ])->where('id_tag', $id)->whereIn('active', [0, 1])->get();
                    }                
                      
               
                    return $posttag;

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

    public function store($data)
    {

        $posttag = new PostTag();
        $posttag->fill($data);
        $posttag->save();

        return $posttag;
    }

    public function update($posttag, $data)
    {

        $posttag->fill($data);
        $posttag->save();

        return $posttag;
    }

    public function delete($posttag, $data)
    {

        $posttag->fill($data);
        $posttag->save();

        return $posttag;
    }
}
