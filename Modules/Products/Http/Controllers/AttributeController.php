<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Products\Models\Enums\ActiveProduct;
use Modules\Products\Models\Repositories\AttributeProductRepo;

class AttributeController extends BaseController
{

    private $AttributeProductRepo;

    public function __construct(AttributeProductRepo $AttributeProductRepo)
    {

        $this->AttributeProductRepo = $AttributeProductRepo;
    }

    public function delete(Request $request)
    {

        try {

            $attr = $this->AttributeProductRepo->find($request->get('id'));

            if (isset($attr->id)) {

                $this->AttributeProductRepo->delete($attr->id);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Borrado Correctamente') . '.',
                ];


                return response()->json($response, 200);

            }

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.'
            ];

            return response()->json($response, 500);

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

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'value' => 'required',
            'show_attr' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
            ];

            return response()->json($response);
        }

        try {

            $data = [
                'name' => $request->get('name'),
                'value' => $request->get('value'),
                'show_attr' => $request->get('show_attr'),
                'id_user' => $request->user()->id,
            ];

            $attr = $this->AttributeProductRepo->store($data);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Registrado  Correctamente'),
                'data' => $attr
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
