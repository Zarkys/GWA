<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Products\Models\Enums\ActiveCategory;
use Modules\Products\Models\Repositories\CategoryProductRepo;
use Modules\Products\Models\Repositories\CurrencyProductRepo;
use Modules\Products\Models\Repositories\TypeProductRepo;
use Modules\Products\Models\Repositories\ProductRepo;
use Modules\Records\Models\Repositories\RecordsRepo;

class ProductsController extends BaseController
{

    private $CategoryProductRepo;
    private $TypeProductRepo;
    private $ProductRepo;
    private $CurrencyProductRepo;
    private $RecordsRepo;

    public function __construct(CurrencyProductRepo $CurrencyProductRepo,RecordsRepo $RecordsRepo,ProductRepo $ProductRepo, TypeProductRepo $TypeProductRepo, CategoryProductRepo $CategoryProductRepo)
    {

        $this->CategoryProductRepo = $CategoryProductRepo;
        $this->TypeProductRepo = $TypeProductRepo;
        $this->ProductRepo = $ProductRepo;
        $this->CurrencyProductRepo = $CurrencyProductRepo;
        $this->RecordsRepo = $RecordsRepo;
    }

//    TODO VIEWS
    public function list()
    {

        return view('products::product.list');

    }

    public function create()
    {

        return view('products::product.create');

    }

    public function edit()
    {

        return view('products::product.edit');

    }

//    TODO CRUD
    public function listAll(Request $request)
    {

        try {

            $products = $this->ProductRepo->all();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $products,
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

            $category = $this->CategoryProductRepo->find($request->get('id'));

            if (isset($category->id)) {
                $categories = $this->CategoryProductRepo->allActive();
                $active = $category->active === ActiveCategory::$activated ? ActiveCategory::$disabled : ActiveCategory::$activated;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'active' => $active
                ];

                if ($active === ActiveCategory::$activated) {
                    $category = $this->CategoryProductRepo->update($category, ['active' => $active]);
                } elseif (count($categories) > 1) {
                    $category = $this->CategoryProductRepo->update($category, ['active' => $active]);
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

            $category = $this->CategoryProductRepo->find($request->get('id'));

            if (isset($category->id)) {
                $categories = $this->CategoryProductRepo->allActive();
                $active = $category->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveCategory::$disabled) {

                    $category = $this->CategoryProductRepo->delete($category->id);

                } elseif ($active === ActiveCategory::$activated && count($categories) > 1) {
                    $category = $this->CategoryProductRepo->delete($category->id);

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
        return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories_blog',
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

            $this->CategoryProductRepo->store($data);

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
            $category = $this->CategoryProductRepo->findbyid($request->get('id'));

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

            $category = $this->CategoryProductRepo->find($request->get('id'));

            if (isset($category->id)) {
                $data = [
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                ];
                $validator = Validator::make($request->all(), [
                    'slug' => 'required|unique:categories_blog',
                ]);
                if (!$validator->fails()) {

                    $data['slug'] = $request->get('slug');

                }

                $this->CategoryProductRepo->update($category, $data);

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


    //TODO CONSULT
    public function resourcesActive()
    {

        try {

            $categories = $this->CategoryProductRepo->allActive();
            $types = $this->TypeProductRepo->allActive();
            $currencies = $this->CurrencyProductRepo->allActive();
            foreach ($currencies as $item => $value){
                $value->iso_name = $value->iso.' ('.$value->symbol.')';
            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'categories' => $categories,
                'types' => $types,
                'currencies' => $currencies,
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

    public function consultGallery()
    {

        try {

            $images = $this->RecordsRepo->allWhere(['type' => 'image']);

            foreach ($images as $item => $value) {
                $size = $value->size;

                $units = array('B', 'KB', 'MB', 'GB');

                $size = max($size, 0);
                $pow = floor(($size ? log($size) : 0) / log(1024));
                $pow = min($pow, count($units) - 1);

                $size /= pow(1024, $pow);
//             $bytes /= (1 << (10 * $pow));

                $value->size = number_format($size, 2) . ' ' . $units[$pow];
                $value->dimension = $value->dimension . 'px';
                $value->remove = false;
                $value->typeExtension = null;
                $value->typeView = true;

                $value->typeExtension = is_null($value->typeExtension) ? '' : '(' . $value->typeExtension . ')';


            }


            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'images' => $images
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


}
