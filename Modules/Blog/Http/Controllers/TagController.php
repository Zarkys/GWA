<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Blog\Models\Enums\ActiveTag;
use Modules\Blog\Models\Repositories\TagRepo;

class TagController extends BaseController
{

    private $TagRepo;

    public function __construct(TagRepo $TagRepo)
    {

        $this->TagRepo = $TagRepo;
    }

//    TODO VIEWS TAG
    public function list()
    {

        return view('blog::tags.list');

    }

    public function create()
    {

        return view('blog::tags.create');

    }

    public function edit()
    {

        return view('blog::tags.edit');

    }

//    TODO CRUD TAG
    public function listAll(Request $request)
    {

        try {

            $tag = $this->TagRepo->all($request->user()->id);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $tag,
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

            $tag = $this->TagRepo->find($request->get('id'));

            if (isset($tag->id)) {
                $categories = $this->TagRepo->allActive();
                $active = $tag->active === ActiveTag::$activated ? ActiveTag::$disabled : ActiveTag::$activated;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'active' => $active
                ];

                if ($active === ActiveTag::$activated) {
                    $tag = $this->TagRepo->update($tag, ['active' => $active]);
                } elseif (count($categories) > 1) {
                    $tag = $this->TagRepo->update($tag, ['active' => $active]);
                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $tag->active
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

            $tag = $this->TagRepo->find($request->get('id'));

            if (isset($tag->id)) {
                $categories = $this->TagRepo->allActive();
                $active = $tag->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveTag::$disabled) {

                    $tag = $this->TagRepo->delete($tag->id);

                } elseif ($active === ActiveTag::$activated && count($categories) > 1) {
                    $tag = $this->TagRepo->delete($tag->id);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $tag->active
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
            'slug' => 'required|unique:blog_tags',
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
                'slug' => $request->get('slug'),
                'description' => $request->get('description'),
                'id_user' => $request->user()->id,
                'active' => ActiveTag::$activated,
            ];

            $this->TagRepo->store($data);

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
            $tag = $this->TagRepo->findbyid($request->get('id'));

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $tag,
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

            $tag = $this->TagRepo->find($request->get('id'));

            if (isset($tag->id)) {
                $data = [
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                ];
                $validator = Validator::make($request->all(), [
                    'slug' => 'required|unique:blog_tags',
                ]);
                if (!$validator->fails()) {

                    $data['slug'] = $request->get('slug');

                }

                $this->TagRepo->update($tag, $data);

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

//TODO CONTROLLER OLD

//namespace App\Http\Controllers\Api;
//
//use App\Http\Models\Repositories\TagRepo;
//use Illuminate\Http\Request;
//use Illuminate\Routing\Controller as BaseController;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Log;
//
//class TagController extends BaseController
//{
//
//    private $TagRepo;
//
//    public function __construct(TagRepo $TagRepo)
//    {
//
//        $this->TagRepo = $TagRepo;
//    }
//
//    public function index()
//    {
//
//        try {
//            $tag = $this->TagRepo->all();
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function filteractive()
//    {
//
//        try {
//            $tag = $this->TagRepo->filteractive();
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function filterinactive()
//    {
//
//        try {
//            $tag = $this->TagRepo->filterinactive();
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function filterdeleted()
//    {
//
//        try {
//            $tag = $this->TagRepo->filterdeleted();
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function filterby($item, $id)
//    {
//
//        try {
//            $tag = $this->TagRepo->filterby($item, $id);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function findbyid($id)
//    {
//
//        try {
//            $tag = $this->TagRepo->findbyid($id);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function findbyunique($item, $string)
//    {
//
//        try {
//            $Tag = $this->TagRepo->findbyunique($item, $string);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('Datos Obtenidos Correctamente'),
//                'data' => $Tag,
//            ];
//
//            return response()->json($response, 200);
//
//        } catch (\Exception $ex) {
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function save(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required',
//            // 'slug'    => 'required',
//            // 'description'    => 'required',
//        ], $this->custom_message());
//
//        if ($validator->fails()) {
//            $response = [
//                'status' => 'FAILED',
//                'code' => 400,
//                'message' => __('Parametros incorrectos'),
//                'data' => $validator->errors()->getMessages(),
//            ];
//
//            return response()->json($response);
//        }
//        try {
//
//            $data = [
//                'name' => $request->get('name'),
//                'slug' => $request->get('slug'),
//                'description' => $request->get('description'),
//                'active' => 1,
//            ];
//
//            $item = 'name';
//            $string = $data['name'];
//            $TagDuplename = $this->TagRepo->checkduplicate($item, $string);
//            $item = 'slug';
//            $string = $data['slug'];
//            $TagDupleslug = $this->TagRepo->checkduplicate($item, $string);
//
//
//            if ($TagDuplename == 0 && $TagDupleslug == 0) {
//
//                $tag = $this->TagRepo->store($data);
//                $response = [
//                    'status' => 'OK',
//                    'code' => 200,
//                    'message' => __('La etiqueta ha sido registrada  correctamente'),
//                    'data' => $tag,
//                ];
//
//                return response()->json($response, 200);
//            } else {
//                $response = [
//                    'status' => 'FAILED',
//                    'code' => 409,
//                    'message' => _('La etiqueta fue registrada anteriormente') . '.',
//
//                ];
//
//                return response()->json($response, 409);
//            }
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno1') . '.',
//
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
//
//    public function update(Request $request, $id)
//    {
//
//        Log::debug($request);
//        $tag = $this->TagRepo->findbyid($id);
//
//
//        if ($request->has('name')) {
//            $data['name'] = $request->get('name');
//        }
//        if ($request->has('slug')) {
//            $data['slug'] = $request->get('slug');
//        }
//        if ($request->has('description')) {
//            $data['description'] = $request->get('description');
//        }
//
//        try {
//
//            $item = 'name';
//            $string = $data['name'];
//            $TagDuplename = $this->TagRepo->checkduplicate($item, $string);
//            $item = 'slug';
//            $string = $data['slug'];
//            $TagDupleslug = $this->TagRepo->checkduplicate($item, $string);
//
//
//            if ($TagDuplename == 0 && $TagDupleslug == 0) {
//
//                $tag = $this->TagRepo->update($tag, $data);
//
//                $response = [
//                    'status' => 'OK',
//                    'code' => 200,
//                    'message' => __('La etiqueta ha sido modificada correctamente '),
//                    'data' => $tag,
//                ];
//
//                return response()->json($response, 200);
//
//            } else {
//                $response = [
//                    'status' => 'FAILED',
//                    'code' => 409,
//                    'message' => _('La etiqueta fue registrada anteriormente') . '.',
//
//                ];
//
//                return response()->json($response, 409);
//            }
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//    }
//
//    public function activate($id, Request $request)
//    {
//
//
//        try {
//
//            $tag = $this->TagRepo->findbyid($id);
//            $tag = $this->TagRepo->activate($tag, ['active' => 1]);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('La etiqueta ha sido activada correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function inactivate($id, Request $request)
//    {
//
//
//        try {
//
//            $tag = $this->TagRepo->findbyid($id);
//            $tag = $this->TagRepo->inactivate($tag, ['active' => 0]);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('La etiqueta ha sido inactivada correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//    public function delete($id, Request $request)
//    {
//
//
//        try {
//
//            $tag = $this->TagRepo->findbyid($id);
//            $tag = $this->TagRepo->delete($tag, ['active' => 2]);
//
//            $response = [
//                'status' => 'OK',
//                'code' => 200,
//                'message' => __('La etiqueta ha sido eliminada correctamente'),
//                'data' => $tag,
//            ];
//
//            return response()->json($response, 200);
//
//
//        } catch (\Exception $ex) {
//            Log::error($ex);
//            $response = [
//                'status' => 'FAILED',
//                'code' => 500,
//                'message' => _('Ocurrio un error interno') . '.',
//            ];
//
//            return response()->json($response, 500);
//        }
//
//    }
//
//
//    public function custom_message()
//    {
//        return [
//            'name.required' => __('El nombre es requerido'),
//            /* 'slug.required'      => __('El slug es requerido'),
//             'description.required'  => __('La descripcion es requerida'),*/
//        ];
//    }
//
//}
