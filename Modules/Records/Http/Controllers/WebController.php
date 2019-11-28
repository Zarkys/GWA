<?php

namespace Modules\Records\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Modules\Records\Models\Repositories\RecordsRepo;


class WebController extends BaseController
{

    private $RecordsRepo;

    public function __construct(RecordsRepo $RecordsRepo)
    {
        $this->RecordsRepo = $RecordsRepo;
    }

    public function list()
    {

        try {

            $records = $this->RecordsRepo->allWhere(['active' => 1]);
            foreach ($records as $value) {
                $value->url = env('URL_DOMAIN') . $value->url;
            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $records,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

}
