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
    public function find($id)
    {

        $page = Page::find($id);

        return $page;
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

    public function delete($page, $data)
    {

        $page->fill($data);
        $page->save();

        return $page;
    }
}
