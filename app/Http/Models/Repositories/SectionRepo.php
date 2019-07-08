<?php

namespace App\Http\Models\Repositories;

use App\Http\Models\Entities\Section;

class SectionRepo
{
    public function all()
    {

        $section = Section::whereIn('active', [0, 1])->get();
        return $section;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
            $section = Section::whereIn('active', [1])->get();

            return $section;

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
            $section = Section::whereIn('active', [0])->get();

            return $section;

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
            $section = Section::whereIn('active', [2])->get();

            return $section;

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

        $section = Section::find($id);

        return $section;
    }

    public function findbyunique($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='title'){

                        $section = Section::where('title', $string)->whereIn('active', [0, 1])->get();
                    } 

                    return $section;

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

        $section = new Section();
        $section->fill($data);
        $section->save();

        return $section;
    }

    public function update($section, $data)
    {

        $section->fill($data);
        $section->save();

        return $section;
    }

    public function activate($section, $data)
    {

        $section->fill($data);
        $section->save();

        return $section;
    }

    public function inactivate($section, $data)
    {

        $section->fill($data);
        $section->save();

        return $section;
    }

    public function delete($section, $data)
    {

        $section->fill($data);
        $section->save();

        return $section;
    }

     public function checkduplicate($item,$string) {
            //Find By parameters (Item)
            try {
                    if($item==='title')
                    {

                        $section = Section::where('title', $string)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $section;

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
