<?php

namespace Modules\Products\Http\Controllers;

use App\Components\Helper;
use App\Http\Controllers\Api\ComponentController;
use App\Http\Models\Repositories\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Products\Models\Enums\StatusDetailsOrder;
use Modules\Products\Models\Enums\StatusOrders;
use Modules\Products\Models\Repositories\CategoryProductRepo;
use Modules\Products\Models\Repositories\CurrencyProductRepo;
use Modules\Products\Models\Repositories\OrderRepo;
use Modules\Products\Models\Repositories\DetailsOrderRepo;
use Modules\Products\Models\Repositories\ProductImageRepo;
use Modules\Products\Models\Repositories\ProductRepo;

class WebController extends BaseController
{

    private $ProductRepo;
    private $ProductImageRepo;
    private $CategoryProductRepo;
    private $OrderRepo;
    private $DetailsOrderRepo;
    private $UserRepo;
    private $CurrencyProductRepo;

    public function __construct(CurrencyProductRepo $CurrencyProductRepo, UserRepo $UserRepo, CategoryProductRepo $CategoryProductRepo, ProductRepo $ProductRepo, ProductImageRepo $ProductImageRepo, OrderRepo $OrderRepo, DetailsOrderRepo $DetailsOrderRepo)
    {

        $this->ProductRepo = $ProductRepo;
        $this->ProductImageRepo = $ProductImageRepo;
        $this->CategoryProductRepo = $CategoryProductRepo;
        $this->OrderRepo = $OrderRepo;
        $this->DetailsOrderRepo = $DetailsOrderRepo;
        $this->UserRepo = $UserRepo;
        $this->CurrencyProductRepo = $CurrencyProductRepo;
    }

    //TODO PRODUCTS
    public function productsAll()
    {

        try {
            $currency = $this->CurrencyProductRepo->findActive();
            $products = $this->ProductRepo->allActiveCurrency($currency->iso);

            foreach ($products as $item => $value) {

                $price = '<strong>Precio: </strong>' . Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep) . ' ' . $value->CurrencyProduct->symbol . '<br>';

                $value->discount = is_null($value->price_discount) ? false : true;
                $percentage = '';
                if ($value->discount) {
                    $percentage = '<strong>Porcentaje: </strong>' . Helper::number($value->price_discount, 2) . ' %<br>';
                }

                $productRecords = $this->ProductImageRepo->find($value->id, $value->image);
                $value->image = isset($productRecords->ProductRecords[0]->url) ? $productRecords->ProductRecords[0]->url : null;

                $images = [];
                foreach ($value->ProductImages as $val) {
                    $val->ProductRecords[0]->url = env('URL_DOMAIN').$val->ProductRecords[0]->url;
                    $images[] = $val->ProductRecords[0]->url;
                }
                $value->images = $images;

                $attr = '';
                foreach ($value->AttributeProduct as $index => $val) {
                    $attr .= '<strong>' . $val->name . ': </strong>' . $val->value . '<br>';
                }
                $value->detail = '<div>' . $price . $percentage . $attr . '</div>';

                $value->price_original = Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);
                $value->discount_format = Helper::number($value->price_discount, 2) . '%';
                $value->price_discount_format = Helper::number($value->price - (($value->price * $value->price_discount) / 100), $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);


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
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }

    public function lastProducts()
    {

        try {
            $currency = $this->CurrencyProductRepo->findActive();
            $products = $this->ProductRepo->last($currency->iso, 4);

            foreach ($products as $item => $value) {

                $price = '<strong>Precio: </strong>' . Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep) . ' ' . $value->CurrencyProduct->symbol . '<br>';

                $value->discount = is_null($value->price_discount) ? false : true;
                $percentage = '';
                if ($value->discount) {
                    $percentage = '<strong>Porcentaje: </strong>' . Helper::number($value->price_discount, 2) . ' %<br>';
                }

                $productRecords = $this->ProductImageRepo->find($value->id, $value->image);
                $value->image = isset($productRecords->ProductRecords[0]->url) ? $productRecords->ProductRecords[0]->url : null;

                $images = [];
                foreach ($value->ProductImages as $val) {
                    $images[] = $val->ProductRecords[0]->url;
                }
                $value->images = $images;

                $attr = '';
                foreach ($value->AttributeProduct as $index => $val) {
                    $attr .= '<strong>' . $val->name . ': </strong>' . $val->value . '<br>';
                }
                $value->detail = '<div>' . $price . $percentage . $attr . '</div>';

                $value->price_original = Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);
                $value->discount_format = Helper::number($value->price_discount, 2) . '%';
                $value->price_discount_format = Helper::number($value->price - (($value->price * $value->price_discount) / 100), $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);


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
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }

