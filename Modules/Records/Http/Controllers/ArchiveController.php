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

//    TODO VIEWS ARCHIVE
    public function create()
    {

        return view('records::archive.upload');

    }

//    TODO CRUD ARCHIVE
    public function store(Request $request)
    {

//        return $request->all();
        $mime = ComponentController::Mime($request->file('file')->getMimeType());

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

            if ($mime['code'] === 200) {
                $type = $mime['type'];
                $component = [];
                if ($type === 'image') {

                    $validator = Validator::make($request->all(), [
                        'file' => 'image|max:1024',
                    ]);

                    if ($validator->fails()) {
                        $response = [
                            'status' => 'FAILED',
                            'code' => 500,
                            'message' => __('Ocurrio un error interno') . '.',
                            'data' => $validator->errors()->getMessages()
                        ];

                        return response()->json($response, 500);
                    }

                    $component = ComponentController::uploadFile_Img($request, $type);


                } else if ($type === 'office' || $type === 'video' || $type === 'audio') {

                    $component = ComponentController::uploadFile($request, $type);

                }

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
