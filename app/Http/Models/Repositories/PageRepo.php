<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\Page;  
use App\Http\Models\Entities\Archive;

class PageRepo
{
    public function all()
    {
         $page = Page::with([
                'Archive','User',
            ])->whereIn('active', [0, 1])->get();           
         return $page;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
        
            $page = Page::with([
                    'Archive','User',
                ])->whereIn('active', [1])->get();
                    
                    
               
            return $page;

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
        
            $page = Page::with([
                    'Archive','User',
                ])->whereIn('active', [0])->get();
                    
                    
               
            return $page;

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
        
            $page = Page::with([
                    'Archive','User',
                ])->whereIn('active', [2])->get();
                    
                    
               
            return $page;

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

        $page = Page::find($id);

        return $page;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='status_page'){

                        $page = Page::with([
                    'Archive','User',
                ])->where('status_page', $id)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='id_user'){

                        $page = Page::with([
                    'Archive','User',
                ])->where('id_user', $id)->whereIn('active', [0, 1])->get();
                    }
                    return $page;

            } catch (\Exception $ex) {
                
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error internor') . '.',
                ];
                
                return response()->json($response, 500);
            } 
        }



    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='title'){

                        $page = Page::with([
                    'Archive','User',
                ])->where('title', $string)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='permanent_link'){

                        $page = Page::with([
                    'Archive','User',
                ])->where('permanent_link', $string)->whereIn('active', [0, 1])->get();
                    }
                    return $page;

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

        $page = new Page();
        $page->fill($data);
        $page->save();

        return $page;
    }

    public function update($page, $data)
    {

        $page->fill($data);
        $page->save();

        return $page;
    }
    public function activate($page, $data)
    {

        $page->fill($data);
        $page->save();

        return $page;
    }
    public function inactivate($page, $data)
    {

        $page->fill($data);
        $page->save();

        return $page;
    }

    public function delete($page, $data)
    {

        $page->fill($data);
        $page->save();

        return $page;
    }

        public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='title')
                    {

                        $page = Page::where('title', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    if($item==='permanent_link')
                    {

                        $page = Page::where('permanent_link', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    }  
                    return $page;

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
