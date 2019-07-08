<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\Attribute;

class AttributeRepo
{
    public function all()
    {

        $attribute = Attribute::whereIn('active', [0, 1])->get();
        return $attribute;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $attribute = Attribute::whereIn('active', [1])->get();

            return $attribute;

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
            $attribute = Attribute::whereIn('active', [0])->get();

            return $attribute;

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
            $attribute = Attribute::whereIn('active', [2])->get();

            return $attribute;

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

        $attribute = Attribute::find($id);

        return $attribute;
    }

    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){

                        $attribute = Attribute::where('name', $string)->whereIn('active', [0, 1])->get();
                    } 
                    return $attribute;

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

        $attribute = new Attribute();
        $attribute->fill($data);
        $attribute->save();

        return $attribute;
    }

    public function update($attribute, $data)
    {

        $attribute->fill($data);
        $attribute->save();

        return $attribute;
    }

    public function activate($attribute, $data)
    {

        $attribute->fill($data);
        $attribute->save();

        return $attribute;
    }

    public function inactivate($attribute, $data)
    {

        $attribute->fill($data);
        $attribute->save();

        return $attribute;
    }

    public function delete($attribute, $data)
    {

        $attribute->fill($data);
        $attribute->save();

        return $attribute;
    }

     public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name')
                    {

                        $attribute = Attribute::where('name', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $attribute;

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
