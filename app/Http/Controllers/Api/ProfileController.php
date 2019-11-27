<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Repositories\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseController
{

    private $UserRepo;

    public function __construct(UserRepo $UserRepo)
    {

        $this->UserRepo = $UserRepo;
    }


    public function profile()
    {
        return view('user/profile');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required',
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

            $user = $this->UserRepo->find($request->user()->id);

            if (isset($user->id) && Hash::check($request->get('old_password'), $user->password)) {

                $data = [
                    'password' => $request->get('password'),
                ];
                $this->UserRepo->update($user, $data);

            }

            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => __('Contraseñas Modificada Correctamente') . '.',
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
            'email.required' => __('El Correo Electrónico es requerido'),
            'email.unique' => __('El Correo Electrónico ya se encuentra registrado'),
            'password.required' => __('La Contraseña es requerida'),
        ];
    }

}
