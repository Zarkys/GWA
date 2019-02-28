<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\TypeProduct;  
use App\Http\Models\Entities\Product;

class ProductRepo
{
    public function all()
    {
        $product = Product::with([
                'TypeProduct',
            ])->whereIn('active', [0, 1])->get();           
        return $product;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
           
            $product = Product::with([
                    'TypeProduct',
                ])->whereIn('active', [1])->get();

            return $product;

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
           
            $product = Product::with([
                    'TypeProduct',
                ])->whereIn('active', [0])->get();

            return $product;

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
           
            $product = Product::with([
                    'TypeProduct',
                ])->whereIn('active', [2])->get();

            return $product;

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

        $product = Product::with([
            'TypeProduct',
        ])->find($id);

        return $product;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_type_product'){
                        //$productstation = ProductStation::where('id_product', $id)->get();

                        $product = Product::with([
                            'TypeProduct',
                        ])->where('id_type_product', $id)->whereIn('active', [0, 1])->get();
                    }                 
                      
               
                    return $product;

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

      public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){

                        $product = Product::where('name', $string)->whereIn('active', [0, 1])->get();
                    } 
                    return $product;

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

        $product = new Product();
        $product->fill($data);
        $product->save();

        return $product;
    }

    public function update($product, $data)
    {

        $product->fill($data);
        $product->save();

        return $product;
    }
        public function activate($product, $data)
    {

        $product->fill($data);
        $product->save();

        return $product;
    }
        public function inactivate($product, $data)
    {

        $product->fill($data);
        $product->save();

        return $product;
    }

    public function delete($product, $data)
    {

        $product->fill($data);
        $product->save();

        return $product;
    }

           public function checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond) {
            //Find By parameters (Item)
            try {
                    if($itemfirst==='name' && $itemsecond==='id_type_product')
                    {

                        $product = Product::where('name', $stringfirst)
                        ->where('id_type_product', $stringsecond)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $product;

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
