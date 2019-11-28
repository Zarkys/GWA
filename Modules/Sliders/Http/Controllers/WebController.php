<?php

namespace Modules\Sliders\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Modules\Sliders\Models\Enums\Status;
use Modules\Sliders\Models\Repositories\SlidersRepo;

class WebController extends BaseController
{

    private $SlidersRepo;

    public function __construct(SlidersRepo $SlidersRepo)
    {
        $this->SlidersRepo = $SlidersRepo;
    }

    public function list()
    {

        try {

            $records = $this->SlidersRepo->allWhere(['status' => Status::$activated]);
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
