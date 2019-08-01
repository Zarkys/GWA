<?php

namespace Modules\Products\Http\Controllers;

use App\Components\Helper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Modules\Products\Models\Enums\ActiveProduct;
use Modules\Products\Models\Repositories\AttributeProductRepo;
use Modules\Products\Models\Repositories\CategoryProductRepo;
use Modules\Products\Models\Repositories\ProductRepo;
use Modules\Products\Models\Repositories\CurrencyProductRepo;
use Modules\Products\Models\Repositories\TypeProductRepo;
use Modules\Records\Models\Enums\ActiveArchive;
use Modules\Records\Models\Repositories\RecordsRepo;

class ProductsController extends BaseController
{

    private $ProductRepo;
    private $TypeProductRepo;
    private $CurrencyProductRepo;
    private $RecordsRepo;
    private $CategoryProductRepo;
    private $AttributeProductRepo;

    public function __construct(AttributeProductRepo $AttributeProductRepo, CategoryProductRepo $CategoryProductRepo, CurrencyProductRepo $CurrencyProductRepo, RecordsRepo $RecordsRepo, ProductRepo $ProductRepo, TypeProductRepo $TypeProductRepo)
    {

        $this->ProductRepo = $ProductRepo;
        $this->TypeProductRepo = $TypeProductRepo;
        $this->CurrencyProductRepo = $CurrencyProductRepo;
        $this->RecordsRepo = $RecordsRepo;
        $this->CategoryProductRepo = $CategoryProductRepo;
        $this->AttributeProductRepo = $AttributeProductRepo;
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
    public function listAll()
    {

        try {

            $products = $this->ProductRepo->all();

            foreach ($products as $item => $value) {

                $showPrice = '<strong>Mostar Precio: </strong>' . ($value->show_price ? 'Si' : 'No') . '<br>';

                $price = '<strong>Precio: </strong>' . Helper::number($value->price) . ' ' . $value->CurrencyProduct->symbol . '<br>';
                $percentage = '<strong>Porcentaje: </strong>' . Helper::number($value->price_discount, 1) . ' %<br>';

                $attr = '';
                foreach ($value->AttributeProduct as $index => $val) {
                    $attr .= '<strong>' . $val->name . ': </strong>' . $val->value . '<br>';
                }
                $value->detail = '<div>' . $showPrice . $price . $percentage . $attr . '</div>';
            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $products,
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

            $product = $this->ProductRepo->find($request->get('id'));

            if (isset($product->id)) {
                $products = $this->ProductRepo->allActive();
                $active = $product->active === ActiveProduct::$activated ? ActiveProduct::$disabled : ActiveProduct::$activated;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                    'active' => $active
                ];

                if ($active === ActiveProduct::$activated) {
                    $this->ProductRepo->update($product, ['active' => $active]);
                } elseif (count($products) > 1) {
                    $this->ProductRepo->update($product, ['active' => $active]);
                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $product->active
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

            $product = $this->ProductRepo->find($request->get('id'));

            if (isset($product->id)) {
                $products = $this->ProductRepo->allActive();
                $active = $product->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveProduct::$disabled) {

                    $this->ProductRepo->delete($product->id);

                } elseif ($active === ActiveProduct::$activated && count($products) > 1) {
                    $this->ProductRepo->delete($product->id);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $product->active
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
            'id_category' => 'required',
            'id_currency' => 'required',
            'id_type' => 'required',
            'percentage' => 'required',
            'price' => 'required',
            'show_price' => 'required',
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

            $img = null;
            if (count($request->get('images')) > 0) {
                $img = $request->get('images')[0];
            }

            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'id_category' => $request->get('id_category'),
                'currency' => $request->get('id_currency'),
                'id_type' => $request->get('id_type'),
                'price_discount' => $request->get('percentage'),
                'price' => $request->get('price'),
                'show_price' => $request->get('show_price'),
                'image' => $img,
                'images' => $request->get('images'),
                'id_user' => $request->user()->id,
                'active' => ActiveProduct::$activated,
            ];

            $product = $this->ProductRepo->store($data);

            if (isset($product->id)) {

                foreach ($request->get('attrs') as $item => $value) {
                    $data = [
                        'name' => $value['name'],
                        'value' => $value['value'],
                        'show_attr' => true,
                        'id_product' => $product->id,
                        'id_user' => $request->user()->id,
                    ];

                    $this->AttributeProductRepo->store($data);
                }
            }

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

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'id_category' => 'required',
            'id_currency' => 'required',
            'id_type' => 'required',
            'percentage' => 'required',
            'price' => 'required',
            'show_price' => 'required',
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

            $product = $this->ProductRepo->find($request->get('id'));

            if (isset($product->id)) {

                $img = null;
                if (count($request->get('images')) > 0) {
                    $img = $request->get('images')[0];
                }

                $data = [
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                    'id_category' => $request->get('id_category'),
                    'currency' => $request->get('id_currency'),
                    'id_type' => $request->get('id_type'),
                    'price_discount' => $request->get('percentage'),
                    'price' => $request->get('price'),
                    'show_price' => $request->get('show_price'),
                    'image' => $img,
                    'images' => $request->get('images'),
                ];

                $this->ProductRepo->update($product, $data);

                $this->AttributeProductRepo->deleteAll($product->id);

                foreach ($request->get('attrs') as $item => $value) {

                    $data = [
                        'name' => $value['name'],
                        'value' => $value['value'],
                        'show_attr' => true,
                        'id_product' => $product->id,
                        'id_user' => $request->user()->id,
                    ];

                    $this->AttributeProductRepo->store($data);
                }

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Modificado Correctamente'),
                ];

                return response()->json($response, 200);
            }

            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
            ];

            return response()->json($response, 400);

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

            $product = $this->ProductRepo->find($request->get('id'));

            $product->isoCurrency = $product->CurrencyProduct;
            $product->isoCurrency->iso_name = $product->CurrencyProduct->iso . ' (' . $product->CurrencyProduct->symbol . ')';
            $product->iso_name = $product->CurrencyProduct->iso . ' (' . $product->CurrencyProduct->symbol . ')';
            $product->price = Helper::number($product->price);


            $newAttrs = [];

            $attributes = $this->AttributeProductRepo->allProductNull();
            foreach ($attributes as $item => $value) {

                $name1 = str_replace(' ', '', $value->name);
                $value1 = str_replace(' ', '', $value->value);

                $attTmp = $product->AttributeProduct;
                foreach ($attTmp as $index => $val) {

                    $name2 = str_replace(' ', '', $val->name);
                    $value2 = str_replace(' ', '', $val->value);

                    if ($name1 === $name2 && $value1 === $value2) {
                        $it = $name2 . '_' . $value2;
                        if (!isset($newAttrs[$it])) {
                            $newAttrs[$it] = $val;
                            $newAttrs[$it]['check'] = true;
//                            $newAttrs[$it]['concat'] = [$name2,$value2];
                        }
                    }
                }

                $it = $name1 . '_' . $value1;
                if (!isset($newAttrs[$it])) {
                    $newAttrs[$it] = $value;
                    $newAttrs[$it]['check'] = false;
//                            $newAttrs[$it]['concat'] = [$name1,$value1];
                }

            }

            $attrs = [];
            $attrs_select = [];

            foreach ($newAttrs as $item => $value) {
                $attrs[] = $value;
                if ($value->check) {
                    $attrs_select[] = $value;
                }

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $product,
                'attrs' => $attrs,
                'attrs_select' => $attrs_select,
//                'attrs' => $newAttrs
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

    //TODO CONSULT
    public function resourcesActive()
    {

        try {

            $attributeProduct = $this->AttributeProductRepo->allProductNull();

            $images = $this->RecordsRepo->allWhere(['type' => 'image', 'active' => ActiveArchive::$activated]);
            $categories = $this->CategoryProductRepo->allActive();
            $types = $this->TypeProductRepo->allActive();
            $currencies = $this->CurrencyProductRepo->allActive();
            foreach ($currencies as $item => $value) {
                $value->iso_name = $value->iso . ' (' . $value->symbol . ')';
            }

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
                'categories' => $categories,
                'types' => $types,
                'currencies' => $currencies,
                'images' => $images,
                'attributeProduct' => $attributeProduct,
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
