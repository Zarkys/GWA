<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Modules\Products\Models\Enums\ActiveCurrency;
use Modules\Products\Models\Repositories\CurrencyProductRepo;

class CurrencyController extends BaseController
{

    private $CurrencyProductRepo;

    public function __construct(CurrencyProductRepo $CurrencyProductRepo)
    {

        $this->CurrencyProductRepo = $CurrencyProductRepo;
    }

//    TODO VIEWS
    public function list()
    {

        return view('products::currencies.list');

    }

//    TODO CRUD
    public function listAll()
    {

        try {

            $currencies = $this->CurrencyProductRepo->all();

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Datos Obtenidos Correctamente'),
                'data' => $currencies
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

            $currency = $this->CurrencyProductRepo->find($request->get('id'));

            if (isset($currency->iso)) {

                $currencies = $this->CurrencyProductRepo->allActive();
                foreach ($currencies as $value) {
                    $this->CurrencyProductRepo->update($value, ['active' => ActiveCurrency::$disabled]);
                }

                $this->CurrencyProductRepo->update($currency, ['active' => ActiveCurrency::$activated]);

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Se Cambio la Moneda Principal Correctamente') . '.',
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

            $currency = $this->CurrencyProductRepo->find($request->get('id'));

            if (isset($currency->iso)) {
                $currencies = $this->CurrencyProductRepo->allActive();
                $active = $currency->active;

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Datos Modificados Correctamente') . '.',
                ];

                if ($active === ActiveCurrency::$disabled) {

                    $this->CurrencyProductRepo->delete($currency->iso);

                } elseif ($active === ActiveCurrency::$activated && count($currencies) > 1) {
                    $this->CurrencyProductRepo->delete($currency->iso);

                } else {
                    $response = [
                        'status' => 'OK',
                        'code' => 201,
                        'message' => __('Debes mantener un item activo') . '.',
                        'active' => $currency->active
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

}
