<?php

namespace Modules\Doctors\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Doctors\Models\Enums\ActiveSpecialty;
use Modules\Doctors\Models\Repositories\SpecialtyRepo;

class SpecialtyController extends BaseController
{
    private $SpecialtyRepo;

    public function __construct(SpecialtyRepo $SpecialtyRepo)
    {

        $this->SpecialtyRepo = $SpecialtyRepo;
    }

    //    TODO VIEWS SPECIALTY
    public function list()
    {

        return view('doctors::specialties.list');

    }

    public function create()
    {

        return view('doctors::specialties.create');

    }

    public function edit()
    {

        return view('doctors::specialties.edit');

    }

    public function listAll()
    {

        try {
            $specialty = $this->SpecialtyRepo->all();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $specialty,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }


    public function listActive()
    {

        try {
            $specialty = $this->SpecialtyRepo->allActive();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $specialty,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }

    public function findbyunique($item, $string)
    {

        try {
            $speciality = $this->SpecialtyRepo->findbyunique($item, $string);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $speciality,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => _('Ocurrio un error interno') . '.',
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

            $specialty = $this->SpecialtyRepo->find($request->get('id'));

            if (isset($specialty->id)) {
                $specialties = $this->SpecialtyRepo->allActive();

                $active = $specialty->active === ActiveSpecialty::$activated ? ActiveSpecialty::$disabled : ActiveSpecialty::$activated;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'active' => $active
                ];

                if ($active === ActiveSpecialty::$activated) {
                    $specialty = $this->SpecialtyRepo->update($specialty, ['active' => $active]);
                } elseif (count($specialties) > 1) {
                    $specialty = $this->SpecialtyRepo->update($specialty, ['active' => $active]);
                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $specialty->active
                    ];

                    return response()->json($response, 201);
                }

                return response()->json($response, 200);

            }

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.'
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

    public function delete(Request $request)
    {

        try {

            $specialty = $this->SpecialtyRepo->find($request->get('id'));

            if (isset($specialty->id)) {
                $specialties = $this->SpecialtyRepo->allActive();
                $active = $specialty->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveSpecialty::$disabled) {

                    $specialty = $this->SpecialtyRepo->delete($specialty->id);

                } elseif ($active === ActiveSpecialty::$activated && count($specialties) > 1) {
                    $specialty = $this->SpecialtyRepo->delete($specialty->id);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $specialty->active
                    ];

                    return response()->json($response, 201);
                }

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
            'description' => 'required',
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

            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'active' => ActiveSpecialty::$activated,
            ];

            $this->SpecialtyRepo->store($data);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Registrado  Correctamente'),
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

    public function consult(Request $request)
    {

        try {
            $specialty = $this->SpecialtyRepo->findbyid($request->get('id'));

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $specialty,
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
            'name' => 'required',
            'description' => 'required',
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

            $specialty = $this->SpecialtyRepo->find($request->get('id'));

            if (isset($specialty->id)) {
                $data = [
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                ];

                $this->SpecialtyRepo->update($specialty, $data);

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Actualizado Correctamente'),
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

    public function custom_message()
    {
        return [
            'name.required' => __('El nombre es requerido'),
            /*  'slug.required'      => __('El slug es requerido'),
              'description.required'  => __('La descripcion es requerida'),
              'parent_category.required'  => __('La categoria padre es requerida'),*/
        ];
    }


}