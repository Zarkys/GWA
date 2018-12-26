<?php

namespace App\Http\Models\Repositories;

    use Mockery\Matcher\Type;

    use App\Http\Models\Entities\Post;  
    use App\Http\Models\Entities\Category;
    use App\Http\Models\Entities\PostCategory;

class PostCategoryRepo
{
    public function all()
    {
         $postcategory = PostCategory::with([
                'Post', 'Category',
            ])->whereIn('active', [0, 1])->get();           
         return $postcategory;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
        
            $postcategory = PostCategory::with([
                    'Post', 'Category',
                ])->whereIn('active', [1])->get();
                    
                    
               
            return $postcategory;

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

        $postcategory = PostCategory::find($id);

        return $postcategory;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_post'){

                        $postcategory = PostCategory::with([
                            'Post', 'Category',
                        ])->where('id_post', $id)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='id_category'){
                        $postcategory = PostCategory::with([
                            'Post', 'Category',
                        ])->where('id_category', $id)->whereIn('active', [0, 1])->get();
                    }                
                      
               
                    return $postcategory;

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

        $postcategory = new PostCategory();
        $postcategory->fill($data);
        $postcategory->save();

        return $postcategory;
    }

    public function update($postcategory, $data)
    {

        $postcategory->fill($data);
        $postcategory->save();

        return $postcategory;
    }

    public function delete($postcategory, $data)
    {

        $postcategory->fill($data);
        $postcategory->save();

        return $postcategory;
    }
}
