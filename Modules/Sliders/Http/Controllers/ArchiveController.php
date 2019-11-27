<?php

namespace Modules\Sliders\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Validator;
use Modules\Sliders\Models\Enums\Status;
use Modules\Sliders\Models\Repositories\SlidersRepo;
use Illuminate\Support\Facades\Log;

class ArchiveController extends BaseController
{

    private $SlidersRepo;

    public function __construct(SlidersRepo $SlidersRepo)
    {
        $this->SlidersRepo = $SlidersRepo;
    }

    public function create()
    {

        return view('sliders::images.upload');

    }

    public function list()
    {

        return view('sliders::images.list');

    }

    public function edit()
    {

        return view('sliders::images.edit');

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            Log::error('La imagen no cumple con los parametros de validacion');
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

        try {

            $idLast = $this->SlidersRepo->lastId();

            $component = ComponentController::uploadFile_sliders($request, 'sliders', $idLast);

            $data = [
                'title' => is_null($request->get('title')) ? '- - -' : $request->get('title'),
                'name' => $component['name'],
                'url' => $component['url'],
            ];
            $this->SlidersRepo->store($data);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Subido con Exito'),

            ];

            return response()->json($response, 200);


        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error al almacenar el archivo') . '.',

            ];

            return response()->json($response, 500);
        }
    }

    public function listAll()
    {

        try {

            $records = $this->SlidersRepo->all();

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

    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
                'data' => $validator->errors()->getMessages(),
            ];

            return response()->json($response);
        }

        try {

            $image = $this->SlidersRepo->find($request->get('id'));

            if (isset($image->id)) {

                $active = $image->status === Status::$activated ? Status::$disabled : Status::$activated;

                $this->SlidersRepo->update($image, ['status' => $active]);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'status_post' => $active
                ];

                return response()->json($response, 200);
            }

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',

            ];

            return response()->json($response, 500);


        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',

            ];

            return response()->json($response, 500);
        }
    }

    public function itemDelete(Request $request)
    {

        try {

            $archive = $this->SlidersRepo->find($request->get('id'));
            if (isset($archive->id)) {

                $urlTmp = storage_path('../public/upload/sliders/' . $archive->name);
                ComponentController::deleteFile($urlTmp);

                $this->SlidersRepo->delete($archive->id);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Eliminado Correctamente')
                ];

                return response()->json($response, 200);

            }
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);


        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function consult(Request $request)
    {

        try {

            $image = $this->SlidersRepo->find($request->get('id'));

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $image,
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

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'image' => 'required',
        ], $this->custom_message());

        if ($validator->fails()) {
            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
                'data' => $validator->errors()->getMessages(),
            ];


            return response()->json($response);
        }

        try {

            $image = $this->SlidersRepo->find($request->get('id'));

            if (isset($image->id)) {
                $data = [];
                $idImg = $this->SlidersRepo->find($request->get('image'));

                if (isset($idImg->id)) {

                    if ($image->url !== $idImg->url) {
                        $data = [
                            'name' => $idImg->name,
                            'url' => $idImg->url,
                        ];
                    }


                }

                if (!is_null($request->get('title'))) {
                    $data['title'] = $request->get('title');
                }

                $this->SlidersRepo->update($image, $data);

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Registrado Correctamente'),
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

    public function custom_message()
    {
        return [
            'image.required' => __('La imagen es requerida'),
            'id_section.required' => __('La sección es requerida'),
        ];
    }
}
