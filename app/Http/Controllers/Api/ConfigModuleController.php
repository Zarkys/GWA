<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\ConfigModuleRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    class ConfigModuleController extends BaseController {
        
        private $ConfigModuleRepo;
        
        public function __construct(ConfigModuleRepo $ConfigModuleRepo) {
            
            $this->ConfigModuleRepo = $ConfigModuleRepo;
        }
        
        public function index() {
            
            try {
                $configmodule = $this->ConfigModuleRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configmodule,
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
                $configmodule = $this->ConfigModuleRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configmodule,
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
                $configmodule = $this->ConfigModuleRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configmodule,
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
                $configmodule = $this->ConfigModuleRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configmodule,
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
                $configmodule = $this->ConfigModuleRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configmodule,
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
                $configmodule = $this->ConfigModuleRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configmodule,
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
                $configmodule = $this->ConfigModuleRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $configmodule,
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
                'name_module'    => 'required',
                'status'    => 'required',
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
                    'name_module'    => $request->get('name_module'),
                    'status'    => $request->get('status'),
                    'active' => 1,
                ];

              $item = 'name_module';
              $string = $data['name_module'];
              $ConfigWebDuplename = $this->ConfigWebRepo->checkduplicate($item,$string);
             

            if ($ConfigModuleDuplename==0 ) { 
        
                $configmodule     = $this->ConfigModuleRepo->store($data);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El tipo de producto ha sido registrado  correctamente'),
                    'data'    => $configmodule,
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
            $configmodule = $this->ConfigModuleRepo->findbyid($id);

//$ola = $request->get('status')
            // Log::debug('estatus del request'.$ola);
           
            if($request->has('status')){
                $nueva = $request->get('status');
                 Log::debug('estatus re3quest'.$nueva);
                $data['status'] = $request->get('status');
            }
            Log::debug('estatus modificado'.$data['status']);
    
            try {

           
               
                $configmodule = $this->ConfigModuleRepo->update($configmodule, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La Configuracionde modulo ha sido modificado correctamente '),
                    'data'    => $configmodule,
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
                
                $module = $this->ConfigModuleRepo->findbyid($id);

                if($module->active === 0)
                {
                    $module = $this->ConfigModuleRepo->update($module, ['active' => 1]);
                }
                else
                {
                    $module = $this->ConfigModuleRepo->update($module, ['active' => 0]);
                }
                
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El producto fue cambiado correctamente '),
                    'data'    => $module,
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
                
                $configmodule = $this->ConfigModuleRepo->findbyid($id);
                $configmodule = $this->ConfigModuleRepo->delete($configmodule, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El tipo de producto  ha sido eliminado correctamente'),
                    'data'    => $configmodule,
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
                'name_module.required'  => __('El nombre del modulo es requerido'),
                'status.required'  => __('El estatus es requerido'),
            ];
        }

    }
