<?php

namespace Modules\Website\Models\Repositories;

use Modules\Website\Models\Entities\Section;
use Modules\Website\Models\Enums\ActiveSection;
use Illuminate\Support\Facades\Log;
class SectionRepo
{

   /* public function all($id_user)
    {

        $section = Section::where('id_user',$id_user)->get();
        return $section;

    }*/

    public function allActive()
    {
        $menu = Section::where(['active' => ActiveSection::$activated])->get();

        return $menu;
    }

    public function find($id)
    {

        $section = Section::find($id);

        return $section;
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

    public function delete($id)
    {

        $section = Section::destroy($id);

        return $section;
    }

    public function findbyid($id)
    {

        $section = Section::find($id);


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
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
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
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
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
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function findbyunique($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'title') {

                $section = Section::where('title', $string)->whereIn('active', [0, 1])->get();
            }
            return $section;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
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

    public function checkduplicate($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'title') {

                $section = Section::where('title', $string)
                    ->whereIn('active', [0, 1])
                    ->exists();

            }
            return $section;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }
}
