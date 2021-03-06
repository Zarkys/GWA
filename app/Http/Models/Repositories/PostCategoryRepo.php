<?php

namespace App\Http\Models\Repositories;

    use Mockery\Matcher\Type;

    use App\Http\Models\Entities\Post;  
    use App\Http\Models\Entities\Category;
    use App\Http\Models\Entities\PostCategory;
    use Illuminate\Support\Facades\Log;

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

        public function filterinactive()
    {
        //Find By parameters (Item)
        try {
        
            $postcategory = PostCategory::with([
                    'Post', 'Category',
                ])->whereIn('active', [0])->get();
                    
                    
               
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
        public function filterdeleted()
    {
        //Find By parameters (Item)
        try {
        
            $postcategory = PostCategory::with([
                    'Post', 'Category',
                ])->whereIn('active', [2])->get();
                    
                    
               
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
    public function findbyid($id)
    {

        $postcategory = PostCategory::with([
                            'Post', 'Category',
                        ])->find($id);

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

    public function activate($postcategory, $data)
    {

        $postcategory->fill($data);
        $postcategory->save();

        return $postcategory;
    }

        public function inactivate($postcategory, $data)
    {

        $postcategory->fill($data);
        $postcategory->save();

        return $postcategory;
    }

   /* public function delete($postcategory, $data)
    {

        $postcategory->fill($data);
        $postcategory->save();

        return $postcategory;
    }*/
     public function delete($postcategory, $data)
    {

        $postcategory->fill($data);
        $postcategory->delete();

        return $postcategory;
    }

    public function checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond) {
            //Find By parameters (Item)
            try {
                    if($itemfirst==='id_post' && $itemsecond==='id_category')
                    {

                        $postcategory = PostCategory::where('id_post', $stringfirst)
                        ->where('id_category', $stringsecond)
                        ->whereIn('active', [0, 1])
                        ->exists();

                    }  
                    return $postcategory;

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
