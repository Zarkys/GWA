<?php

namespace Modules\Website\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Website\Models\Enums\ActiveSection;
use Modules\Website\Models\Repositories\SectionRepo;

class SectionController extends BaseController
{

    private $SectionRepo;

    public function __construct(SectionRepo $SectionRepo)
    {

        $this->SectionRepo = $SectionRepo;
    }

//    TODO VIEWS TAG
    public function list()
    {

        return view('website::sections.list');

    }

    public function create()
    {

        return view('website::sections.create');

    }

    public function edit()
    {

        return view('website::sections.edit');

    }

//    TODO CRUD SECTION
    public function listAll(Request $request)
    {

        try {

            $section = $this->SectionRepo->allActive();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $section,
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

            $section = $this->SectionRepo->find($request->get('id'));

            if (isset($section->id)) {
                $categories = $this->SectionRepo->allActive();
                $active = $section->active === ActiveSection::$activated ? ActiveSection::$disabled : ActiveSection::$activated;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'active' => $active
                ];

                if ($active === ActiveSection::$activated) {
                    $section = $this->SectionRepo->update($section, ['active' => $active]);
                } elseif (count($categories) > 1) {
                    $section = $this->SectionRepo->update($section, ['active' => $active]);
                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $section->active
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

            $section = $this->SectionRepo->find($request->get('id'));

            if (isset($section->id)) {
                $categories = $this->SectionRepo->allActive();
                $active = $section->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveSection::$disabled) {

                    $section = $this->SectionRepo->delete($section->id);

                } elseif ($active === ActiveSection::$activated && count($categories) > 1) {
                    $section = $this->SectionRepo->delete($section->id);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $section->active
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
            'title' => 'required',
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
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'active' => ActiveSection::$activated,
            ];

            $this->SectionRepo->store($data);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Registrado  Correctamente'),
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

    public function consult(Request $request)
    {

        try {
            $section = $this->SectionRepo->findbyid($request->get('id'));

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $section,
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
            'title' => 'required',
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

            $section = $this->SectionRepo->find($request->get('id'));

            if (isset($section->id)) {
                $data = [
                    'title' => $request->get('title'),
                    'description' => $request->get('description')
                ];
                /* $validator = Validator::make($request->all(), [
                     'slug' => 'required|unique:tags_blog',
                 ]);
                 if (!$validator->fails()) {

                     $data['slug'] = $request->get('slug');

                 }*/

                $this->SectionRepo->update($section, $data);

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
            'title.required' => __('El titulo es requerido'),
            /*  'slug.required'      => __('El slug es requerido'),
              'description.required'  => __('La descripcion es requerida'),
              'parent_category.required'  => __('La categoria padre es requerida'),*/
        ];
    }

}
