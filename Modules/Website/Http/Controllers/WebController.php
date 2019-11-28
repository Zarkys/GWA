<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Modules\Website\Models\Repositories\ImageRepo;
use Modules\Website\Models\Repositories\SectionRepo;
use Modules\Website\Models\Repositories\TextRepo;
use Illuminate\Support\Facades\Log;

class WebController extends BaseController
{

    private $ImageRepo;
    private $SectionRepo;
    private $TextRepo;

    public function __construct(ImageRepo $ImageRepo, SectionRepo $SectionRepo, TextRepo $TextRepo)
    {

        $this->ImageRepo = $ImageRepo;
        $this->SectionRepo = $SectionRepo;
        $this->TextRepo = $TextRepo;
    }

    public function filterby($item, $id)
    {

        try {
            $data = [];
            if ($item === 'id_section') {
                $data = $this->TextRepo->filterby($item, $id);
            } elseif ($item === 'id_archive') {
                $data = $this->ImageRepo->filterby($id);
            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $data,
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

    public function filterby_post(Request $request)
    {

        try {
            $item = $request->get('by');
            $id = $request->get('id');
            $data = [];
            if ($item === 'id_section') {
                $data = $this->TextRepo->filterby($item, $id);
            } elseif ($item === 'id_archive') {
                $data = $this->ImageRepo->filterby($id);
            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $data,
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
