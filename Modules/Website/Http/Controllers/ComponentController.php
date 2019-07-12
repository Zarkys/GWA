<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Modules\Website\Models\Repositories\ComponentsRepo;

class ComponentController extends BaseController
{

    private $ComponentsRepo;

    public function __construct(ComponentsRepo $ComponentsRepo)
    {

        $this->ComponentsRepo = $ComponentsRepo;
    }

    public function list()
    {

        try {

            $arraySection = $this->ComponentsRepo->allSection();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'arraySection' => $arraySection,
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

}