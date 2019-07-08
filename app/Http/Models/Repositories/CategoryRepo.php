<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\Category;

class CategoryRepo
{
    public function all()
    {

       // $category = Category::whereIn('active', [0, 1])->get();

        $category = Category::whereIn('active', [0, 1])->get();
            foreach ($category as $onecategory)
            {
                $categorysuperior = Category::find($onecategory->parent_category);
                $onecategory->superiorcategory = $categorysuperior;
            }
        return $category;

    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $category = Category::whereIn('active', [1])->get();
            foreach ($category as $onecategory)
            {
                $categorysuperior = Category::find($onecategory->parent_category);
                $onecategory->superiorcategory = $categorysuperior;
            }

            return $category;

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
            $category = Category::whereIn('active', [0])->get();
            foreach ($category as $onecategory)
            {
                $categorysuperior = Category::find($onecategory->parent_category);
                $onecategory->superiorcategory = $categorysuperior;
            }

            return $category;

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
            $category = Category::whereIn('active', [2])->get();
            foreach ($category as $onecategory)
            {
                $categorysuperior = Category::find($onecategory->parent_category);
                $onecategory->superiorcategory = $categorysuperior;
            }

            return $category;

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

        $category = Category::find($id);
        $categorysuperior = Category::find($category->parent_category);
                $category->superiorcategory = $categorysuperior;
        

        return $category;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='parent_category'){
 $category = Category::where('parent_category', $id)
                        ->whereIn('active', [0,1])->get();
                        foreach ($category as $onecategory)
                        {
                            $categorysuperior = Category::find($onecategory->parent_category);
                            $onecategory->superiorcategory = $categorysuperior;
                        }
                    }  
                    return $category;

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

                                    
                        $category = Category::where('name', $string)
                        ->whereIn('active', [0,1])->get();
                        foreach ($category as $onecategory)
                        {
                            $categorysuperior = Category::find($onecategory->parent_category);
                            $onecategory->superiorcategory = $categorysuperior;
                        }
                    } 

                    if($item==='slug'){

                                    
                        $category = Category::where('slug', $string)
                        ->whereIn('active', [0,1])->get();
                        foreach ($category as $onecategory)
                        {
                            $categorysuperior = Category::find($onecategory->parent_category);
                            $onecategory->superiorcategory = $categorysuperior;
                        }
                    } 
                    return $category;

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

        $category = new Category();
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function update($category, $data)
    {

        $category->fill($data);
        $category->save();

        return $category;
    }
    public function activate($category, $data)
    {

        $category->fill($data);
        $category->save();

        return $category;
    }
    public function inactivate($category, $data)
    {

        $category->fill($data);
        $category->save();

        return $category;
    }

    public function delete($category, $data)
    {

        $category->fill($data);
        $category->save();

        return $category;
    }

    public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name')
                    {

                        $category = Category::where('name', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    }  
                     if($item==='slug')
                    {

                        $category = Category::where('slug', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $category;

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
