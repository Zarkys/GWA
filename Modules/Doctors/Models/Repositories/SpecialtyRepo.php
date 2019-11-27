<?php

namespace Modules\Doctors\Models\Repositories;

use Modules\Doctors\Models\Entities\Specialty;
use Modules\Doctors\Models\Enums\ActiveSpecialty;
use Illuminate\Support\Facades\Log;

class SpecialtyRepo
{
    public function all()
    {

        $Specialty = Specialty::whereIn('active', [0, 1])->get();
        return $Specialty;
    }

    public function allActive()
    {

        $specialty = Specialty::where(['active' => ActiveSpecialty::$activated])->get();

        return $specialty;
    }


    public function find($id)
    {

        $specialty = Specialty::find($id);

        return $specialty;
    }

    public function findbyunique($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'name') {
                $specialty = Specialty::where('name', $string)->get();
            }
            return $specialty;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }


    public function store($data)
    {

        $specialty = new Specialty();
        $specialty->fill($data);
        $specialty->save();

        return $specialty;
    }

    public function update($specialty, $data)
    {

        $specialty->fill($data);
        $specialty->save();

        return $specialty;
    }


    public function delete($id)
    {

        $specialty = Specialty::destroy($id);

        return $specialty;
    }

    public function findbyid($id)
    {

        $specialty = Specialty::find($id);


        return $specialty;
    }
}
