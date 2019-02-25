<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\Product;  
use App\Http\Models\Entities\Attribute;
use App\Http\Models\Entities\ProductAttribute;

class ProductAttributeRepo
{
    public function all()
    {
        $productattribute = ProductAttribute::with([
                'Product', 'Attribute',
            ])->whereIn('active', [0, 1])->get();           
        return $productattribute;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
           
            $productattribute = ProductAttribute::with([
                    'Product', 'Attribute',
                ])->whereIn('active', [1])->get();

            return $productattribute;

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
           
            $productattribute = ProductAttribute::with([
                    'Product', 'Attribute',
                ])->whereIn('active', [0])->get();

            return $productattribute;

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
           
            $productattribute = ProductAttribute::with([
                    'Product', 'Attribute',
                ])->whereIn('active', [2])->get();

            return $productattribute;

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

        $productattribute = ProductAttribute::find($id);

        return $productattribute;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_product'){
                        //$productstation = ProductStation::where('id_product', $id)->get();

                        $productattribute = ProductAttribute::with([
                            'Product', 'Attribute',
                        ])->where('id_product', $id)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='id_attribute'){
                        $productattribute = ProductAttribute::with([
                            'Product', 'Attribute',
                        ])->where('id_attribute', $id)->whereIn('active', [0, 1])->get();
                    }                
                      
               
                    return $productattribute;

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

        $productattribute = new ProductAttribute();
        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }

    public function update($productattribute, $data)
    {

        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }
        public function activate($productattribute, $data)
    {

        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }
        public function inactivate($productattribute, $data)
    {

        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }

    public function delete($productattribute, $data)
    {

        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }

           public function checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond) {
            //Find By parameters (Item)
            try {
                    if($itemfirst==='id_product' && $itemsecond==='id_attribute')
                    {

                        $productattribute = ProductAttribute::where('id_product', $stringfirst)
                        ->where('id_attribute', $stringsecond)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $productattribute;

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
