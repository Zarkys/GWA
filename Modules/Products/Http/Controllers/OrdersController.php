<?php

namespace Modules\Products\Http\Controllers;

use App\Components\Helper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Modules\Products\Models\Enums\StatusDetailsOrder;
use Modules\Products\Models\Enums\StatusOrders;
use Modules\Products\Models\Repositories\CategoryProductRepo;
use Modules\Products\Models\Repositories\OrderRepo;
use Modules\Products\Models\Repositories\DetailsOrderRepo;
use Modules\Products\Models\Repositories\ProductRepo;

class OrdersController extends BaseController
{

    private $ProductRepo;
    private $CategoryProductRepo;
    private $OrderRepo;
    private $DetailsOrderRepo;

    public function __construct(CategoryProductRepo $CategoryProductRepo, ProductRepo $ProductRepo, OrderRepo $OrderRepo, DetailsOrderRepo $DetailsOrderRepo)
    {

        $this->ProductRepo = $ProductRepo;
        $this->CategoryProductRepo = $CategoryProductRepo;
        $this->OrderRepo = $OrderRepo;
        $this->DetailsOrderRepo = $DetailsOrderRepo;
    }

//    TODO VIEWS
    public function listPending()
    {

        return view('products::order.listPending');

    }

    public function listAttended()
    {

        return view('products::order.listAttended');

    }

//    TODO CRUD ORDER
    public function listAll_status(Request $request)
    {

        try {

            $orders = $this->OrderRepo->allStatus([$request->get('status')]);

            foreach ($orders as $item => $value) {
                $total = 0;
                $symbol = '';
                foreach ($value->Details as $i => $v) {
                    $product = $v->Product;

                    $total += $v->amount;

                    $price_final = Helper::number($product->price - (($product->price * $product->price_discount) / 100), 2);
                    $v->Product->price_final = $price_final;

                    $symbol = $product->CurrencyProduct->symbol;
                    $v->code = Helper::hashid($v->id . '' . $v->id_product, 6, '1234567890BCDFGH');
                    $v->symbol = $symbol;
                }

                $value->total = Helper::number($total) . ' ' . $symbol;
                $value->symbol = $symbol;
            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $orders,
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

    public function attendedOrder(Request $request)
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
                $amountTotal = 0;
                foreach ($orderNew->details as $item => $value) {

                    $product = $this->ProductRepo->find($value->id_product);

                    if (isset($product->id)) {

                        $amountTotal += $value->amount;

                        $data = [
                            'status' => StatusDetailsOrder::$attended
                        ];

                        $this->DetailsOrderRepo->update($value, $data);

                    }
                }

                $update = [
                    'status' => StatusOrders::$attended,
                    'amount_total' => Helper::number($amountTotal, 2),
                ];

                $this->OrderRepo->update($orderNew, $update);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Orden Atendida Correctamente') . '.',
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

                $this->OrderRepo->update($orderNew, $update);

                foreach ($orderNew->details as $item => $value) {
                    $this->DetailsOrderRepo->update($value, ['status' => StatusDetailsOrder::$cancelled]);
                }

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Orden Cancelada Correctamente') . '.',
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

//    TODO CRUD DETAILS
    public function cantDetails(Request $request)
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

            $details = $this->DetailsOrderRepo->find($request->get('id'));

            if (isset($details->id)) {
                $this->DetailsOrderRepo->update($details, ['cant_product' => $request->get('cant')]);
            }


            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Detalles Modificado Correctamente') . '.',
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

    public function cancelDetails(Request $request)
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

            $details = $this->DetailsOrderRepo->find($request->get('id'));

            if (isset($details->id)) {

                $this->DetailsOrderRepo->delete($details->id);
            }


            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Detalles Cancelado Correctamente') . '.',
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
