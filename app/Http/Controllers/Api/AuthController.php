<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Entities\User;
use App\Http\Models\Enums\Roles;
use App\Http\Models\Repositories\UserRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    private $UserRepo;

    public function __construct(UserRepo $UserRepo)
    {

        $this->UserRepo = $UserRepo;
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required',
        ], $this->custom_message());

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
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'rol' => Roles::$client,
                'active' => 1,
                'email_verified_at' => new Carbon(), //Verificar o no?
            ];

            $user = $this->UserRepo->store($data);

            if (isset($user->id)) {
                ComponentController::welcome($user);

                $data = $this->loginAfterRegister($user->email, $request->get('password'));

                $response = [
                    'status' => 'OK',
                    'code' => 200,
                    'message' => __('Registrado correctamente'),
                    'data' => $data,
                ];

            } else {

                $response = [
                    'status' => 'ERROR',
                    'code' => 400,
                    'message' => __('Intente de Nuevo'),
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

    public function loginAfterRegister($email, $password)
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        Auth::attempt($credentials);

        $user = Auth::user();

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

        $token->save();

        return $userTmp = [
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'access_token' => $tokenResult->accessToken,
        ];
    }

    public function login(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ], $this->custom_message());

        if ($validator->fails()) {
            $response = [
                'status' => 'FAILED',
                'code' => 400,
                'message' => __('Parametros incorrectos'),
                'data' => $validator->errors()->getMessages(),
            ];

            return response()->json($response, 200);
        }

        $credentials = [
            'email' => strtolower($request->get('email')),
            'password' => $request->get('password'),
        ];

        if (!Auth::attempt($credentials)) {
            $response = [
                'status' => 'No Autorizado',
                'code' => 401,
                'message' => __('Credenciales incorrectas'),
            ];

            return response()->json($response, 200);
        }

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addDays(365);
        }
        $token->save();

        $userTmp = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'access_token' => $tokenResult->accessToken,
        ];

        return response()->json([
            'code' => 200,
            'user' => $userTmp,
            'message' => __('Bienvenido'),
        ], 200);
    }

    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
        $response = [
            'status' => 'Ok',
            'code' => 200,
            'message' => __('Has cerrado sesión correctamente'),
        ];

        return response()->json($response, 200);
    }

    public function user(Request $request)
    {

        try {

            $user = User::where('id', $request->user()->id)->with([
                'Rol' => function ($query) {
                    $query->with('permissions');
                },
            ])->first();
            $permissions = [];
            foreach ($user->Rol->permissions as $index => $item) {
                $permissions[] = $item->id;
            }

            return response()->json([
                //                    'access_token' => $tokenResult->accessToken,
                'user' => $user,
                'permissions' => $permissions
                //                    'token_type'   => 'Bearer',
                //                    'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            ], 200);

        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => _('Ocurrio un error interno') . '.',

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
            'phone.required' => __('El telefono es requerido'),
        ];
    }

}
