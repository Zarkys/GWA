<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\CategoryForProduct;

class CategoryForProductRepo
{
    public function all()
    {

       // $categoryforproduct = categoryforproduct::whereIn('active', [0, 1])->get();

        $categoryforproduct = CategoryForProduct::whereIn('active', [0, 1])->get();
        return $categoryforproduct;

    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $categoryforproduct = CategoryForProduct::whereIn('active', [1])->get();
            return $categoryforproduct;

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
            $categoryforproduct = CategoryForProduct::whereIn('active', [0])->get();
            return $categoryforproduct;

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
            $categoryforproduct = CategoryForProduct::whereIn('active', [2])->get();
            return $categoryforproduct;

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

        $categoryforproduct = CategoryForProduct::find($id);
        

        return $categoryforproduct;
    }

   /* public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){
 $categoryforproduct = CategoryForProduct::where('name', $id)
                        ->whereIn('active', [0,1])->get();
                    }  
                    return $categoryforproduct;

            } catch (\Exception $ex) {
               Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            } 
        } */

    public function findbyunique($item,$string) {
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
        } 

    public function store($data)
    {

        $categoryforproduct = new CategoryForProduct();
        $categoryforproduct->fill($data);
        $categoryforproduct->save();

        return $categoryforproduct;
    }

    public function update($categoryforproduct, $data)
    {

        $categoryforproduct->fill($data);
        $categoryforproduct->save();

        return $categoryforproduct;
    }
    public function activate($categoryforproduct, $data)
    {

        $categoryforproduct->fill($data);
        $categoryforproduct->save();

        return $categoryforproduct;
    }
    public function inactivate($categoryforproduct, $data)
    {

        $categoryforproduct->fill($data);
        $categoryforproduct->save();

        return $categoryforproduct;
    }

    public function delete($categoryforproduct, $data)
    {

        $categoryforproduct->fill($data);
        $categoryforproduct->save();

        return $categoryforproduct;
    }

    public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name')
                    {

                        $categoryforproduct = CategoryForProduct::where('name', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

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
        } 
}
