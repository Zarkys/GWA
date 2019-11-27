<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Records\Models\Repositories\RecordsRepo;
use Modules\Website\Models\Repositories\ImageRepo;
use Modules\Website\Models\Repositories\SectionRepo;
use Nexmo\Call\Collection;

class WebsiteController extends Controller
{
    private $ImageRepo;
    private $SectionRepo;
    private $RecordsRepo;

    public function __construct(ImageRepo $ImageRepo, SectionRepo $SectionRepo, RecordsRepo $RecordsRepo)
    {

        $this->ImageRepo = $ImageRepo;
        $this->SectionRepo = $SectionRepo;
        $this->RecordsRepo = $RecordsRepo;
    }

    public function homePage()
    {

        try {

            $images = $this->ImageRepo->allWhere(2); //home_page
            $new = [];
            foreach ($images as $value) {
                if (isset($value->SiteRecords->url)) {
                    $new[$value->name] = $value->SiteRecords->url;
                }

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $new,
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
