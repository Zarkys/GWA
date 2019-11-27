<?php

namespace Modules\Doctors\Models\Repositories;

use Modules\Doctors\Models\Entities\Doctor;
use Modules\Doctors\Models\Enums\ActiveDoctor;
use Illuminate\Support\Facades\Log;

class DoctorRepo
{
    public function all()
    {

        $doctor = Doctor::with([
            'Specialty',
        ])->whereIn('active', [0, 1])
            ->orderBy('id_specialty', 'asc')
            ->get();
        return $doctor;
    }

    public function allActive()
    {

        $doctor = Doctor::with([
            'Specialty',
        ])->where(['active' => ActiveDoctor::$activated])
            ->orderBy('id_specialty', 'asc')
            ->get();
        return $doctor;
    }

    public function findbyunique($item, $string)
    {
        //Find By parameters (Item)
        try {
            log::Debug('entrando al repositorio');
            if ($item === 'name') {
                $doctor = Doctor::with([
                    'Specialty',
                ])->where('name', $string)->get();
            }

            return $doctor;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILEDr',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function find($id)
    {

        $doctor = Doctor::with([
            'Specialty',
        ])->find($id);

        return $doctor;
    }

    public function store($data)
    {

        $doctor = new Doctor();
        $doctor->fill($data);
        $doctor->save();

        return $doctor;
    }

    public function update($doctor, $data)
    {

        $doctor->fill($data);
        $doctor->save();

        return $doctor;
    }

    public function delete($id)
    {

        $doctor = Doctor::destroy($id);

        return $doctor;
    }

    public function findbyid($id)
    {

        $doctor = Doctor::with([
            'Specialty',
        ])->find($id);


        return $doctor;
    }
}
