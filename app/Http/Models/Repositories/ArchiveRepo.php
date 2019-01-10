<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\Archive;
use App\Http\Models\Entities\User;

class ArchiveRepo
{
    public function all()
    {

        $archive = Archive::with(['User',
            ])->whereIn('active', [0, 1])->get();           
         return $archive;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $archive = Archive::with(['User',
            ])->whereIn('active', [1])->get();           
         return $archive;

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
            $archive = Archive::with(['User',
            ])->whereIn('active', [0])->get();           
         return $archive;

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
            $archive = Archive::with(['User',
            ])->whereIn('active', [2])->get();           
         return $archive;

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

        $archive = Archive::find($id);

        return $archive;
    }

    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name'){

                        $archive = Archive::with(['User',
            ])->where('name', $string)->whereIn('active', [0, 1])->get();
                    }  
                    return $archive;

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

        $archive = new Archive();
        $archive->fill($data);
        $archive->save();

        return $archive;
    }

    public function update($archive, $data)
    {

        $archive->fill($data);
        $archive->save();

        return $archive;
    }

    public function activate($archive, $data)
    {

        $archive->fill($data);
        $archive->save();

        return $archive;
    }

    public function inactivate($archive, $data)
    {

        $archive->fill($data);
        $archive->save();

        return $archive;
    }

    public function delete($archive, $data)
    {

        $archive->fill($data);
        $archive->save();

        return $archive;
    }

    public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='name')
                    {

                        $archive = Archive::where('name', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    }  
                    return $archive;

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
