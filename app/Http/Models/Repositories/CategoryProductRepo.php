<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\CategoryProduct;

class CategoryProductRepo
{
    public function all()
    {

       // $categoryforproduct = categoryforproduct::whereIn('active', [0, 1])->get();

        $categoryproduct = CategoryProduct::with([
                'Product', 'CategoryForProduct',
            ])->whereIn('active', [0, 1])->get();
        return $categoryproduct;

    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $categoryproduct = CategoryProduct::with([
                'Product', 'CategoryForProduct',
            ])->whereIn('active', [1])->get();
            return $categoryproduct;

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
            $categoryproduct = CategoryProduct::with([
                'Product', 'CategoryForProduct',
            ])->whereIn('active', [0])->get();
            return $categoryproduct;

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
            $categoryproduct = CategoryProduct::with([
                'Product', 'CategoryForProduct',
            ])->whereIn('active', [2])->get();
            return $categoryproduct;

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

        $categoryproduct = CategoryProduct::with([
                'Product', 'CategoryForProduct',
            ])->find($id);
        

        return $categoryproduct;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_product'){
 $categoryproduct = CategoryProduct::with([
                'Product', 'CategoryForProduct',
            ])->where('id_product', $id)
                        ->whereIn('active', [0,1])->get();
                    } 
                    if($item==='id_category_for_product'){
 $categoryproduct = CategoryProduct::with([
                'Product', 'CategoryForProduct',
            ])->where('id_category_for_product', $id)
                        ->whereIn('active', [0,1])->get();
                    } 
                    return $categoryproduct;

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

   /* public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){
                        $categoryforproduct = CategoryForProduct::where('name', $string)
                        ->whereIn('active', [0,1])->get();
                    } 
                    return $categoryforproduct;

            } catch (\Exception $ex) {
                
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error internor') . '.',
                ];
                
                return response()->json($response, 500);
            } 
        } */

    public function store($data)
    {

        $categoryproduct = new CategoryProduct();
        $categoryproduct->fill($data);
        $categoryproduct->save();

        return $categoryproduct;
    }

    public function update($categoryproduct, $data)
    {

        $categoryproduct->fill($data);
        $categoryproduct->save();

        return $categoryproduct;
    }
    public function activate($categoryproduct, $data)
    {

        $categoryproduct->fill($data);
        $categoryproduct->save();

        return $categoryproduct;
    }
    public function inactivate($categoryproduct, $data)
    {

        $categoryproduct->fill($data);
        $categoryproduct->save();

        return $categoryproduct;
    }

    public function delete($categoryproduct, $data)
    {

        $categoryproduct->fill($data);
        $categoryproduct->save();

        return $categoryproduct;
    }

    public function checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond) {
            //Find By parameters (Item)
            try {
                    if($itemfirst==='id_product' && $itemsecond==='id_category_for_product')
                    {

                        $categoryproduct = CategoryProduct::where('id_product', $stringfirst)
                        ->where('id_category_for_product', $stringsecond)
                        ->whereIn('active', [0, 1])
                        ->exists();

                    }  
                    return $categoryproduct;

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
