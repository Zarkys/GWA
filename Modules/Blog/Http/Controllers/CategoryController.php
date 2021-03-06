<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Blog\Models\Enums\ActiveCategory;
use Modules\Blog\Models\Repositories\CategoryBlogRepo;

class CategoryController extends BaseController
{

    private $CategoryBlogRepo;

    public function __construct(CategoryBlogRepo $CategoryBlogRepo)
    {

        $this->CategoryBlogRepo = $CategoryBlogRepo;
    }

//    TODO VIEWS CATEGORIES
    public function list()
    {

        return view('blog::categories.list');

    }

    public function create()
    {

        return view('blog::categories.create');

    }

    public function edit()
    {

        return view('blog::categories.edit');

    }

//    TODO CRUD CATEGORIES
    public function listAll(Request $request)
    {

        try {

            $category = $this->CategoryBlogRepo->all();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $category,
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

            $category = $this->CategoryBlogRepo->find($request->get('id'));

            if (isset($category->id)) {
                $categories = $this->CategoryBlogRepo->allActive();
                $active = $category->active === ActiveCategory::$activated ? ActiveCategory::$disabled : ActiveCategory::$activated;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'active' => $active
                ];

                if ($active === ActiveCategory::$activated) {
                    $category = $this->CategoryBlogRepo->update($category, ['active' => $active]);
                } elseif (count($categories) > 1) {
                    $category = $this->CategoryBlogRepo->update($category, ['active' => $active]);
                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $category->active
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

            $category = $this->CategoryBlogRepo->find($request->get('id'));

            if (isset($category->id)) {
                $categories = $this->CategoryBlogRepo->allActive();
                $active = $category->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveCategory::$disabled) {

                    $category = $this->CategoryBlogRepo->delete($category->id);

                } elseif ($active === ActiveCategory::$activated && count($categories) > 1) {
                    $category = $this->CategoryBlogRepo->delete($category->id);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $category->active
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
            'slug' => 'required|unique:blog_categories_blog',
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
                'active' => ActiveCategory::$activated,
            ];

            $this->CategoryBlogRepo->store($data);

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
            $category = $this->CategoryBlogRepo->findbyid($request->get('id'));

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $category,
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

            $category = $this->CategoryBlogRepo->find($request->get('id'));

            if (isset($category->id)) {
                $data = [
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                ];
                $validator = Validator::make($request->all(), [
                    'slug' => 'required|unique:blog_categories_blog',
                ]);
                if (!$validator->fails()) {

                    $data['slug'] = $request->get('slug');

                }

                $this->CategoryBlogRepo->update($category, $data);

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


    public function filteractive()
    {

        try {
            $category = $this->CategoryBlogRepo->filteractive();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $category,
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

    public function filterinactive()
    {

        try {
            $category = $this->CategoryBlogRepo->filterinactive();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $category,
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

    public function filterdeleted()
    {

        try {
            $category = $this->CategoryBlogRepo->filterdeleted();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $category,
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

    public function filterby($item, $id)
    {

        try {
            $category = $this->CategoryBlogRepo->filterby($item, $id);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $category,
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

    public function findbyunique($item, $string)
    {

        try {
            $Category = $this->CategoryBlogRepo->findbyunique($item, $string);

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $Category,
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
            'name.required' => __('El nombre es requerido'),
            /*  'slug.required'      => __('El slug es requerido'),
              'description.required'  => __('La descripcion es requerida'),
              'parent_category.required'  => __('La categoria padre es requerida'),*/
        ];
    }

}