    public function productFind(Request $request)
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

            return response()->json($response, 200);
        }
        try {

            $product = $this->ProductRepo->find($request->get('id'));
            if (isset($product)) {
                $value = $product;


                $price = '<strong>Precio: </strong>' . Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep) . ' ' . $value->CurrencyProduct->symbol . '<br>';

                $value->discount = is_null($value->price_discount) ? false : true;
                $percentage = '';
                if ($value->discount) {
                    $percentage = '<strong>Porcentaje: </strong>' . Helper::number($value->price_discount, 2) . ' %<br>';
                }

                $productRecords = $this->ProductImageRepo->find($value->id, $value->image);
                $value->image = isset($productRecords->ProductRecords[0]->url) ? $productRecords->ProductRecords[0]->url : null;

                $images = [];
                foreach ($value->ProductImages as $val) {
                    $images[] = $val->ProductRecords[0]->url;
                }
                $value->images = $images;

                $attr = '';
                foreach ($value->AttributeProduct as $index => $val) {
                    $attr .= '<strong>' . $val->name . ': </strong>' . $val->value . '<br>';
                }
                $value->detail = '<div>' . $price . $percentage . $attr . '</div>';

                $value->price_original = Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);
                $value->discount_format = Helper::number($value->price_discount, 2) . '%';
                $value->price_discount_format = Helper::number($value->price - (($value->price * $value->price_discount) / 100), $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);


                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data' => $product,
                ];
            } else {
                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data' => [],
                ];
            }


            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }

    //TODO CATEGORY
    public function categoriesAll()
    {

        try {

            $currency = $this->CurrencyProductRepo->findActive();
            $categories = $this->CategoryProductRepo->allActiveCurrency($currency->iso);

            $newCollection = new Collection();
            foreach ($categories as $item => $value) {
                $value->cant_product = count($value->Products);
                if ($value->cant_product > 0) {
                    $newCollection[] = $value;
                }

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $newCollection,
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

    public function categorySlug($slug)
    {

        try {

            $category = $this->CategoryProductRepo->slug($slug);

            foreach ($category->Products as $item => $value) {

                $price = '<strong>Precio: </strong>' . Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep) . ' ' . $value->CurrencyProduct->symbol . '<br>';

                $value->discount = is_null($value->price_discount) ? false : true;
                $percentage = '';
                if ($value->discount) {
                    $percentage = '<strong>Porcentaje: </strong>' . Helper::number($value->price_discount, 2) . ' %<br>';
                }

                $attr = '';
                foreach ($value->AttributeProduct as $index => $val) {
                    $attr .= '<strong>' . $val->name . ': </strong>' . $val->value . '<br>';
                }
                $value->detail = '<div>' . $price . $percentage . $attr . '</div>';

                $value->price_original = Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);
                $value->discount_format = Helper::number($value->price_discount, 2) . '%';
                $value->price_discount_format = Helper::number($value->price - (($value->price * $value->price_discount) / 100), $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $category,
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }

    }

    public function categorySlug_Post(Request $request)
    {

        try {

            $currency = $this->CurrencyProductRepo->findActive();
            $array = [];
            if (is_null($request->get('slug'))) {
//            $array = $this->ProductRepo->allActive();
                $array = $this->ProductRepo->allActiveCurrency($currency->iso);
            } else {
                $category = $this->CategoryProductRepo->slugCurrency($request->get('slug'), $currency->iso);

//            $category = $this->CategoryProductRepo->slug($request->get('slug'));
                $array = $category->Products;
            }

            $products = new Collection();
            foreach ($array as $item => $value) {

                $price = '<strong>Precio: </strong>' . Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep) . ' ' . $value->CurrencyProduct->symbol . '<br>';

                $value->discount = is_null($value->price_discount) ? false : true;
                $percentage = '';
                if ($value->discount) {
                    $percentage = '<strong>Porcentaje: </strong>' . Helper::number($value->price_discount, 2) . ' %<br>';
                }

                $productRecords = $this->ProductImageRepo->find($value->id, $value->image);
                $value->image = isset($productRecords->ProductRecords[0]->url) ? $productRecords->ProductRecords[0]->url : null;

                $images = [];
                foreach ($value->ProductImages as $val) {
                    $val->ProductRecords[0]->url = env('URL_DOMAIN').$val->ProductRecords[0]->url;
                    $images[] = $val->ProductRecords[0]->url;
                }
                $value->images = $images;

                $attr = '';
                foreach ($value->AttributeProduct as $index => $val) {
                    $attr .= '<strong>' . $val->name . ': </strong>' . $val->value . '<br>';
                }
                $value->detail = '<div>' . $price . $percentage . $attr . '</div>';

                $value->price_original = Helper::number($value->price, $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);
                $value->discount_format = Helper::number($value->price_discount, 2) . '%';
                $value->price_discount_format = Helper::number($value->price - (($value->price * $value->price_discount) / 100), $value->CurrencyProduct->decimals, $value->CurrencyProduct->dec_point, $value->CurrencyProduct->thousands_sep);
                $products[] = $value;
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

    //TODO ORDER
    public function openOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
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

            $data = [
                'name' => $request->get('name'),
                'email' => $request->get('email')
            ];
            $orderNew = $this->OrderRepo->store($data);

            if (isset($orderNew->id)) {

                $update = [
                    'number_order' => Helper::hashid($orderNew->id . '-' . $orderNew->email, 6, 'ABCDEF0123456789')
                ];

                $order = $this->OrderRepo->update($orderNew, $update);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Registrado  Correctamente') . '.',
                    'data' => $order
                ];


            } else {
                $response = [
                    'status' => 'FAILED',
                    'code' => 400,
                    'message' => __('Ocurrio un error interno') . '.',
                    'data' => [],
                ];
            }
            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }


    }

    public function consultOrder(Request $request)
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

            return response()->json($response, 200);
        }

        try {

            $orderNew = $this->OrderRepo->find($request->get('id'));

            if (isset($orderNew->id)) {

                foreach ($orderNew->details as $item => $value) {
                    $product = $this->ProductRepo->find($value->id_product);
                    $cant_product = $value->cant_product;
                    if (isset($product->id)) {

                        $attr = [];
                        foreach ($product->AttributeProduct as $i => $v) {
                            $attr[] = [
                                'name' => $v->name,
                                'value' => $v->value,
                            ];
                        }

                        $price_final = Helper::number($product->price - (($product->price * $product->price_discount) / 100), 2);

                        $productArray = [
                            'name' => $product->name,
                            'image' => $product->image,
                            'category' => $product->CategoryProduct->name,
                            'currency_name' => $product->CurrencyProduct->name,
                            'currency_symbol' => $product->CurrencyProduct->symbol,
                            'price' => $product->price,
                            'price_discount' => Helper::number($product->price_discount, 2) . '%',
                            'price_final' => $price_final,
                            'attr_product' => $attr,
                        ];

                        $amount = Helper::number(($price_final * $cant_product), 2);


                        $value->code = Helper::hashid($value->id . '' . $value->id_product, 6, '1234567890BCDFGH');
                        $value->products = $productArray;
                        $value->amount = $amount;

                    }
                }

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Consultado  Correctamente') . '.',
                    'data' => $orderNew
                ];


            } else {
                $response = [
                    'status' => 'FAILED',
                    'code' => 400,
                    'message' => __('Ocurrio un error interno') . '.',
                    'data' => [],
                ];
            }
            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }


    }

    public function sendOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'products' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
                'data' => $validator->errors()->getMessages(),
            ];

            return response()->json($response, 200);
        }

        try {

            $data = [
                'id_user' => Auth::id(),
                'status' => StatusOrders::$pending,
            ];
            if ($request->get('dni')) {
                $data['dni'] = $request->get('dni');
            }
            if ($request->get('address')) {
                $data['address'] = $request->get('address');
            }
            if ($request->get('type')) {
                $data['type'] = $request->get('type');
            }
            $orderNew = $this->OrderRepo->store($data);

            if (isset($orderNew->id)) {

                $update = [
                    'number_order' => Helper::hashid($orderNew->id . '-' . Auth::user()->email, 6, 'ABCDEF0123456789')
                ];
                $order = $this->OrderRepo->update($orderNew, $update);

                $products = Helper::json_object($request->get('products'));
                foreach ($products as $item => $value) {

                    $product = $this->ProductRepo->find($value->product);
                    $cant_product = $value->cant_product;
                    if (isset($product->id)) {

                        $price_final = Helper::number($product->price - (($product->price * $product->price_discount) / 100), 2);

                        $data = [
                            'id_order' => $order->id,
                            'id_product' => $product->id,
                            'amount' => $price_final,
                            'status' => StatusDetailsOrder::$pending,
                        ];

                        for ($i = 0; $i < $cant_product; $i++) {
                            $this->DetailsOrderRepo->store($data);
                        }

                    }

                }

                $admin = $this->UserRepo->findbyid(1);

                ComponentController::notificationAdmin(Auth::user(), $admin);
                ComponentController::notificationUser(Auth::user());

                $response = [
                    'status' => 'Listo',
                    'code' => 200,
                    'message' => __('Su orden ha sido enviada correctamente') . '.',
                ];

            } else {
                $response = [
                    'status' => 'FAILED',
                    'code' => 400,
                    'message' => __('Ocurrio un error interno') . '.',
                    'data' => [],
                ];
            }

            return response()->json($response, 200);

        } catch (\Exception $ex) {

            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }


    }

    public function cancelOrder(Request $request)
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

            return response()->json($response, 200);
        }

        try {

            $orderNew = $this->OrderRepo->find($request->get('id'));

            if (isset($orderNew->id)) {

                $update = [
                    'status' => StatusOrders::$cancel
                ];

                $order = $this->OrderRepo->update($orderNew, $update);

                foreach ($orderNew->details as $item => $value) {
                    $this->DetailsOrderRepo->update($value, ['status' => StatusDetailsOrder::$cancelled]);
                }

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Orden Cancelada Correctamente') . '.',
                    'data' => $order
                ];


            } else {
                $response = [
                    'status' => 'FAILED',
                    'code' => 400,
                    'message' => __('Ocurrio un error interno') . '.',
                    'data' => [],
                ];
            }
            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }


    }

    //TODO PETITIONS
    public function sendPetition(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_order' => 'required',
            'id_product' => 'required',
            'cant_product' => 'required',
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

            $order = $this->OrderRepo->find($request->get('id_order'));
            $petition = [];
            if (isset($order->id)) {

                $product = $this->ProductRepo->find($request->get('id_product'));

                if (isset($product->id)) {
                    $cant_product = (int)$request->get('cant_product');
//                    $attr = [];
//                    foreach ($product->AttributeProduct as $item => $value) {
//                        $attr[] = [
//                            'name' => $value->name,
//                            'value' => $value->value,
//                        ];
//                    }

//                    $price_final = Helper::number($product->price - (($product->price * $product->price_discount) / 100), 2);
//
//                    $productArray = [
//                        'name' => $product->name,
//                        'image' => $product->image,
//                        'category' => $product->CategoryProduct->name,
//                        'currency_name' => $product->CurrencyProduct->name,
//                        'currency_symbol' => $product->CurrencyProduct->symbol,
//                        'price' => $product->price,
//                        'price_discount' => Helper::number($product->price_discount, 2) . '%',
//                        'price_final' => $price_final,
//                        'attr_product' => $attr,
//                    ];
//
//                    $amount = Helper::number(($price_final * $cant_product), 2);

                    $data = [
                        'id_order' => $order->id,
                        'id_product' => $product->id,
                        'cant_product' => $cant_product,
//                        'products' => $productArray,
//                        'amount' => $amount
                    ];

                    $petition = $this->DetailsOrderRepo->store($data);
                }

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Producto Agregado Correctamente') . '.',
                'data' => $petition
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }


    }

    public function cantPetition(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'cant' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
                'data' => $validator->errors()->getMessages(),
            ];

            return response()->json($response, 200);
        }

        try {

            $petition = $this->DetailsOrderRepo->find($request->get('id'));

            if (isset($petition->id)) {
                $this->DetailsOrderRepo->update($petition, ['cant_product' => $request->get('cant')]);
            }


            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Peticion Cancelada Correctamente') . '.',
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }


    }

    public function cancelPetition(Request $request)
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

            return response()->json($response, 200);
        }

        try {

            $petition = $this->DetailsOrderRepo->find($request->get('id'));

            if (isset($petition->id)) {

                $this->DetailsOrderRepo->delete($petition->id);
            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Peticion Cancelada Correctamente') . '.',
            ];

            return response()->json($response, 200);

        } catch (\Exception $ex) {
            $response = [
                $ex,
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }


    }

}
