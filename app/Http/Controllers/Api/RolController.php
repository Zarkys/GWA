<?php
    
    namespace App\Http\Controllers\Api;
    use App\Components\UUID;
  
    use App\Http\Models\Repositories\RoleRepo;

   // use App\Security\Enums\Roles;

   use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;

    class RolController extends BaseController {

        private $RoleRepo;

        public function __construct(RoleRepo $RoleRepo) {
            $this->RoleRepo = $RoleRepo;  
        }

        public function index() {

            try {
                $rol = $this->RoleRepo->all();
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $rol,
                ];

                return response()->json($response, 200);

            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                    'data'    => $ex,
                ];

                return response()->json($response, 500);
            }

        }

        public function get($token) {

            try {
                $client = $this->ClientRepo->findByToken($token);
               
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $client,
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
        public function getlike($clientcompany,$query) {

            try {
                $client = $this->ClientRepo->findLike($clientcompany,$query);
                return response()->json($client, 200);
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

        
        public function store(Request $request){

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'client_company' => 'required',
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
                    $data = [                       
                        'token' => UUID::v4(),
                        'name' => $request->get('name'),
                        'phone' => $request->get('phone'),                      
                        'client_company' => $request->get('client_company'),
                        'geo_location' => $request->get('geo_location'),
                        'email'  => $request->get('email'),                       
                        'others' => $request->get('others'),
                        'active' => 1,
                        'status' => 1,
                    ];
                    $Client = $this->ClientRepo->store($data);            
                    $response = [
                        'status'  => 'OK',
                        'code'    => '200',
                        'message' => __('Cliente Creado Correctamente'),
                        'data'    => $Client,
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

        public function update(Request $request,$token){

            try {

                    $data = [];
                    $dataDriver = [];

                    $Client = $this->ClientRepo->findByToken($token);
                   
                    if($request->has('phone')){
                        $data['phone'] = $request->get('phone');
                    }
                    if($request->has('name')){
                        $data['name'] = $request->get('name');
                    }
                    if($request->has('client_company')){
                        $data['client_company'] = $request->get('client_company');
                    }
                    if($request->has('geo_location')){
                        $data['geo_location'] = $request->get('geo_location');
                    }                  
                    if($request->has('email')){
                        $data['email'] = $request->get('email');
                    }                   
                    if($request->has('others')){
                        $data['others'] = $request->get('others');
                    }
                    $clientupdated = $this->ClientRepo->update($Client,$data);
                    $response = [
                        'status'  => 'OK',
                        'code'    => '200',
                        'message' => __('Cliente Actualizado Correctamente'),
                        'data'    => $clientupdated,

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

        public function delete(Request $request,$token){
            try {

             
                $Client = $this->ClientRepo->findByToken($token);
                $Client->clientcompany = $Client->clientcompany['id'];
                $Client = $this->ClientRepo->delete($Client, ['active' => false]);

                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Cliente Eliminado Correctamente'),
                    'data'    => $Client,
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

                'code.required'     => __('El código es requerido') . '.',
                'name.required' => __('El nombre es requerido') . '.',
                'client_company.required' => __('Compania cliente requerida') . '.',
            ];

        }

        
    }
