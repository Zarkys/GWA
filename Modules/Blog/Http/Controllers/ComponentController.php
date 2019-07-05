<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Modules\Blog\Models\Repositories\ComponentsRepo;

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

            $arrayStatus = $this->ComponentsRepo->allStatus();
            $arrayCategory = $this->ComponentsRepo->allCategory();
            $arrayTag = $this->ComponentsRepo->allTag();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'arrayStatus' => $arrayStatus,
                'arrayCategory' => $arrayCategory,
                'arrayTag' => $arrayTag,
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
