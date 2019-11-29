<?php

namespace Modules\Doctors\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Modules\Doctors\Models\Repositories\DoctorRepo;
use Modules\Doctors\Models\Repositories\SpecialtyRepo;

class WebController extends BaseController
{
    private $DoctorRepo;
    private $SpecialtyRepo;

    public function __construct(DoctorRepo $DoctorRepo,SpecialtyRepo $SpecialtyRepo)
    {

        $this->DoctorRepo = $DoctorRepo;
        $this->SpecialtyRepo = $SpecialtyRepo;
    }

    public function listDoctors()
    {

        try {
            $doctor = $this->DoctorRepo->all();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $doctor,
            ];

            return response()->json($response, 200);

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

    public function listSpecialty()
    {

        try {
            $specialty = $this->SpecialtyRepo->all();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $specialty,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }


}
