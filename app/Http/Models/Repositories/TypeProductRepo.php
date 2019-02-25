<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\TypeProduct;

class TypeProductRepo
{
    public function all()
    {

        $typeproduct = TypeProduct::whereIn('active', [0, 1])->get();
        return $typeproduct;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $typeproduct = TypeProduct::whereIn('active', [1])->get();

            return $typeproduct;

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
            $typeproduct = TypeProduct::whereIn('active', [0])->get();

            return $typeproduct;

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
            $typeproduct = TypeProduct::whereIn('active', [2])->get();

            return $typeproduct;

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

        $typeproduct = TypeProduct::find($id);

        return $typeproduct;
    }

    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){

                        $typeproduct = TypeProduct::where('name', $string)->whereIn('active', [0, 1])->get();
                    } 
                    return $typeproduct;

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

        $typeproduct = new TypeProduct();
        $typeproduct->fill($data);
        $typeproduct->save();

        return $typeproduct;
    }

    public function update($typeproduct, $data)
    {

        $typeproduct->fill($data);
        $typeproduct->save();

        return $typeproduct;
    }

    public function activate($typeproduct, $data)
    {

        $typeproduct->fill($data);
        $typeproduct->save();

        return $typeproduct;
    }

    public function inactivate($typeproduct, $data)
    {

        $typeproduct->fill($data);
        $typeproduct->save();

        return $typeproduct;
    }

    public function delete($typeproduct, $data)
    {

        $typeproduct->fill($data);
        $typeproduct->save();

        return $typeproduct;
    }

     public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name')
                    {

                        $typeproduct = TypeProduct::where('name', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $typeproduct;

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
