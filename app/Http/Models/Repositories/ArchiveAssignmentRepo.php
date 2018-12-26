<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\Post;  
use App\Http\Models\Entities\Page; 
use App\Http\Models\Entities\Archive;
use App\Http\Models\Entities\ArchiveAssignment;

class ArchiveAssignmentRepo
{
    public function all()
    {

        $archiveassignment = ArchiveAssignment::with([
                'Post', 'Page','Archive',
            ])->whereIn('active', [0, 1])->get();           
         return $archiveassignment;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
           
            $archiveassignment = ArchiveAssignment::with([
                    'Post', 'Page','Archive',
                ])->whereIn('active', [1])->get();
                    
                    
               
            return $archiveassignment;

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

        $archiveassignment = ArchiveAssignment::find($id);

        return $archiveassignment;
    }

    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_post'){

                         $archiveassignment =  ArchiveAssignment::with([
                             'Post', 'Page','Archive',
                        ])->where('id_post', $id)->whereIn('active', [0, 1])->get();
                    }
                    if($item==='id_page'){

                         $archiveassignment = ArchiveAssignment::with([
                             'Post', 'Page','Archive',
                        ])->where('id_page', $id)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='id_archive'){
                         $archiveassignment = ArchiveAssignment::with([
                             'Post', 'Page','Archive',
                        ])->where('id_archive', $id)->whereIn('active', [0, 1])->get();
                    }                
                      
               
                    return  $archiveassignment;

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

        $archiveassignment = new ArchiveAssignment();
        $archiveassignment->fill($data);
        $archiveassignment->save();

        return $archiveassignment;
    }

    public function update($archiveassignment, $data)
    {

        $archiveassignment->fill($data);
        $archiveassignment->save();

        return $archiveassignment;
    }

    public function delete($archiveassignment, $data)
    {

        $archiveassignment->fill($data);
        $archiveassignment->save();

        return $archiveassignment;
    }
}
