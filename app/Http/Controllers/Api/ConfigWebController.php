<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\ConfigWebRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    class ConfigWebController extends BaseController {
        
        private $ConfigWebRepo;
        
        public function __construct(ConfigWebRepo $ConfigWebRepo) {
            
            $this->ConfigWebRepo = $ConfigWebRepo;
        }
        
        public function index() {
            
            try {
                $configweb = $this->ConfigWebRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configweb,
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
        
             public function filteractive() {
            
            try {
                $configweb = $this->ConfigWebRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configweb,
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

          public function filterinactive() {
            
            try {
                $configweb = $this->ConfigWebRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configweb,
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
          public function filterdeleted() {
            
            try {
                $configweb = $this->ConfigWebRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configweb,
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
        public function filterby($item,$id) {
            
            try {
                $configweb = $this->ConfigWebRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configweb,
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
        public function findbyid($id) {
            
            try {
                $configweb = $this->ConfigWebRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configweb,
                ];
                
                return response()->json($response, 200);
                
            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }

        public function findbyunique($item, $string) {
            
            try {
                $configweb = $this->ConfigWebRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configweb,
                ];
                
                return response()->json($response, 200);
                
            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }
        
        public function save(Request $request) {
            $validator = Validator::make($request->all(), [
                'name_config'    => 'required',
                'value'    => 'required',
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
                    'name_config'    => $request->get('name_config'),
                    'value'    => $request->get('value'),
                    'active' => 1,
                ];

              $item = 'name';
              $string = $data['name'];
              $ConfigWebDuplename = $this->ConfigWebRepo->checkduplicate($item,$string);
             

            if ($ConfigWebDuplename==0 ) { 
        
                $configweb     = $this->ConfigWebRepo->store($data);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El tipo de producto ha sido registrado  correctamente'),
                    'data'    => $configweb,
                ];
        
                return response()->json($response, 200);
                }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El tipo de producto fue registrado anteriormente') . '.',
        
                ];
        
                return response()->json($response, 409); 
            }
            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno1') . '.',
        
                ];
        
                return response()->json($response, 500);
            }
        }
        
        public function update(Request $request,$id) {
            
            Log::debug($request);
            $configweb = $this->ConfigWebRepo->findbyid($id);

            
           
            if($request->has('value')){
                $data['value'] = $request->get('value');
            }
    
            try {

           
               
                $configweb = $this->ConfigWebRepo->update($configweb, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El tipo de producto  ha sido modificado correctamente '),
                    'data'    => $configweb,
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

        public function change($id, Request $request) {
            
            
            try {
                
                $product = $this->ConfigWebRepo->findbyid($id);

                if($product->active === 0)
                {
                    $product = $this->ConfigWebRepo->update($product, ['active' => 1]);
                }
                else
                {
                    $product = $this->ConfigWebRepo->update($product, ['active' => 0]);
                }
                
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El producto fue cambiado correctamente '),
                    'data'    => $product,
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
                
                $configweb = $this->ConfigWebRepo->findbyid($id);
                $configweb = $this->ConfigWebRepo->delete($configweb, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El tipo de producto  ha sido eliminado correctamente'),
                    'data'    => $configweb,
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
                'name.required'  => __('El nombre es requerido'),
                'description.required'  => __('La descripcion es requerida'),
            ];
        }

    }
