<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Models\Enums\Roles;
    use App\Http\Models\Repositories\UserRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use Hash;

    class UserController extends BaseController {

        private $UserRepo;

        public function __construct(UserRepo $UserRepo) {

            $this->UserRepo        = $UserRepo;
        }

        public function index() {

            try {
                $users = $this->UserRepo->all();

                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $users,
                ];

                return response()->json($response, 200);

            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];

                return response()->json($response, 500);
            }

        }

        public function get_user() {

            try {
                $users = Auth::user();

                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $users,
                ];

                return response()->json($response, 200);

            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];

                return response()->json($response, 500);
            }

        }

        public function find($id) {

            try {
                $user = $this->UserRepo->find($id);
                if (isset($user->id)) {
                    $response = [
                        'status'  => 'OK',
                        'code'    => 200,
                        'message' => __('Datos Obtenidos Correctamente'),
                        'data'    => $user,
                    ];

                    return response()->json($response, 200);
                }

                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => __('El usuario no existe') . '.',

                ];

                return response()->json($response, 500);

            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];

                return response()->json($response, 500);
            }

        }

        public function store(Request $request) {

            $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'email'    => 'required|string|email|unique:users',
                'password' => 'required',
                'rol'      => 'required',
            ], $this->custom_message());

            if ($validator->fails()) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];

                return response()->json($response);
            }
            try {

                $data = [
                    'name'     => $request->get('name'),
                    'email'    => $request->get('email'),
                    'password' => $request->get('password'),
                    'rol'      => Roles::$company,
                    'active'   => 1,
                    'status'   => 1,
                ];
                $user = $this->UserRepo->store($data);

                

                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Usuario registrado correctamente'),
                    'data'    => $user,
                ];

                return response()->json($response, 200);
            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',

                ];

                return response()->json($response, 500);
            }
        }

        public function update($id, Request $request) {

            $validator = Validator::make($request->all(), [
                'name'  => 'required',
                'email' => 'required',
                'rol'   => 'required',
                'password'   => 'required',
            ], $this->custom_message());

            if ($validator->fails()) {

                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];

                return response()->json($response, 400);
            }

            try {
                $user = $this->UserRepo->find($id);
                if (isset($user->id)) {

                    $data = [
                        'name'  => $request->get('name'),
                        'email' => $request->get('email'),
                        'rol' => $request->get('rol'),
                        'password' => $request->get('password'),
                    ];
                    $user = $this->UserRepo->update($user, $data);

                    

                    $response = [
                        'status'  => 'OK',
                        'code'    => 200,
                        'message' => __('Usuario Actualizado Correctamente'),
                        'data'    => $user,
                    ];

                    return response()->json($response, 200);
                }

                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => __('El usuario no existe') . '.',

                ];

                return response()->json($response, 500);

            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];

                return response()->json($response, 500);
            }
        }
        public function updatePassword(Request $request) {

            //CHECK REQUIRED PASSWORD
            $validator = Validator::make($request->all(), [
                'new_password'  => 'required', 
                 'old_password'  => 'required',  
                  'confirm_password'  => 'required',                 
            ], $this->custom_message());

            if ($validator->fails()) {

                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];

                return response()->json($response, 400);
            }

            //CHECK OLD PASSWORD
             $old_password = $request->get('old_password');
             $id_user = Auth::user()->id;
             $user = $this->UserRepo->find($id_user);
                    if (Hash::check($old_password, $user->password)) {
                        
                    }
                    else{
                        $response = [
                            'status'  => 'FAILED',
                            'code'    => 400,
                            'message' => __('Contrasena anterior incorrecta'),
                            'data'=>user                        
                        ];
                         return response()->json($response, 400);
                    }
            //CHECK SAMES PASSWORDS
            if ($request->get('new_password') != $request->get('confirm_password')) {

                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Las contrasenas no coinciden'),
                    'data'    => $validator->errors()->getMessages(),
                ];

                return response()->json($response, 400);
            }

            try {
                $user = $this->UserRepo->find(Auth::user()->id);
                if (isset($user->id)) {
                    
                    $data = [
                        'password'  => $request->get('new_password'),                       
                    ];
                    $user = $this->UserRepo->update($user, $data);                 

                    $response = [
                        'status'  => 'OK',
                        'code'    => 200,
                        'message' => __('Password Actualizada Correctamente'),
                        'data'    => $user,
                    ];

                    return response()->json($response, 200);
                }

                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => __('El usuario no existe') . '.',

                ];

                return response()->json($response, 500);

            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];

                return response()->json($response, 500);
            }
        }

          public function updateName(Request $request) {

            $validator = Validator::make($request->all(), [
                'name'  => 'required',                
            ], $this->custom_message());

            if ($validator->fails()) {

                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];

                return response()->json($response, 400);
            }

            try {
                
                $user = $this->UserRepo->find(Auth::user()->id);
                if (isset($user->id)) {

                    $data = [
                        'name'  => $request->get('name'),                       
                    ];
                    $user = $this->UserRepo->update($user, $data);                 

                    $response = [
                        'status'  => 'OK',
                        'code'    => 200,
                        'message' => __('Nombre Actualizado Correctamente'),
                        'data'    => $user,
                    ];

                    return response()->json($response, 200);
                }

                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => __('El usuario no existe') . '.',

                ];

                return response()->json($response, 500);

            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];

                return response()->json($response, 500);
            }
        }

         public function activate($id, Request $request) {
          
         
            
            try {
                
                $user = $this->UserRepo->findbyid($id);
                $user = $this->UserRepo->activate($user, ['active' => 1]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El usuario ha sido activada correctamente'),
                    'data'    => $user,
                ];
                
                return response()->json($response, 200);
                
                
            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }

         public function inactivate($id, Request $request) {
          
         
            
            try {
                
                $user = $this->UserRepo->findbyid($id);
                $user = $this->UserRepo->inactivate($user, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El usuario ha sido inactivada correctamente'),
                    'data'    => $user,
                ];
                
                return response()->json($response, 200);
                
                
            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }
        
        public function delete($id, Request $request) {
          
         
            
            try {
                
                $user = $this->UserRepo->findbyid($id);
                $user = $this->UserRepo->delete($user, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El usuario ha sido eliminado correctamente'),
                    'data'    => $user,
                ];
                
                return response()->json($response, 200);
                
                
            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }

        public function custom_message() {

            return [
                'name.required'      => __('El nombre es requerido'),
                'email.required'     => __('El Correo Electrónico es requerido'),
                'email.unique'       => __('El Correo Electrónico ya se encuentra registrado'),
                'password.required'  => __('La Contraseña es requerida'),
            ];
        }

    }
