<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\TypeProduct;  
use App\Http\Models\Entities\Attribute;
use App\Http\Models\Entities\TypeProductAttribute;

class TypeProductAttributeRepo
{
    public function all()
    {
        $typeproductattribute = TypeProductAttribute::with([
                'TypeProduct', 'Attribute',
            ])->whereIn('active', [0, 1])->get();           
        return $typeproductattribute;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
           
            $typeproductattribute = TypeProductAttribute::with([
                    'TypeProduct', 'Attribute',
                ])->whereIn('active', [1])->get();

            return $typeproductattribute;

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
           
            $typeproductattribute = TypeProductAttribute::with([
                    'TypeProduct', 'Attribute',
                ])->whereIn('active', [0])->get();

            return $typeproductattribute;

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
           
            $typeproductattribute = TypeProductAttribute::with([
                    'TypeProduct', 'Attribute',
                ])->whereIn('active', [2])->get();

            return $typeproductattribute;

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

        $typeproductattribute = TypeProductAttribute::find($id);

        return $typeproductattribute;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_type_product'){
                        //$typeproductstation = TypeProductStation::where('id_typeproduct', $id)->get();

                        $typeproductattribute = TypeProductAttribute::with([
                            'TypeProduct', 'Attribute',
                        ])->where('id_type_product', $id)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='id_attribute'){
                        $typeproductattribute = TypeProductAttribute::with([
                            'TypeProduct', 'Attribute',
                        ])->where('id_attribute', $id)->whereIn('active', [0, 1])->get();
                    }                
                      
               
                    return $typeproductattribute;

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

        $typeproductattribute = new TypeProductAttribute();
        $typeproductattribute->fill($data);
        $typeproductattribute->save();

        return $typeproductattribute;
    }

    public function update($typeproductattribute, $data)
    {

        $typeproductattribute->fill($data);
        $typeproductattribute->save();

        return $typeproductattribute;
    }
        public function activate($typeproductattribute, $data)
    {

        $typeproductattribute->fill($data);
        $typeproductattribute->save();

        return $typeproductattribute;
    }
        public function inactivate($typeproductattribute, $data)
    {

        $typeproductattribute->fill($data);
        $typeproductattribute->save();

        return $typeproductattribute;
    }

    public function delete($typeproductattribute, $data)
    {

        $typeproductattribute->fill($data);
        $typeproductattribute->delete();

        return $typeproductattribute;
    }

           public function checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond) {
            //Find By parameters (Item)
            try {
                    if($itemfirst==='id_type_product' && $itemsecond==='id_attribute')
                    {

                        $typeproductattribute = TypeProductAttribute::where('id_type_product', $stringfirst)
                        ->where('id_attribute', $stringsecond)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $typeproductattribute;

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
