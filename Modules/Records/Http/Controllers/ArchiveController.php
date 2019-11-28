<?php

namespace Modules\Records\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Records\Models\Repositories\RecordsRepo;

class ArchiveController extends BaseController
{

    private $RecordsRepo;

    public function __construct(RecordsRepo $RecordsRepo)
    {

        $this->RecordsRepo = $RecordsRepo;
    }

    public function create()
    {

        return view('records::archive.upload');

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);
        if ($validator->fails()) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

        try {

            $mime = ComponentController::Mime($request->file('file')->getMimeType());

            if ($mime['code'] === 200) {
                $type = $mime['type'];
                $idLast = $this->RecordsRepo->lastId();
                $component = ComponentController::uploadFile($request, $type, $idLast);

                $data = [
                    'name' => $component['name'],
                    'type' => $type,
                    'url' => $component['url'],
                    'size' => $component['size'],
                    'dimension' => $component['dimension'],
                    'id_user' => $request->user()->id,
                ];
                $this->RecordsRepo->store($data);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Subido con Exito'),

                ];

                return response()->json($response, 200);

            } else {

                $response = [
                    'status' => 'FAILED',
                    'code' => 500,
                    'message' => __('File not supported') . '.',
                ];

                return response()->json($response, 500);

            }


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
