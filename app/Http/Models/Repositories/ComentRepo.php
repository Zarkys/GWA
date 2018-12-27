<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\Post;  
use App\Http\Models\Entities\Coment;

class ComentRepo
{
    public function all()
    {

       /* $coment = Coment::with([
                'Post',
            ])->whereIn('active', [0, 1])->get();
        return $coment;*/

        $coment = Coment::with([
                'Post',
            ])->whereIn('active', [0, 1])->get();
            foreach ($coment as $onecoment)
            {
                $answerto = Coment::find($onecoment->id_answer_to);
                $onecoment->coment = $answerto;
            }
       
        return $coment;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            
            $coment = Coment::with([
                    'Post',
                ])->whereIn('active', [1])->get();
            foreach ($coment as $onecoment)
            {
                $answerto = Coment::find($onecoment->id_answer_to);
                $onecoment->coment = $answerto;
            }

            return $coment;

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

        $coment = Coment::find($id);

        return $coment;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_answer_to'){

                        $coment = Coment::with([
                            'Post',
                        ])->where('id_answer_to', $id)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='id_post'){

                        $coment = Coment::with([
                            'Post',
                        ])->where('id_post', $id)->whereIn('active', [0, 1])->get();
                    } 
               
                    return $coment;

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

        $coment = new Coment();
        $coment->fill($data);
        $coment->save();

        return $coment;
    }

    public function update($coment, $data)
    {

        $coment->fill($data);
        $coment->save();

        return $coment;
    }

    public function delete($coment, $data)
    {

        $coment->fill($data);
        $coment->save();

        return $coment;
    }
}